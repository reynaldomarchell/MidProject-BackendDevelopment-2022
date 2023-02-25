<?php 
session_start();

  include "connection.php";
  include "functions.php";

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST["name"];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST["confirm_password"];

    if(!empty($name) && !empty($user_name) && !empty($password) && !empty($confirm_password)
    && !is_numeric($user_name) && $password == $confirm_password){

      if((strlen($name) >= 1 && strlen($name) <= 20) && (strlen($user_name) >= 3 && strlen($user_name) <= 15)
      && (strlen($password) >= 8 && strlen($password) <= 20)){

        $query = "insert into users (name,user_name,password) values ('$name','$user_name','$password')";
  
        mysqli_query($con, $query);
  
        header("Location: login.php");
        die;
      }else{
        echo "Please enter with the valid length!";
      }

    }else{
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
  <title>Register</title>
</head>
<body>
  <h1>Register</h1>

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

  <a href="login.php">Click to login</a>

</body>
</html>