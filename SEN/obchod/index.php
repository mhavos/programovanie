<?php
  include ("header.php");
  require ("functions.php");

  echo "<h1> Browse our selection: </h1>";

  if (isset($_SESSION["logout"])) {
    echo $_SESSION["logout"];
    session_destroy();
  }

  $connection = connect("localhost", "revajova.e", "revajova.e");

  if (isset($_POST["submit"]) and isset($_SESSION["user"])) {
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
        if ($connection->query( "SELECT * FROM `middle_man` WHERE `ord_id`=$ord_id AND `pro_id`=$pro_id;" )->num_rows) {
          $connection->query ( "UPDATE `middle_man` SET `amount`=`amount`+$amount WHERE `ord_id`=$ord_id AND `pro_id`=$pro_id;" );
        } else {
          for ($mid_id = 0; 1; $mid_id ++) {
            if ($connection->query( "SELECT * FROM `middle_man` WHERE `mid_id`=$mid_id;" )->num_rows == 0) {
              break;
            }
          }
          $sql = "INSERT INTO `middle_man` (`mid_id`, `ord_id`, `pro_id`, `amount`) VALUES ('$mid_id', '$ord_id', '$pro_id', '$amount');";
          $connection->query ( $sql );
        }
      }
    }
  }

  $sql = "SELECT * FROM `products`;";
  $result = $connection->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<div class=product><p> $row[pro_name] $row[pro_price] </p>";
      echo "<img src='images/$row[pro_id].png' height=150>";
      echo "<form method=post><p>Amount:<input type=number name='$row[pro_id]' placeholder='0'></p><p> <input type='submit' name='submit' value='Add to cart'> </p></form> </div>";
    }
  } else {
    echo "0 results";
  }
?>
