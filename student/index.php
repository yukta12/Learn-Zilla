<?php
    $page_title ="Student";
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
