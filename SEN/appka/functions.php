<?php
  function connect($server, $user, $password, $database) {
    $connection = new mysqli($server, $user, $password, $database);
    if ($connection -> connect_error) {
      die("Connection error: ".$connection -> connect_errorno);
      echo "error";
      return null;
    }
    return $connection;
  }
?>
