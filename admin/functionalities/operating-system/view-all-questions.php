<div class="row">
    <div class="col-md-12">
        <a href="operating-system.php?source=add_question" class="btn btn-primary">Add Question</a>
    </div>
</div>
<div class="mb-5"></div>



<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Qstn</th>
                    <th>a</th>
                    <th>b</th>
                    <th>c</th>
                    <th>d</th>
                    <th>correct</th>
                    <th>Explanation</th>
                    <th>Posted-By</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                include_once ("../includes/functions.php");
                $resultset = getAllQuestions("operating_system");
                while($row = mysqli_fetch_assoc($resultset)){
                    $question_id = $row['question_id'];
                    $question = $row['question'];
                    $option_a = $row['option_a'];
                    $option_b = $row['option_b'];
                    $option_c = $row['option_c'];
                    $option_d = $row['option_d'];
                    $correct_answer = $row['correct_answer'];
                    $explanation = $row['explanation'];
                    $posted_by = $row['posted_by'];

                    echo<<<QUESTION
<tr>
<td>$question_id</td>
<td>$question</td>
<td>$option_a</td>
<td>$option_b</td>
<td>$option_c</td>
<td>$option_d</td>
<td>$correct_answer</td>
<td>$explanation</td>
<td>$posted_by</td>
<td><a href="operating-system.php?source=edit_question&question_id=$question_id" class="btn btn-info"><span class="fa fa-edit"></span></a></td>
<td><a href="operating-system.php?source=delete_question&question_id=$question_id" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>

</tr>

QUESTION;

                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>