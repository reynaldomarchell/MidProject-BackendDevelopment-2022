<?php

include "connection.php";

session_start();

  if(isset($_SESSION['name'])){

    $user_name = $_SESSION["user_name"];

    $ut = $_SESSION["TASK"];
    $ct = $_SESSION["COMPLETED_TASK"];

    foreach($_SESSION["TASK"] as $val){
      mysqli_query($con, "INSERT INTO tasks (user_name, task) VALUES ('$user_name','$val')");
    }
    foreach($_SESSION["COMPLETED_TASK"] as $val){
      mysqli_query($con, "INSERT INTO completed (user_name, task) VALUES ('$user_name','$val')");
    }

  }
  session_destroy();

  header("Location: login.php");
  die;