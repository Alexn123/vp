<?php
 require("usesession.php");
 require("../../../config.php");
 require("fnc_personmovies.php");
 require("fnc_common.php");
 $genreerror ="";
 $descriptionerror ="";
 $selectedgenre ="";
 $notice ="";
 
 $genre = "";
 $description = "";

 
 if(isset($_POST["genresubmit"])){
	  
	  if (!empty($_POST["genreinput"])){
		$genre = test_input($_POST["genreinput"]);
	  } else {
		  $genreerror = "Sisesta zanr!";
	  }
	  if(!empty($_POST["descriptioninput"])){
		  $description = test_input($_POST["descriptioninput"]);
	  } else {
		  $descriptionerror = "Sisestage kirjeldus!";
	  }
	  
	  $selectedgenre = ($_POST["genreinput"]);
	  if(empty($genreerror)and empty($descriptionerror)){
		$result = savegenre($genre, $description);
		if($result == "ok"){
			$notice = "zanr lisatud!";
			$genre="";
			$description= "";
		} else {
			$notice = "ebaõnnestus" .$result;
		}
	  }
   }
 
 require("header.php");
 ?>
 <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
 <h1>Uue žanri sisestamine</h1>   
 <a href="home.php">Tagasi avalehele</a>
 <hr>
 <body>
 <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
 <label for="genreinput">žanr:</label><br>
 <input name="genreinput" id="genreinput" type="text" value="<?php echo $genre; ?>"><span><?php echo $genreerror; ?></span>
 <br>
 <p><a href="?logout=1">Logi välja</a>!</p>
 </html>
 