<?php


if(isset($_GET['question_id'])){
    $question_id = $_GET['question_id'];
    include_once ("../includes/connection.php");

    $query = "DELETE FROM operating_system WHERE question_id = $question_id";

    mysqli_query($connection,$query);
    if(mysqli_errno($connection)){
        die(mysqli_error($connection));
    }else{
        header("Location: operating-system.php");
    }
}