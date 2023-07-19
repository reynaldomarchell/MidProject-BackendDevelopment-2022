<?php
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $user_name = $_POST['user_name'];
  $password = $_POST['password'];

  if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
    $query = "select * from users where user_name = '$user_name' limit 1";
    $result = mysqli_query($con, $query);

    if ($result) {
      if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);

        if ($user_data['password'] === $password) {
          $_SESSION['name'] = $user_data['name'];
          $_SESSION["user_name"] = $user_data["user_name"];
          $user_name = $_SESSION["user_name"];

          $tasks_result = mysqli_query($con, "SELECT task FROM tasks WHERE user_name = '$user_name'");
          while ($row = mysqli_fetch_assoc($tasks_result)) {
            $_SESSION["TASK"][] = $row["task"];
          }
          mysqli_query($con, "DELETE FROM tasks WHERE user_name = '$user_name'");

          $completed_result = mysqli_query($con, "SELECT task FROM completed WHERE user_name = '$user_name'");
          while ($row = mysqli_fetch_assoc($completed_result)) {
            $_SESSION["COMPLETED_TASK"][] = $row["task"];
          }
          mysqli_query($con, "DELETE FROM completed WHERE user_name = '$user_name'");

          header("Location: index.php");
          die;
        }
      }
    }
    echo "Wrong username or password!";

  } else {
    echo "Wrong username or password!";
  }
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
  <title>Login</title>
</head>

<body>
  <div class="login template d-flex justify-content-center align-items-center vh-100 bg-primary">
    <div class="form_container p-5 rounded bg-white">
      <form method="POST">
        <h3 class="text-center">Sign In</h3>
        <div class="mb-2">
          <label htmlFor="username">Enter your username</label>
          <input type="text" placeholder="Username" class="form-control" name="user_name">
        </div>
        <div class="mb-2">
          <label htmlFor="password">Enter your password</label>
          <input type="password" placeholder="Password" class="form-control" name="password">
        </div>
        <!-- <div class="mb-2">
          <input type="checkbox" class="custom-control custom-checkbox" id="check">
          <label htmlFor="check" class="custom-input-label ms-2">Remember me</label>
        </div> -->
        <div class="d-grid mt-2">
          <button class="btn btn-primary">Sign In</button>
        </div>
        <p class="text-end mt-2">
          Don't have account? <a href="register.php" class="ms-2">Sign Up</a>
        </p>
      </form>
    </div>
  </div>

  <script href="dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>