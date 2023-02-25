<?php
session_start();
  include "connection.php";
  include "functions.php";

  $user_data = check_login($con);

  if(isset($_SESSION["TASK"])){
    $tasks = $_SESSION["TASK"];
  }
  if(isset($_SESSION["COMPLETED_TASK"])){
    $completed_task = $_SESSION["COMPLETED_TASK"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mid Project BNCC</title>
</head>
<body>
  <h1 style="display: inline-block">Hello, </h1>
  <?php
    $display_name = $user_data['name'];
    echo "<h1 style=\"display: inline-block\">$display_name</h1>";
  ?>
  <a href="login.php">
    <button>Logout</button>
  </a>
  
  <form action="request.php" method="POST">
    <b> <label for="">Add New Task : </label> </b><br>
    Task Name : <input type="text" name="task-name" placeholder="Task Name"> <br>
    Deadline : <input type="date" name="task-deadline"> <br>
    <input type="submit" value="Submit">
  </form>

  <h1>Task</h1>
  <ol>
    <?php
      $isNothing = false;
      if(isset($tasks) && !empty($tasks))
      foreach($tasks as $key => $task) : 
    ?>
      <li>
        <?php 
        $isNothing = true;
        echo $task;
        ?>
        <form action="request.php" method="POST" style="display: inline-block">
          <input type="hidden" value="<?= $key; ?>" name="completed-index">
          <button>Done</button>
        </form>
        <form action="request.php" method="POST" style="display: inline-block">
          <input type="hidden" value="<?= $key; ?>" name="deleted-index">
          <button>Delete</button>
        </form>
      </li>
    <?php 
      endforeach;
      if(!$isNothing){
        echo "There's no task todo";
      }
    ?>
  </ol>

  <h1>Completed Task</h1>
  <ul>
    <?php
      $isEmpty = false;
      if(isset($completed_task) && !empty($completed_task))
      foreach($completed_task as $key => $task) : 
    ?>
    <li>
      <s>
        <?php 
        $isEmpty = true;
        echo $task;
        ?>
        <form action="request.php" method="POST" style="display: inline-block">
          <input type="hidden" value="<?= $key; ?>" name="restored-index">
          <button>Restore</button>
        </form>
      </s>
    </li>
    <?php 
      endforeach;
      if(!$isEmpty){
        echo "There's no completed task";
      }
    ?>
  </ul>
</body>
</html>