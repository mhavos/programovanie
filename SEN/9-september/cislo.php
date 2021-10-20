<body>
  <p>
    <?php
      echo "+421";
      $este = 4;
      for ($i = 0; $i < 9; $i++) {
        if ($i % 3 == 0)
          echo " ";
        if (rand(0, 8 - $i) < $este) {
          $este--;
          $bold = True;
        }
        else {
          $bold = False;
        }
        echo $bold ? "<b>".rand(0, 9)."</b>" : rand(0, 9);
      }
    ?>
  </p>
</body>
