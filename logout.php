<?php

include "connection.php";

session_start();

  if(isset($_SESSION['name'])){

    $user_name = $_SESSION["user_name"];

    foreach($_SESSION["TASK"] as $task){
      mysqli_query($con, "INSERT INTO tasks (user_name,task) VALUES ('$user_name','$task')");
    }
    
    foreach($_SESSION["COMPLETED_TASK"] as $task){
      mysqli_query($con, "INSERT INTO completed (user_name,task) VALUES ('$user_name','$task')");
    }

  }
  session_destroy();

  header("Location: login.php");
  die;