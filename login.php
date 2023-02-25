<?php 
session_start();

  include("connection.php");
  include("functions.php");

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name)){
      $query = "select * from users where user_name = '$user_name' limit 1";
      $result = mysqli_query($con, $query);

      if($result){
        if($result && mysqli_num_rows($result) > 0){
          $user_data = mysqli_fetch_assoc($result);

          if($user_data['password'] === $password){
            $_SESSION['name'] = $user_data['name'];
            
            header("Location: index.php");
            die;
          }
        }
      }
      echo "Wrong username or password!";
    
    } else{
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
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>

  <form method="POST">
    Enter your username<br>
    <input type="text" name="user_name"><br><br>
    Enter your password<br>
    <input type="password" name="password"><br><br>
    <input type="submit" value="Login"><br><br>
  </form>

  <a href="register.php">Click to register</a>

</body>
</html>