<?php

include_once ("connection.php");
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
   
    $query = "SELECT * FROM `teacher-users` WHERE email =?";
   
    
     $ps = mysqli_prepare($connection , $query);
    mysqli_stmt_bind_param($ps,'s',$email);
    mysqli_stmt_execute($ps);
    $rs = mysqli_stmt_get_result($ps);
    $db_password = "";
    while ($row = mysqli_fetch_assoc($rs)){
        $user_id = $row['user_id'];
        $db_password = $row['password'];
        $email = $row['email'];
    }
    if($password == $db_password){
        
        if(!isset($_SESSION['user_id'])){
            session_start();
        }
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
    //die($_SESSION['email']);
        header("Location: ../admin/admin-index.php");
    }else{
        echo "login unsuccesfull";
    }
}