<?php
  $username = "Alex Nelke";
  require("header.php");
  require("../../../config.php");
  require("fnc_film.php");

  $filmhtml = readfilms();
  
?>

  <img src="../img/vp_banner.png" alt="veebiprogrammeerimise kursuse banner">
  <h1><?php echo $username; ?> </h1>
  <hr>
  
<ul>
  <li><a href="home.php">tagasi avalehele</a></li>
</ul>
<?php echo readfilms(0); ?>
<hr>
</body>
</html>