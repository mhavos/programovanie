<?php
session_start()
?>
<head>
  <link href="styles.css" rel="stylesheet" type="text/css">
  <title><?php echo $_SERVER['PHP_SELF']; ?></title>
</head>
<header>
  <h1> Magic Candy Store </h1>
  <div>
    <nav><list>
      <a href="index.php">Homepage</a>
      <a href="login.php">Login</a>
      <?php
      if ( isset($_SESSION["user"]) ) {
        echo '<a href="cart.php">Cart</a> ';
        echo '<a href="archive.php">Archive</a>';
      }
      ?>
    </list></nav>
  </div>
  <div>
    <?php
    if ( isset($_SESSION["user"]) ) echo "You are logged in as ". $_SESSION["user"]. ". <a href=\"logout.php\">Logout</a>";
    ?>
  </div>
</header>
