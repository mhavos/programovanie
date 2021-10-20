<body>
  <p style="font-family:monospace">
    <?php

      $nums = array();
      for ($i = 0; $i < 100000; $i++) {
        array_push($nums, rand(0, 100));
      }
      $average = 0;
      for ($i = 0; $i < count($nums); $i++) {
        echo $nums[$i]." ";
        $average = $average + $nums[$i];
      }
      if (count($nums) != 0) {
        $average = $average / count($nums);
      }
      echo "<br>".$average;

    ?>
  </p>
</body>
