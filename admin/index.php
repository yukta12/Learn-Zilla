<?php
    $page_title ="teacher dashboard";
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


        <body id="page-top" class="sidebar-toggled">


            <!-- Navbar -->
            <?php
    include_once("includes/navigation.php");
    ?>

                <div id="wrapper">

                    <!-- Sidebar -->
                    <ul class="sidebar navbar-nav toggled">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
                        </li>
                        <li class="nav-item dropdown">
                           <a class="nav-link" href="operating-system.php">
                            <i class="fas fa-fw fa-folder"></i>
                            <span>Operating System</span>
                            </a>
                          
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Anaylsis of alogrithms</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="comments.php">
            <i class="fas fa-fw fa-wifi"></i>
            <span>Data networks</span></a>
                        </li>

                        <li class="nav-item ">
                          <a class="nav-link" href="categories.php">
                        <i class="fas fa-fw fa-database"></i>
                        <span>DataBase</span>
                    </a>
                        </li>

                       
                        <li class="nav-item">
                            <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-th-list"></i>
            <span>Software Engineering &amp; Testing</span></a>
                        </li>
                    </ul>

                    <div id="content-wrapper">

                        <div class="container-fluid">

                            <!-- Breadcrumbs-->
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">LearnZilla Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <?php echo $page_title; ?>
                                </li>
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
