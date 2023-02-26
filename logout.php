<?php

session_start();

  include "connection.php";

  if(isset($_SESSION['name'])){

    $user_name = $_SESSION["user_name"];
    $ut = $_SESSION["TASK"];
    $ct = $_SESSION["COMPLETED_TASK"];

    foreach($ut as $val){
      if(strlen($val) > 0){
        mysqli_query($con, "INSERT INTO tasks (user_name, task) VALUES ('$user_name','$val')");
      }
    }

    foreach($ct as $val){
      if(strlen($val) > 0){
        mysqli_query($con, "INSERT INTO completed (user_name, task) VALUES ('$user_name','$val')");
      }
    }

    // session_destroy();
    unset($_SESSION["name"]);
    unset($_SESSION["TASK"]);
    unset($_SESSION["COMPLETED_TASK"]);
  }

  header("Location: login.php");
  die;