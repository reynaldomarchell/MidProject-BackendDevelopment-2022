<?php
session_start();
include "connection.php";
include "functions.php";

$user_data = check_login($con);

if (isset($_SESSION["TASK"])) {
  $tasks = $_SESSION["TASK"];
}
if (isset($_SESSION["COMPLETED_TASK"])) {
  $completed_task = $_SESSION["COMPLETED_TASK"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>To-do list</title>
</head>

<body>
  <div class="home template d-flex justify-content-center align-items-center vh-100 bg-dark bg-gradient">
    <div class="form_container p-4 rounded bg-white">
      <h3 style="display: inline-block">Hello, </h3>
      <?php
      $display_name = $user_data['name'];
      echo "<h3 style=\"display: inline-block\">$display_name</h3>";
      ?>
      <div class="d-grid mt-1 mb-2">
        <a href="logout.php">
          <button class="btn btn-danger btn-sm">Log Out</button>
        </a>
      </div>
      <div class="mb-2">
        <form action="request.php" method="POST">
          <h5>Add New Task</h5>
          <label for="task-name">Task Name</label>
          <input type="text" name="task-name" placeholder="Task Name" class="form-control"> <br>
          <label for="task-deadline">Deadline</label>
          <input type="date" name="task-deadline" class="form-control"> <br>
          <div class="d-grid">
            <button class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>

      <h4>Task</h4>
      <ul>
        <?php
        $isNothing = false;
        if (isset($tasks) && !empty($tasks))
          foreach ($tasks as $key => $task):
            ?>
            <li>
              <?php
              $isNothing = true;
              echo "<h6>$task</h6>";
              ?>
              <form action="request.php" method="POST" style="display: inline-block">
                <input type="hidden" value="<?= $key; ?>" name="completed-index">
                <button class="btn btn-outline-primary btn-sm">Done</button>
              </form>
              <form action="request.php" method="POST" style="display: inline-block">
                <input type="hidden" value="<?= $key; ?>" name="deleted-index">
                <button class="btn btn-outline-secondary btn-sm">Delete</button>
              </form>
            </li>
            <?php
          endforeach;
        if (!$isNothing) {
          echo "<h6>There's no task todo</h6>";
        }
        ?>
      </ul>

      <h4>Completed Task</h4>
      <ul>
        <?php
        $isEmpty = false;
        if (isset($completed_task) && !empty($completed_task))
          foreach ($completed_task as $key => $task):
            ?>
            <li>
              <s>
                <?php
                $isEmpty = true;
                echo "<h6>$task</h6>";
                ?>
                <form action="request.php" method="POST" style="display: inline-block">
                  <input type="hidden" value="<?= $key; ?>" name="restored-index">
                  <button class="btn btn-outline-primary btn-sm">Restore</button>
                </form>
              </s>
            </li>
            <?php
          endforeach;
        if (!$isEmpty) {
          echo "<h6>There's no completed task</h6>";
        }
        ?>
      </ul>
    </div>
  </div>

  <script href="dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>