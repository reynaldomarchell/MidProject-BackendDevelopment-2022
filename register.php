<?php
session_start();

include "connection.php";
include "functions.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $name = $_POST["name"];
  $user_name = $_POST['user_name'];
  $password = $_POST['password'];
  $confirm_password = $_POST["confirm_password"];

  if (
    !empty($name) && !empty($user_name) && !empty($password) && !empty($confirm_password)
    && !is_numeric($user_name) && $password == $confirm_password
  ) {

    if (
      (strlen($name) >= 1 && strlen($name) <= 20) && (strlen($user_name) >= 3 && strlen($user_name) <= 15)
      && (strlen($password) >= 8 && strlen($password) <= 20)
    ) {

      $query = "insert into users (name,user_name,password) values ('$name','$user_name','$password')";

      mysqli_query($con, $query);

      header("Location: login.php");
      die;
    } else {
      echo "Please enter with the valid length!";
    }

  } else {
    echo "Please enter some valid information!";
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
  <title>Register</title>
</head>

<body>
  <div class="signup template d-flex justify-content-center align-items-center vh-100 bg-dark bg-gradient">
    <div class="form_container p-5 rounded bg-white">
      <form method="POST">
        <h3 class="text-center">Sign Up</h3>
        <div class="mb-2 mt-4">
          <label htmlFor="name">Enter your name (1-20 character)</label>
          <input type="text" placeholder="Name" class="form-control mt-2" name="name" required>
        </div>
        <div class="mb-2">
          <label htmlFor="username">Enter your username (3-15 character)</label>
          <input type="text" placeholder="Username" class="form-control mt-2" name="user_name" required>
        </div>
        <div class="mb-2">
          <label htmlFor="password">Enter your password (8-20 character)</label>
          <input type="password" placeholder="Password" class="form-control mt-2" name="password" required>
        </div>
        <div class="mb-2 mb-4">
          <label htmlFor="confirm_password">Confirmation password (same as password)</label>
          <input type="password" placeholder="Confirmation Password" class="form-control mt-2" name="confirm_password"
            required>
        </div>
        <div class="d-grid mt-2">
          <button class="btn btn-primary">Sign Up</button>
        </div>
        <p class="text-end mt-2">
          Already Registered? <a href="login.php" class="ms-2">Sign In</a>
        </p>
      </form>
    </div>
  </div>
  <script href="dist/js/bootstrap.bundle.min.js"></script>

  <!-- <h1>Register</h1>

  <form method="POST">
    Enter your name (1 - 20 character)<br>
    <input type="text" name="name"><br><br>
    Enter your username (3 - 15 character)<br>
    <input type="text" name="user_name"><br><br>
    Enter your password (8 - 20 character)<br>
    <input type="password" name="password"><br><br>
    Confirmation password (same as password)<br>
    <input type="password" name="confirm_password"><br><br>
    <input type="submit" value="Register"><br><br>
  </form>

  <a href="login.php">Click to login</a> -->

</body>

</html>