<?php
  include ("header.php");

  if (isset($_SESSION["user"])) {
    echo "<h1>WELCOME</h1>";
    echo "<a href='logout.php'>Logout<a>";
  } else {
    echo "<h1>forbidden</h1>";
  }

?>
