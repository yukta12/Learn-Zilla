<?php
    $page_title ="Operating System";
    session_start();
    $user_id = null;
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];

    }
?>

<!DOCTYPE html>
<html lang="en">

<?php
include_once ("includes/header.php");
if($user_id == null){
    include_once ("includes/no-access.php");

}else {
    ?>


    <body id="page-top" class="">


    <!-- Navbar -->
    <?php
    include_once("includes/navigation.php");
    ?>

    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include_once("includes/sidebar.php");
        ?>

        <div id="content-wrapper">

            <div class="container-fluid">

                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">LearnZilla Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                </ol>

                <!-- Icon Cards-->
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
<div class="row">
                        <div class="col-md-12">
                          <div class="question-container">
                               <div class="row">
                           <div class="col-md-1 question">Q.</div>
                           <div class="col-md-11 ">
                            <div class="row">
                                <div class="col-md-9"><p class="question">$question</p></div>
                                <div class="col-md-3 teacher">posted by : $posted_by</div>
                            </div>
                              <div class="row">
                                  <div class="col-md-6 answer">
                                      <strong> a. </strong>$option_a
                                  </div>
                                  <div class="col-md-6 answer">
                                     <strong> b. </strong>$option_b
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6 answer">
                                      <strong> c. </strong>$option_c
                                      </div>
                                  <div class="col-md-6 answer">
                                      <strong> d. </strong>$option_d
                                  </div>
                              </div>
                               <div class="row">
                                   <div class="col-md-12 answer show_answer">
                                       <i class="fa fa-lightbulb"></i>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-12 showanswer">
                                       <div>
                                           <strong>Correct ans:  </strong> $correct_answer
                                       </div>
                                       <div><strong>Explanation :</strong> $explanation </div></div>
                               </div>
                           </div>
                            </div>
                          </div>
                        </div>
                    </div>
               


QUESTION;
                 }
    
    ?>
               
                 
            

            </div>
            <!-- /.container-fluid -->

            <?php
            include_once("includes/footer.php");
            ?>

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php
    include_once("includes/scripts_btn_to_top.php");
    ?>
<script src="js/customjs.js"></script>

    </body>
    <?php
}
?>

</html>
