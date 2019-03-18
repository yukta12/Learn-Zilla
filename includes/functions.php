<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/27/2018
 * Time: 11:07 AM
 */
include_once ("connection.php");

function getAllComments($condition =1){
    global $connection;
    $sql = "SELECT * FROM comments WHERE $condition";
    $result = mysqli_query($connection, $sql);
    return $result;
}


function getAllQuestions($table_name,$condition =1){
    global $connection;
    $sql = "SELECT * from $table_name WHERE ($condition)";
    $result = mysqli_query($connection, $sql);
    return $result;
}

function getAllUsers($condition =1){
    global $connection;
    $sql = "SELECT * FROM users WHERE $condition";
    $result = mysqli_query($connection, $sql);
    return $result;
}



function getAllCategories($condition = 1)
{
    global $connection;
    $sql = "SELECT * FROM categories WHERE $condition";
    $result = mysqli_query($connection, $sql);
    $i = 0;
    $categories = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $single_category = array();
        $single_category['cat_id'] = $row['cat_id'];
        $single_category['cat_title'] = $row['cat_title'];
        $categories[$i] = $single_category;
        $i++;
    }
   return $categories;
}
//getAllCategories();

function isLoggedIn(){
    session_start();
    if(isset($_SESSION['user_id'])){
        return true;
    }
    else{
        return false;
    }
}
function startSession(){
    if(session_status() == PHP_SESSION_NONE)    {
            session_start();
    }

}


?>




