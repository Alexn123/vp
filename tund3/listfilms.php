<?php
  require("usesession.php");
  require("../../../config.php");
  #$username = "Alex Nelke";
  require("header.php");
  require("fnc_film.php");

  //$filmhtml = readfilms();
  
?>

  <img src="../img/vp_banner.png" alt="veebiprogrammeerimise kursuse banner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?> </h1>
  <hr>
  
<ul>
  <li><a href="?logout=1">Logi välja</a>!</li>
  <li><a href="home.php">tagasi avalehele</a></li>
</ul>
<?php echo readfilms(0); ?>
<hr>
</body>
</html>