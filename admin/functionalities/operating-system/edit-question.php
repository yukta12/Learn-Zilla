<?php
include_once("../includes/connection.php");
if (isset($_POST['edit_question'])) {

    //die("helo");
    $edit_question_id = $_GET['question_id'];
    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_answer = $_POST['correct_answer'];
    $explanation  = $_POST['explanation'];



    //editing values


    $query = "UPDATE operating_system SET question=?,option_a=?,option_b=?,option_c=?,option_d=?,correct_answer=?,explanation=? WHERE question_id=?";
//die($query);
    $ps = mysqli_prepare($connection, $query);

   mysqli_stmt_bind_param($ps, "sssssssd", $question, $option_a, $option_b, $option_c, $option_d, $correct_answer, $explanation, $edit_question_id);

    mysqli_stmt_execute($ps);

    mysqli_query($connection, $sql);
    if (mysqli_errno($connection)) {
        die(mysqli_error($connection));
    } else {

        header("Location: operating-system.php");
    }

}
//CODE TO LOAD DATA OF POST WHEN THE PAGE IS LOADED FOR FIRST TIME

if (isset($_GET['question_id'])) {
    $edit_question_id = $_GET['question_id'];

    $query = "SELECT * FROM operating_system WHERE question_id = $edit_question_id";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $question = $row['question'];
        $option_a = $row['option_a'];
        $option_b = $row['option_b'];
        $option_c = $row['option_c'];
        $option_d = $row['option_d'];
        $correct_answer = $row['correct_answer'];
        $explanation = $row['explanation'];
        $posted_by = $row['posted_by'];

    }
}

?>
<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form" enctype="multipart/form-data">
            <legend>Edit Questions</legend>
            <hr>

            <div class="form-group">
                <label for="">Question</label>
                <input type="text" class="form-control" name="question" id="question" value="<?php echo $question;?>">
            </div>

            <div class="form-group">
                <label for="post_image">Option A</label>
                <input type="text" class="form-control" name="option_a" id="option_a" value="<?php echo $option_a;?>">
            </div>

            <div class="form-group">
                <label for="post_tags">Option B</label>
                <input type="text" class="form-control" name="option_b" id="option_b" value="<?php echo $option_b;?>">
            </div>
            <div class="form-group">
                <label for="post_tags">Option C</label>
                <input type="text" class="form-control" name="option_c" id="option_c" value="<?php echo $option_c;?>">
            </div>
            <div class="form-group">
                <label for="post_tags">Option D</label>
                <input type="text" class="form-control" name="option_d" id="option_d" value="<?php echo $option_d;?>">
            </div>
            <div class="form-group">
                <label for="post_tags">Correct answer</label>
                <input type="text" class="form-control" name="correct_answer" id="correct_answer" value="<?php echo $correct_answer;?>">
            </div>
            <div class="form-group">
                <label for="post_content">Explanation * <span style="color: red;">if any</span></label>
                <textarea name="explanation" id="explanation" cols="30" rows="10" class="form-control"><?php echo $explanation;?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="edit_question">Edit Question</button>
        </form>
        <div class="mb-5"></div>
    </div>
</div>