<?php

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

$username = "Alex Nelke";
$fulltimenow = date("d.m.Y H:i:s");
$hournow = date("H");
$partofday = "lihtsalt aeg";
$weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
//echo $weekdaynameset[1];
$weekdaynow = date("N");

if($hournow < 6){
	$partofday = "magamine";
}
if($hournow >= 6 and $hournow < 9){
	$partofday = "ärkamine";
}
if($hournow >= 9 and $hournow < 17){
	$partofday = "kooliaeg";
}
if($hournow >= 17 and $hournow < 22){
	$partofday = "vabaaeg";
}
if($hournow >= 22){
	$partofday = "päeva lõpp";
}

//vaatame semestri kulgemist
$semesterstart = new DateTime("2020-8-31");
$semesterend = new DateTime("2020-12-13");
//selgitame välja nende vahe ehk erinevuse
$semesterduration = $semesterstart->diff($semesterend);
//leiame päevade arvuna
$semesterdurationdays = $semesterduration->format("%r%a");
//tänane päev 
$today = new DateTime("now");
//if($fromsemesterstartdays < 0) (semester pole peale hakanud)
$fromsemesterstart = $semesterstart->diff($today);
$fromsemesterstartdays = $fromsemesterstart->format("%r%a");
$semesterpercent = $fromsemesterstartdays * 100 / $semesterdurationdays;

//loeme kataloogist piltide nimekirja
$allfiles = scandir("../vp_pics/");
$picfiles = array_slice($allfiles, 2);
$imghtml = "";
$piccount = count($picfiles);
//$i = $1 + 1;
//$i ++;
for($i = 0;$i < $piccount; $i ++){
	$imghtml .= '<img src="../vp_pics/' .$picfiles[$i] .'" alt="tlü">';
}
require("header.php");
?>


  <img src="../img/vp_banner.png" alt="veebiprogrammeerimise kursuse banner">
  <h1><?php echo $username; ?> </h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Lehe avamisel oli aeg: <?php echo $weekdaynameset[$weekdaynow -1 ] .", " .$fulltimenow ?> </p>
  <p><?php echo "praegu on " .$partofday ."."; ?></p>
  <p><?php echo "semestri algusest on " .$fromsemesterstartdays ." päeva möödas, ehk on läbitud " .$semesterpercent ."% semestrist"; ?></p>
  <hr>
  <?php echo $imghtml; ?>
  <hr>
  <form method="POST">
	<label>kirjutage oma mõtteid</label>
	<input type="text" name="ideainput" placeholder="mõttekoht">
	<input type="submit" name="ideasubmit" value="saada mõte teele">
  </form>
  <hr>
  <?php echo $ideahtml; ?>
</body>

<footer>
<img src="https://cdn.pixabay.com/photo/2017/07/11/00/24/house-2492054_960_720.png" alt="maja">

</footer>
</html>