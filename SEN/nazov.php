<header>
  <h1>
    Nejake veci!
  </h1>
</header>
<body>
  <?php
    $a = 0;
    $b = 1;
    for ($i = 0; $i < 20; $i++) {
      echo $a."<br>";
      $b = $a + $b;
      $a = $b - $a;
    }
  ?>
</body>
