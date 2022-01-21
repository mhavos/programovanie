<?php
  include ("header.php");
  require ("functions.php");

  if (isset($_POST["submit"])) {
    if ($_POST["pass1"] == $_POST["pass2"]) {
      $connection = connect("localhost", "revajova.e", "revajova.e");

      for ($use_id = 0; $use_id < 1000000000; $use_id++) {
        if ($connection->query("SELECT * FROM `users` WHERE `use_id`=$use_id;")->num_rows == 0) {
          break;
        }
      }
      $ord_id = 1000*$use_id + 1;

      $sql1 = "INSERT INTO `users` (`use_id`, `username`, `password`) VALUES ($use_id, '$_POST[user]', '$_POST[pass1]');";
      $sql2 = "INSERT INTO `orders` (`ord_id`, `use_id`) VALUES ($ord_id, $use_id);";
      $connection->query ($sql1);
      $connection->query ($sql2);
      $_SESSION["user"] = $_POST["user"];
      $_SESSION["UID"] = $use_id;
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
