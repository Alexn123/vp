<?php
 require("usesession.php");
 require("../../../config.php");
 require("fnc_personmovies.php");
 require("fnc_common.php");
 $companyerror ="";
 $addresserror ="";
 $notice = "";
 $selectedcompany="";
 
 
 $company = "";
 $address = "";
 

 if(isset($_POST["companysubmit"])){
	  
	  if (!empty($_POST["companyinput"])){
		$company = test_input($_POST["companyinput"]);
	  } else {
		  $companyerror = "Sisesta stuudio!";
	  }
	  
	  if(!empty($_POST["addressinput"])){
		  $address = test_input($_POST["addressinput"]);
	  } else {
		  $addresserror = "Sisestage aadress!";
	  }
	  $selectedcompany = ($_POST["companyinput"]);
	  if(empty($companyerror)and empty($addresserror)){
		$result = savecompany($selectedcompany, $address);
		if($result == "ok"){
			$notice = "stuudio lisatud!";
			$company="";
			$address= "";
		} else {
			$notice = "ebaõnnestus " .$result;
		}
	  }
   }
 
 require("header.php");
 ?>
 <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
 <h1>stuudio sisestamine</h1>   
 <a href="home.php">Tagasi avalehele</a>
 <hr>
 <body>
 <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
 <label for="companyinput">stuudio:</label><br>
 <input name="companyinput" id="companyinput" type="text" value="<?php echo $company; ?>"><span><?php echo $companyerror; ?></span>
 <br>
 <p><a href="?logout=1">Logi välja</a>!</p>
 </html>