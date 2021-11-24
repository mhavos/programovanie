<?php
  include ("header.php");

  echo "<div><h1> Toto je úvodná stránka </h1></div>";
  if (isset($_SESSION["message"])) {
    echo $_SESSION["message"];
    session_destroy();
  }
?>
