<?php 

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST["task-name"])){
    if(strlen($_POST["task-deadline"]) > 0){
      $_SESSION["TASK"][] = $_POST["task-name"]." - ".$_POST["task-deadline"];
    }
    elseif(strlen($_POST["task-name"]) > 0){
      $_SESSION["TASK"][] = $_POST["task-name"];
    }
  }
  elseif(isset($_POST["completed-index"])){
    $task = $_SESSION["TASK"][$_POST["completed-index"]];
    $_SESSION["COMPLETED_TASK"][] = $task;
    $i = 0;
    while(true){
      if($_SESSION["TASK"][$i] == $task){
        unset($_SESSION["TASK"][$i]);
        break;
      }
      $i++;
    }
  }
  elseif(isset($_POST["restored-index"])){
    $task = $_SESSION["COMPLETED_TASK"][$_POST["restored-index"]];
    $i = 0;
    while(true){
      if($_SESSION["COMPLETED_TASK"][$i] == $task){
        $_SESSION["TASK"][] = $task;
        unset($_SESSION["COMPLETED_TASK"][$i]);
        break;
      }
      $i++;
    }
  }
  elseif(isset($_POST["deleted-index"])){
    $task = $_SESSION["TASK"][$_POST["deleted-index"]];
    $i = 0;
    while(true){
      if($_SESSION["TASK"][$i] == $task){
        unset($_SESSION["TASK"][$i]);
        break;
      }
      $i++;
    }
  }
}

header("Location: index.php");