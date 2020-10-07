<?php

require("usesession.php");

//$username = "Alex Nelke";
$fulltimenow = date("d.F.Y H:i:s");
$hournow = date("H");
$partofday = "lihtsalt aeg";
$weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
//echo $weekdaynameset[1];
$weekdaynow = date("N");
//vb on vaja alumist?
$monthdaynow = date("F");

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
$picnum = mt_rand(0, ($piccount - 1));
//$i = $1 + 1;
//$i ++;
//for($i = 0;$i < $piccount; $i ++){}
$imghtml .= '<img src="../vp_pics/' .$picfiles[$picnum] .'" alt="tlü">';

require("header.php");
?>


  <img src="../img/vp_banner.png" alt="veebiprogrammeerimise kursuse banner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?> </h1>
  <p><a href="?logout=1">logi välja</a></p>
  <li><a href="motted.php">sisesta oma mõtteid</a></li>
  <li><a href="motted2.php">vaata teiste mõtteid</a></li>
  <li><a href="listfilms.php">filmide nimekiri</a></li>
  <li><a href="addfilms.php">Filmiinfo lisamine</a></li>
  <li><a href="userprofile.php">minu profiil</a></li>
  </ul>
  <hr>
  <p>Lehe avamisel oli aeg: <?php echo $weekdaynameset[$weekdaynow -1 ] .", " .$fulltimenow; ?> </p>
  <p><?php echo "praegu on " .$partofday ."."; ?></p>
  <p><?php echo "semestri algusest on " .$fromsemesterstartdays ." päeva möödas, ehk on läbitud " .$semesterpercent ."% semestrist"; ?></p>
  <ul>
  <hr>
  <?php echo $imghtml;?>
  <hr>
</body>

</html>