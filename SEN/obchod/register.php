<?php
  include ("header.php");
  require ("functions.php");

  if (isset($_POST["submit"])) {
    if ($_POST["pass1"] == $_POST["pass2"]) {
      $connection = connect("localhost", "revajova.e", "revajova.e");
      $sql = "INSERT INTO `users` (`use_id`, `username`, `password`) VALUES (2, '".$_POST["user"]."', '".$_POST["pass"]."');";
      $result = $connection->query ($sql);
      $_SESSION["user"] = $row["username"];
      $_SESSION["UID"] = $row["UID"];
      header ("location: index.php");
    }
  }
?>

<form method="post">
  <p> Username: <input type="text" name="user"> </p>
  <p> Password: <input type="password" name="pass1"> </p>
  <p> Repeat password: <input type="password" name="pass2"> </p>
  <p> <input type="submit" name="submit" value="Create account"> </p>
</form>
