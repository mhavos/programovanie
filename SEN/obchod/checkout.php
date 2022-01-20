<?php
  include ("header.php");
  require ("functions.php");

  $connection = connect("localhost", "revajova.e", "revajova.e");

  if (isset($_SESSION["user"])) {
    if (isset($_POST["submit"])) {
      $use_id = $_SESSION["UID"];
      for ($ord_id = 1000*$use_id + 1; $ord_id < 1000*($use_id + 1); $ord_id++) {
        if ($connection->query("SELECT * FROM `orders` WHERE `ord_id`=$ord_id;")->num_rows == 0) {
          break;
        }
      }
      $sql = "INSERT INTO `orders` (`ord_id`, `use_id`) VALUES ($ord_id, $use_id);";
      $connection->query($sql);
      header ("location: index.php");
    }
  } else {
    header ("location: index.php");
  }
?>

<form method="post">
  <p> <strong>Give me money.</strong><br>Your purchase will go through, your cart will be emptied and your order will be placed in the archive. </p>
  <p> <input type="submit" name="submit" value="ok"> </p>
</form>
