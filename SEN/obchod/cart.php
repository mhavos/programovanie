<?php
include ("header.php");
require ("functions.php");

echo "<h1>Shopping cart</h1>";

$connection = connect("localhost", "revajova.e", "revajova.e");

if (isset($_POST["submit2"]) and isset($_SESSION["user"])) {
  for ($pro_id = 1; $pro_id <= 5; $pro_id ++) {
    if (isset($_POST[$pro_id])) {
      $amount = $_POST[$pro_id];
      if ($amount < 0) {
        $amount = 0;
      }
      $use_id = $_SESSION["UID"];
      for ($ord_id = 1000*$use_id + 1; $ord_id < 1000*($use_id + 1); $ord_id ++) {
        $next = $ord_id + 1;
        if ($connection->query( "SELECT * FROM `orders` WHERE `ord_id`=$next;" )->num_rows == 0) {
          break;
        }
      }
      $connection->query ( "UPDATE `middle_man` SET `amount`=$amount WHERE `ord_id`=$ord_id AND `pro_id`=$pro_id;" );
    }
  }
}

if ( isset($_SESSION["user"]) ) {

  if ( isset($_POST["submit"]) ) {
    header ("location: checkout.php");
  }

  $use_id = $_SESSION["UID"];
  for ($ord_id = 1000*$use_id + 1; $ord_id < 1000*($use_id + 1); $ord_id ++) {
    $next = $ord_id + 1;
    if ($connection->query( "SELECT * FROM `orders` WHERE `ord_id` = $next;" )->num_rows == 0) {
      break;
    }
  }
  $result = $connection->query("SELECT * FROM `middle_man` WHERE `ord_id`=$ord_id AND `amount`>0;");
  if ($result->num_rows > 0) {
    $big_total = 0;
    while ($row = $result->fetch_assoc()) {
      $product = $connection->query("SELECT * FROM `products` WHERE `pro_id`=$row[pro_id];")->fetch_assoc();
      echo "<div class=part><img class=part src='images/$product[pro_id].png' height=150>";
      $total = $product[pro_price] * $row[amount];
      $big_total += $total;
      echo "<p> $product[pro_name] <br> $product[pro_price] € x $row[amount] = <strong>$total €</strong> </p>";
      echo "<form method=post><p>Amount:<input type=number name='$row[pro_id]' placeholder='$row[amount]'></p><p> <input type='submit' name='submit2' value='Set amount'> </p></form> </div>";
    }
    echo "Total: <strong>$big_total €</strong>";
  } else {
    echo "There's nothing in your cart !!";
  }


} else {
  header ("location: index.php");
}
?>

<form method="post">
  <p> <input type=submit name=submit value="Buy stuff things etc" </p>
</form>
