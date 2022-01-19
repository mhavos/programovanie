<?php
  require (".password.php");

  function connect($server, $user, $database) {
    GLOBAL $password;
    $connection = new mysqli($server, $user, $password, $database);
    if ($connection -> connect_error) {
      die("Connection error: ".$connection -> connect_error_no);
      echo "error";
      return null;
    }
    return $connection;
  }
?>
