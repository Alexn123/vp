<?php
$username = "Alex Nelke";
//var_dump($_POST);
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

//loen andmebaasist senised mõtted
$ideahtml = "";
$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
$stmt = $conn->prepare("SELECT idea FROM Myideas");
//seon tulemuse muutujaga
$stmt->bind_result($ideafromdb);
$stmt->execute();
while($stmt->fetch()){
	$ideahtml .= "<p>" .$ideafromdb ."</p>";
}
$stmt->close();
$conn->close();
require("header.php");
?>

  <img src="../img/vp_banner.png" alt="veebiprogrammeerimise kursuse banner">
  <h1><?php echo $username; ?> </h1>
  <hr>
  <a href="home.php">tagasi kodulehele</a>
  <hr>
  <?php echo $ideahtml; ?>
</body>
</html>