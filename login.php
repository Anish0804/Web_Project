<?php
require 'config.php';
session_start();
if(!empty($_SESSION["usn"])){
  header("Location: index1.php");
}
if(isset($_POST["submit"])){
  $usn = $_POST["usn"];
  $password = $_POST["password"];
  $hashed_pass=password_hash($password,PASSWORD_DEFAULT);
  $result = mysqli_query($conn, "SELECT * FROM studentinfo WHERE usn = '$usn'");
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0){
    if(password_verify($password,$row['password'])){
      $_SESSION["login"] = true;
      $_SESSION["usn"] = $row["usn"];
      header("Location: index1.php");
    }
    else{
      echo
      "<script> alert('Wrong Password'); </script>";
    }
  }
  else{
    echo
    "<script> alert('User Not Registered'); </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <h2>Login</h2>
    <form class="" action="" method="post" autocomplete="off">
      <label for="usn">USN : </label>
      <input type="text" name="usn" id = "usn" > <br>
      <label for="password">Password : </label>
      <input type="password" name="password" id = "password" > <br>
      <button type="submit" name="submit">Login</button>
    </form>
    <br>
    <a href="registration.php">Registration</a>
  </body>
</html>