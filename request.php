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
    else{
      echo "Please input the task and deadline!";
    }
  }
  elseif(isset($_POST["completed-index"])){
    $task = $_SESSION["TASK"][$_POST["completed-index"]];
    $_SESSION["COMPLETED_TASK"][] = $task;
    for($i = 0; $i < $task; $i++){
      if($_SESSION["TASK"][$i] == $task){
        unset($_SESSION["TASK"][$i]);
        break;
      }
    }
  }
  elseif(isset($_POST["restored-index"])){
    $task = $_SESSION["COMPLETED_TASK"][$_POST["restored-index"]];
    for($i = 0; $i < $task; $i++){
      if($_SESSION["COMPLETED_TASK"][$i] == $task){
        $_SESSION["TASK"][] = $task;
        unset($_SESSION["COMPLETED_TASK"][$i]);
        break;
      }
    }
  }
  elseif(isset($_POST["deleted-index"])){
    $task = $_SESSION["TASK"][$_POST["deleted-index"]];
    for($i = 0; $i < $task; $i++){
      if($_SESSION["TASK"][$i] == $task){
        unset($_SESSION["TASK"][$i]);
        break;
      }
    }
  }
}

header("Location: index.php");