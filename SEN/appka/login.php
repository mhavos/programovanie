<?php
  include ("header.php");

  if (isset($_POST["submit"])) {
    require ("functions.php");
    $connection = connect("localhost", "haverlik.m", "NovyZivot", "haverlik.m");
    $sql = "SELECT * FROM `users` WHERE `username`='".$_POST["user"]."' AND `Password`='".$_POST["pass"]."';";
    $result = $connection->query ($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $_SESSION["user"] = $row["username"];
      $_SESSION["UID"] = $row["UID"];
      header ("location: welcome.php");
    } else {
      echo "Username or password is incorrect.";
    }
  }
?>

<form method="post">
  <p> Username: <input type="text" name="user"> </p>
  <p> Password: <input type="password" name="pass"> </p>
  <p> <input type="submit" name="submit" value="Odošli"> </p>
</form>
