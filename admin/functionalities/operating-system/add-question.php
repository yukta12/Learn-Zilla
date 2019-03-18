<?php
session_start();
    if(isset($_POST['post_question'])){
        $question = $_POST['question'];
        $option_a = $_POST['option_a'];
        $option_b = $_POST['option_b'];
        $option_c = $_POST['option_c'];
        $option_d = $_POST['option_d'];
        $correct_answer = $_POST['correct_answer'];
        $explanation  = $_POST['explanation'];
        $posted_by = $_SESSION['email'];


        //inserting values

        include_once ("../includes/connection.php");
        $query = "INSERT INTO operating_system(question,option_a,option_b,option_c,option_d,correct_answer,explanation,posted_by) VALUES (?,?,?,?,?,?,?,?)";

        $ps = mysqli_prepare($connection,$query);

        mysqli_stmt_bind_param($ps,"ssssssss",$question,$option_a,$option_b,$option_c,$option_d,$correct_answer,$explanation,$posted_by);

        mysqli_stmt_execute($ps);

//        mysqli_query($connection,$sql);
        if(mysqli_errno($connection)){
            die(mysqli_error($connection));
        }else{
            header("Location: operating-system.php");
        }

    }
?>
<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form" enctype="multipart/form-data">
            <legend>Add Questions</legend>
            <hr>

            <div class="form-group">
                <label for="">Question</label>
                <input type="text" class="form-control" name="question" id="question">
            </div>

            <div class="form-group">
                <label for="post_image">Option A</label>
                <input type="text" class="form-control" name="option_a" id="option_a">
            </div>

            <div class="form-group">
                <label for="post_tags">Option B</label>
                <input type="text" class="form-control" name="option_b" id="option_b">
            </div>
            <div class="form-group">
                <label for="post_tags">Option C</label>
                <input type="text" class="form-control" name="option_c" id="option_c">
            </div>
            <div class="form-group">
                <label for="post_tags">Option D</label>
                <input type="text" class="form-control" name="option_d" id="option_d">
            </div>
            <div class="form-group">
                <label for="post_tags">Correct answer</label>
                <input type="text" class="form-control" name="correct_answer" id="correct_answer">
            </div>
            <div class="form-group">
                <label for="post_content">Explanation * <span style="color: red;">if any</span></label>
                <textarea name="explanation" id="explanation" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="post_question">Post Question</button>
        </form>
        <div class="mb-5"></div>
    </div>
</div>