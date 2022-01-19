<table>
  <?php
    include ("header.php");
    require ("functions.php");

    $connection = connect("localhost", "revajova.e", "revajova.e");

    if (isset($_POST["submit"])) {
      $sql = $_POST["sql"];
      if ($sql == "") {
        $sql = "SELECT * FROM `users`;";
      }
      $result = $connection->query ($sql);

    } else {
      $sql = "SELECT * FROM `users`;";
      $result = $connection->query ($sql);
    }

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

<form method="post">
  <p> Query:<br> <input type="text" name="sql" placeholder="SELECT * FROM users;" style="width:800px;"> </p>
  <p> <input type="submit" name="submit" value="Submit"> </p>
</form>
