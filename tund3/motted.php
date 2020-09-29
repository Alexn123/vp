<?php
$username = "Alex Nelke";
require("header.php");
require("../../../config.php");
$database = "if20_alex_nel_1";
if(isset($_POST["ideasubmit"]) and !empty($_POST["ideainput"])){
	//loome andmebaasiga ühenduse
	 $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	 //valmistan ette sql käsu andmete kirjutamiseks
	 $stmt = $conn->prepare("INSERT INTO Myideas (idea) VALUES(?)");
	 echo $conn->error;
	 //i-integer täisarv, d-decimal komaarv, s-string sõna
	 $stmt->bind_param("s", $_POST["ideainput"]);
	 $stmt->execute();
	 $stmt->close();
	 $conn->close();
}

?>

  <img src="../img/vp_banner.png" alt="veebiprogrammeerimise kursuse banner">
  <h1><?php echo $username; ?> </h1>
  <hr>
<a href="home.php">tagasi kodulehele</a>
  <hr>
  <form method="POST">
	<label>kirjutage oma mõtteid</label>
	<input type="text" name="ideainput" placeholder="mõttekoht">
	<input type="submit" name="ideasubmit" value="saada mõte teele">
  </form>
  <hr>
</body>
</html>