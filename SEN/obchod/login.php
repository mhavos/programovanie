<?php
  include ("header.php");
  require ("functions.php");

  if (isset($_POST["submit"])) {
    $connection = connect("localhost", "revajova.e", "revajova.e");
    $sql = "SELECT * FROM `users` WHERE `username`='".$_POST["user"]."' AND `password`='".$_POST["pass"]."';";
    $result = $connection->query ($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $_SESSION["user"] = $row["username"];
      $_SESSION["UID"] = $row["UID"];
      header ("location: index.php");
    } else {
      echo "Username or password is incorrect.";
    }
  }
?>

<div><br>Don't have an account? <a class="dark" href="register.php">Register now!</a></div>

<form method="post">
  <p> Username: <input type="text" name="user"> </p>
  <p> Password: <input type="password" name="pass"> </p>
  <p> <input type="submit" name="submit" value="Login"> </p>
</form>
