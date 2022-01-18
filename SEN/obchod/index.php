<?php
  include ("header.php");

  echo "<h1> domovská stránka :) </h1>";
  if (isset($_SESSION["logout"])) {
    echo $_SESSION["logout"];
    session_destroy();
  }
?>
