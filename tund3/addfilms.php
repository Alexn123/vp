<?php
  $username = "Alex Nelke";
  require("usesession.php");
  require("header.php");
  require("../../../config.php");
  require("fnc_film.php");
  
  $inputerror = "";
  $filmhtml = "";
  //kas vajutati salvestusnuppu
  if(isset($_POST["filmsubmit"])){
	  if(empty($_POST["titleinput"]) or empty($_POST["yearinput"]) or empty($_POST["durationinput"]) or empty($_POST["genreinput"]) or empty($_POST["studioinput"]) or empty($_POST["directorinput"])) {
		  $inputerror .= "Osa infost on sisestamata";
	  }
	  if($_POST["yearinput"] < 1895 or $_POST["yearinput"] > date("Y")){
		  $inputerror .= "Ebareaalne valmimisaasta";
	  }
	  if(empty($inputerror)){
		  $storeinfo = storefilminfo($_POST["titleinput"], $_POST["yearinput"], $_POST["durationinput"], $_POST["genreinput"], $_POST["studioinput"], $_POST["directorinput"]);
		  if($storeinfo == 1){
			  $filmhtml = readfilms(1);
		  } else {
			  $filmhtml = "<p>filmiinfo salvestamine ei õnnestunud </p>";
		  }
	  }
  }

  $filmhtml = readfilms(1);
  
?>

  <img src="../img/vp_banner.png" alt="veebiprogrammeerimise kursuse banner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <hr>
  
<ul>
  <li><a href="home.php">tagasi avalehele</a></li>
  
</ul>

<form method="POST">
	<label for="titleinput">Filmi pealkiri</label>
	<input type="text" name="titleinput" id="titleinput" placeholder="Filmi pealkiri">
	<br>
	<label for="yearinput">Filmi valmimisaasta</label>
	<input type="number" name="yearinput" id="yearinput" value="<?php echo date("Y"); ?>">
	<br>
	<label for="durationinput">Filmi pikkus</label>
	<input type="number" name="durationinput" id="durationinput" value="90">
	<br>
	<label for="genreinput">Filmi žanr</label>
	<input type="text" name="genreinput" id="genreinput" placeholder="Filmi žanr">
	<br>
	<label for="studioinput">Filmi tootja</label>
	<input type="text" name="studioinput" id="studioinput" placeholder="Filmi stuudio">
	<br>
	<label for="directorinput">Filmi lavastaja</label>
	<input type="text" name="directorinput" id="directorinput" placeholder="Filmi lavastaja">
	<br>
	<input type="submit" name="filmsubmit" value="Salvesta filmi info">
</form>
<p><?php echo $inputerror; ?>
<hr>
<?php echo $filmhtml; ?>
<hr>
</body>
</html>