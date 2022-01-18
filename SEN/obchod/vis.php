<table>
  <?php
    include ("header.php");
    require ("functions.php");

    $connection = connect("localhost", "revajova.e", "revajova.e");
    $sql = "SELECT * FROM `users` WHERE 1;";
    $result = $connection->query ($sql);

    if ($result->num_rows > 0) {
      echo "<tr> <th>use_id</th> <th>username</th> <th>password</th> </tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr> <td>". $row["use_id"] ."</td> <td>". $row["username"] ."</td> <td>". $row["password"] ."</td> </tr>";
      }
    } else {
      echo "0 results";
    }
  ?>
</table>
