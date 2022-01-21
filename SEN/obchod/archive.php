<?php
include ("header.php");
require ("functions.php");

echo "<h1>Order archive</h1>";

$connection = connect("localhost", "revajova.e", "revajova.e");

if ( isset($_SESSION["user"]) ) {

  $use_id = $_SESSION["UID"];

  for ($ord_id = 1000*$use_id + 1; $ord_id < 1000*($use_id + 1); $ord_id++) {
    if ($connection->query("SELECT * FROM `orders` WHERE `ord_id`=$ord_id;")->num_rows == 0) {
      break;
    }
    $result = $connection->query("SELECT * FROM `middle_man` WHERE `ord_id`=$ord_id AND `amount`>0;");
    if ($result->num_rows > 0) {
      echo "<div class=part>";
      $big_total = 0;
      while ($row = $result->fetch_assoc()) {
        $product = $connection->query("SELECT * FROM `products` WHERE `pro_id`=$row[pro_id];")->fetch_assoc();
        echo "<div class=part>";
        $total = $product["pro_price"] * $row["amount"];
        $big_total += $total;
        echo "<p> $product[pro_name] <br> $product[pro_price] € x $row[amount] = <strong>$total €</strong> </p></div>";
      }
      echo "Total: <strong>$big_total €</strong>";
      echo "</div>";
    }
  }

} else {
  header ("location: index.php");
}
?>
