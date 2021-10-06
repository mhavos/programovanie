<body>
  <p style="font-family:monospace">
    <?php

      $total = 0;
      $samohlasky = "AEIOUYaeiouy";
      $names = array("Mike", "John", "Donald");
      array_push($names, "George", "Lea");
      for ($i = 0; $i < count($names); $i++) {
        echo "<br>".$names[$i].": ";
        for ($j = 0; $j < strlen($names[$i]); $j++) {
          $samohlaska = False;
          for ($k = 0; $k < strlen($samohlasky); $k++) {
            if ($names[$i][$j] == $samohlasky[$k])
              $samohlaska = True;
          }
          if ($samohlaska == False) {
            echo $names[$i][$j];
            $total++;
          }
        }
      }
      echo "<br> Spolu -hlasok: ".$total;

    ?>
  </p>
</body>
