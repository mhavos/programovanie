<table>
  <?php
  include ("header.php");
  require ("functions.php");

  $connection = connect("localhost", "revajova.e", "revajova.e");

  if ( isset($_SESSION["user"]) ) {

    $use_id = $_SESSION["UID"];
    for ($ord_id = 1000*$use_id + 1; $ord_id < 1000*($use_id + 1); $ord_id ++) {
      $next = $ord_id + 1;
      if ($connection->query( "SELECT * FROM `orders` WHERE `ord_id` = $next;" )->num_rows == 0) {
        break;
      }
    }
    $result = $connection->query("SELECT * FROM `middle_man` WHERE `ord_id`=$ord_id;");
    if ($result->num_rows > 0) {
      echo "<tr> <th>mid_id</th> <th>pro_id</th> <th>ord_id</th> <th>amount</th> </tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr> <td>$row[mid_id]</td> <td>$row[pro_id]</td> <td>$row[ord_id]</td> <td>$row[amount]</td> </tr>";
      }
    } else {
      echo "0 results";
    }

  } else {
    header ("location: index.php");
  }
  ?>
</table>
