<?php
//session_start();

  require("classes/SessionManager.class.php");
  //sessioonihaldus
  SessionManager::sessionStart("vp", 0, "/~alexnel/", "greeny.cs.tlu.ee");
  
require("../../../config.php");
require("fnc_common.php");
require("fnc_user.php");
$fulltimenow = date("d.F.Y H:i:s");
$hournow = date("H");
$partofday = "lihtsalt aeg";
$weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
//echo $weekdaynameset[1];
$weekdaynow = date("N");
//vb on vaja alumist?
//$monthdaynow = date("F");

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

$semesterstart = new DateTime("2020-8-31");
$semesterend = new DateTime("2020-12-13");
$semesterduration = $semesterstart->diff($semesterend);
$semesterdurationdays = $semesterduration->format("%r%a");
$today = new DateTime("now");
$fromsemesterstart = $semesterstart->diff($today);
$fromsemesterstartdays = $fromsemesterstart->format("%r%a");
$semesterpercent = $fromsemesterstartdays * 100 / $semesterdurationdays;

$allfiles = scandir("../vp_pics/");
$picfiles = array_slice($allfiles, 2);
$imghtml = "";
$piccount = count($picfiles);
$picnum = mt_rand(0, ($piccount - 1));
$imghtml .= '<img src="../vp_pics/' .$picfiles[$picnum] .'" alt="tlü">';

require("header.php");

  $allfiles = array_slice(scandir("../vp_pics/"), 2);

  $allpicfiles = [];
  $picfiletypes = ["image/jpeg", "image/png"];

  foreach ($allfiles as $file){
	  $fileinfo = getImagesize("../vp_pics/" .$file);
	  if(in_array($fileinfo["mime"], $picfiletypes) == true){
		  array_push($allpicfiles, $file);
	  }
  }

  $piccount = count($allpicfiles);
  $imghtml = "";
  $imghtml .= '<img src="../vp_pics/' .$allpicfiles[mt_rand(0, ($piccount - 1))] .'" ';
  $imghtml .= 'alt="Tallinna Ülikool">';
  
  $email = "";
  
  $emailerror = "";
  $passworderror = "";
  $notice = "";
  if(isset($_POST["submituserdata"])){
	  if (!empty($_POST["emailinput"])){
		$email = filter_var($_POST["emailinput"], FILTER_SANITIZE_EMAIL);
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);
		} else {
		  $emailerror = "sisesta õige emailiaadress!";
		}		
	  } else {
		  $emailerror = "sisesta emailiaadress!";
	  }
	  
	  if (empty($_POST["passwordinput"])){
		$passworderror = "Palun sisesta salasõna!";
	  } else {
		  if(strlen($_POST["passwordinput"]) < 8){
			  $passworderror = "Liiga lühike salasõna";
		  }
	  }
	  
	  if(empty($emailerror) and empty($passworderror)){
		  $notice = signin($email, $_POST["passwordinput"]);
	  }
  }

  require("header.php");
?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse pilt">
  <h1>sisselogimine</h1>
  <hr>
  <h3>Logi sisse</h3>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="emailinput">E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="emailinput" id="emailinput" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
	  <br>
	  <label for="passwordinput">Salasõna:</label>
	  <br>
	  <input name="passwordinput" id="passwordinput" type="password"><span><?php echo $passworderror; ?></span>
	  <br>
	  <br>
	  <input name="submituserdata" type="submit" value="Logi sisse"><span><?php echo "&nbsp; &nbsp; &nbsp;" .$notice; ?></span>
  </form>
  <hr>
  <ul>
  <li><a href="motted.php">sisesta oma mõtteid</a></li>
  <li><a href="motted2.php">vaata teiste mõtteid</a></li>
  <li><a href="listfilms.php">filmide nimekiri</a></li>
  <li><a href="addfilms.php">Filmiinfo lisamine</a></li>
  <li><a href="addnewuser.php">registreeri siin</a></li>
  </ul>
  <hr>
  <p>Lehe avamisel oli aeg: <?php echo $weekdaynameset[$weekdaynow -1 ] .", " .$fulltimenow; ?> </p>
  <p><?php echo "praegu on " .$partofday ."."; ?></p>
  <p><?php echo "semestri algusest on " .$fromsemesterstartdays ." päeva möödas, ehk on läbitud " .$semesterpercent ."% semestrist"; ?></p>
  <ul>

  <?php echo $imghtml; ?>
  
</body>
</html>