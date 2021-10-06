<body>
  <p style="font-family:monospace">
    <?php

      function factorial($a) {
        if ($a == 0) return 1;
        return $a * factorial($a - 1);
      }

      $fibs = array(0, 1);
      function fibonacci($a) {
        global $fibs;
        if ($a < count($fibs)) {
          return $fibs[$a];
        }
        else {
          $fibs[$a] = $fibs[$a - 1] + $fibs[$a - 2];
          return $fibs[$a];
        }
      }

      $a = 50;
      // echo $a."! = ".factorial($a)."<br>";
      for ($i = 0; $i < $a; $i++) {
        echo fibonacci($i)."<br>";
      }

    ?>
  </p>
</body>
