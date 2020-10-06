<?php
  $username = "Alex Nelke";
  require("header.php");
  
  $firstname = "";
  $lastname = "";
  $email = "";
  $gender = "";
  $password = "";
  $passwordsecondary = "";
  
  $firstnameerror = "";
  $lastnameerror = "";
  $emailerror = "";
  $gendererror = "";
  $passworderror = "";
  $passwordsecondaryerror = "";
  $storeinfo = "";
  
  if(isset($_POST["accountsubmit"])){
	  $firstname = $_POST["firstnameinput"];
      $lastname = $_POST["lastnameinput"];
      $email = $_POST["emailinput"];
      $gender = $_POST["genderinput"];
 
      if(empty($_POST["firstnameinput"])){
          $firstnameerror = "Sisestage eesnimi.";
      }
      if(empty($_POST["lastnameinput"])){
          $lastnameerror = "Sisestage perekonnanimi.";
      }
      if(empty($_POST["emailinput"])){
          $emailerror = "Sisestage email.";
	  }
      if(empty($_POST["genderinput"])){
          $gendererror = "Sisestage oma sugu.";
      }
      if(strlen($_POST["passwordinput"]) < 8){
          $passworderror = "Liiga lühike parool.";
      }
      if(($_POST["passwordinput"]) != ($_POST["passwordsecondaryinput"])){
          $passwordsecondaryerror = "Paroolid on erinevad.";
      }
      if(empty($firstnameerror) and empty($lastnameerror) and empty($emailerror) and empty ($gendererror) and empty($passworderror) and empty($passwordsecondaryerror)){
          $storeinfo = "done";
      }
  }
?>

  <img src="../img/vp_banner.png" alt="veebiprogrammeerimise kursuse banner">
  <h1><?php echo $username; ?> </h1>
  <hr>
  <a href="home.php">tagasi kodulehele</a>
  <hr>
  <form method="POST">
    <label for="firstnameinput">Sisesta oma eesnimi</label>
	<input type="text" name="firstnameinput" id="firstnameinput" value="<?php echo $firstname; ?>">
	<span><?php echo $firstnameerror; ?></span>
	<br>
	<label for="lastnameinput">Sisesta oma perekonnanimi</label>
	<input type="text" name="lastnameinput" id="lastnameinput" value="<?php echo $lastname; ?>">
	<span><?php echo $lastnameerror; ?></span>
	<br>
    <input type="radio" name="genderinput" id="genderfemale" value="2" <?php if($gender == "2"){echo " checked";}?>>
	<label for="genderfemale">naine</label>
    <input type="radio" name="genderinput" id="gendermale" value="1" <?php if($gender == "1"){echo " checked";}?>>
	<label for="gendermale">mees</label>
	<span><?php echo $gendererror; ?></span>
	<br>
	<label for="emailinput">Sisesta enda emaili aadress</label>
	<input type="text" name="emailinput" id="emailinput" value="<?php echo $email; ?>">
	<span><?php echo $emailerror; ?></span>
	<br>
	<label for="passwordinput">Sisesta enda parool</label>
	<input type="password" name="passwordinput" id="passwordinput" placeholder="parool">
	<span><?php echo $passworderror; ?></span>
	<br>
	<label for="passwordsecondaryinput">Sisesta enda parool uuesti</label>
	<input type="password" name="passwordsecondaryinput" id="passwordsecondaryinput" placeholder="parool uuesti">
	<span><?php echo $passwordsecondaryerror; ?></span>
	<br>
	<input type="submit" name="accountsubmit" value="Salvesta konto">
	<p><?php echo $storeinfo; ?></p>
  </form>
 </body>
</html>