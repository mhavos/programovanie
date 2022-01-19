<?php
  include ("header.php");

  session_unset();
  $_SESSION["message"] = "You are logged out";
  header("location: index.php");
?>
