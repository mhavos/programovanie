<body>
  <p style="font-family:monospace">
    <?php
      // spocitaj kolko krat sa vo vete nachadza substring
      // prekryvajuce sa pocitaju vsetky: t.j. v "tralala" sa "ala" nachadza dva krat
      $veta = "veronika a katka piju kavu.";
      $original = $veta;
      $substring = "ka";
      $pokracujem = True;
      $pocet = 0;
      while ($pokracujem) {
        $i = strpos($veta, $substring);
        if ($i) {
          $pocet++;
          $veta = substr($veta, $i + 1);
        }
        else
          $pokracujem = False;
      }
      $veta = $original;
      echo 'vo vete "' . $veta . '" sa "' . $substring . '" nachadza ' . $pocet . ' krat<br>';

      // nahradzanie samohlasok
      $hviezdickova = "";
      $bezsamohlasok = "";
      $samohlasky = "aeiouy";
      for ($i = 0; $i < strlen($veta); $i++) {
        $jesamohlaska = False;
        $pismeno = substr($veta, $i, 1);
        for ($j = 0; $j < strlen($samohlasky); $j++) {
          if ($pismeno == substr($samohlasky, $j, 1)) {
            $jesamohlaska = True;
          }
        }
        if ($jesamohlaska) {
          $hviezdickova = $hviezdickova . "*";
        }
        else {
          $hviezdickova = $hviezdickova . $pismeno;
          $bezsamohlasok = $bezsamohlasok . $pismeno;
        }
      }
      echo 'veta vyhviezdickovana: ' . $hviezdickova . '<br>';
      echo 'veta bez samohlasok: ' . $bezsamohlasok . '<br><br>';

      // Python trojuholniky: mozes zmenit $slovo a stale to funguje, aj ked ma inu dlzku
      $slovo = "Python";
      for ($i = strlen($slovo); $i > 0; $i--) {
        echo substr($slovo, 0, $i);
        echo "<br>";
      }
      echo "<br>";
      for ($i = 0; $i < strlen($slovo); $i++) {
        for ($j = 0; $j < $i; $j++) {
          // tu by idealne bola medzera ale zobrzovanie html papa whitespace takze sa to zobrazuje zle
          echo ".";
        }
        echo substr($slovo, $i, strlen($slovo) - $i);
        echo "<br>";
      }
    ?>
  </p>
</body>
