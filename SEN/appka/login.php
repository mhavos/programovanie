<?php
  include ("header.php");

  $users = array(
    array("user" => "yeetus", "pass" => "bruh"),
    array("user" => "lol", "pass" => "rekt"),
    array("user" => "lomen", "pass" => "heslo123456")
  );

  if (isset($_POST["submit"])) {
    $nasiel = False;
    for ($i = 0; $i < count($users); $i++) {
      if ($users[$i]["user"] == $_POST["user"] and $users[$i]["pass"] == $_POST["pass"]) {
        $nasiel = True;
      }
    }
    if ($nasiel) {
      header("location: welcome.php");
    } else {
      echo "<h1> Incorrect username or password </h1>";
    }
  }
?>

<form method="post">
  <p> Username: <input type="text" name="user"> </p>
  <p> Password: <input type="password" name="pass"> </p>
  <p> <input type="submit" name="submit" value="Odošli"> </p>
</form>
