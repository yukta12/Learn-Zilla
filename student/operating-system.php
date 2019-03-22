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
     
               
                    <div class="row">
                        <div class="col-md-12">
                          <div class="question-container">
                               <div class="row">
                           <div class="col-md-1 question">Q.</div>
                           <div class="col-md-11 ">
                            <p class="question">What is operating system?</p>
                              <div class="row">
                                  <div class="col-md-6 answer">
                                      a. collection of programs that manages hardware resources
                                  </div>
                                  <div class="col-md-6 answer">
                                      b. collection of programs that manages hardware resources
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6 answer">
                                      c. collection of programs that manages hardware resources
                                  </div>
                                  <div class="col-md-6 answer">
                                      d. collection of programs that manages hardware resources
                                  </div>
                              </div>
                               <div class="row">
                                   <div class="col-md-12 answer">
                                       <i class="fa fa-lightbulb"></i>
                                   </div>
                               </div>
                           </div>
                            </div>
                          </div>
                        </div>
                    </div>
               
            

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


    </body>
    <?php
}
?>

</html>
