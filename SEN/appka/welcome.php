<?php
  include ("header.php");

  if (isset($_SESSION["user"])) {
    echo "<h1>WELCOME</h1>";
  } else {
    echo "<h1>forbidden</h1>";
  }

?>
