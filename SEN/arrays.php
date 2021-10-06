<body>
  <p style="font-family:monospace">
    <?php

      $dictionary = array("Mike" => 5, "John" => 21, "Donald" => 33);
      // echo '$dictionary = array("Mike" => 5, "John" => 21, "Donald" => 33);<br>';
      // echo '$dictionary["Mike"]: '.$dictionary["Mike"]."<br><br>";

      $names = array("Abigail", "Benjamin", "Cheryl", "Daniel", "Emily", "Fabian", "George", "Helen", "Iris", "James", "Kevin", "Lucy", "Matea", "Noelle", "Orwell", "Percy", "Quinn", "Razz", "Sarah", "Tracy", "Uuu", "Valery", "Wally", "Xylophone", "Yeetus", "Zoe");

      $keys = array("Name", "Height", "Age");
      $records = array();

      echo "<table><tr>";
      for ($i = 0; $i < count($keys); $i++) {
        echo "<th>".$keys[$i]."</th>";
      }
      for ($j = 0; $j < 10; $j++) {
        $records["Name"] = $names[rand(0, count($names) - 1)];
        $records["Height"] = rand(120, 220);
        $records["Age"] = rand(18, 100);

        echo "</tr><tr>";
        for ($i = 0; $i < count($keys); $i++) {
          echo "<td>".$records[$keys[$i]]."</td>";
        }
      }
      echo "</tr></table>";

    ?>
  </p>
</body>
