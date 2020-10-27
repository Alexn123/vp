<?php
	$database = "if20_alex_nel_1";
	
	function savegenre($selectedgenre, $description){
		$notice = "";
		$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("SELECT genre_id FROM genre WHERE genre_name = ?");
		echo $conn->error;
		$stmt->bind_param("s", $selectedgenre);
		$stmt->bind_result($genrefromdb);
		$stmt->execute();
		if($stmt->fetch()){
			$notice = "Selline seos on juba olemas!";
		} else {
			$stmt->close();
			$stmt = $conn->prepare("INSERT INTO genre (genre_name, description) VALUES(?,?)");
			echo $conn->error;
			$stmt->bind_param("ss", $selectedgenre, $description);
			if($stmt->execute()){
				$notice = "ok";
			} else {
				$notice = "andmete salvestamisel tekkis tehniline tõrge: " .$stmt->error;
			}
		}
		
		$stmt->close();
		$conn->close();
		return $notice;
	}
	
	
	function savecompany($selectedcompany, $company_address) {
		$notice = null;
		$conn = new mysqli ($GLOBALS["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $GLOBALS ["database"]);
		$stmt = $conn->prepare("SELECT production_company_id from production_company WHERE company_name = ? ");
		echo $conn->error;
		$stmt->bind_param("s" ,$selectedcompany);
		$stmt->bind_result($companyfromdb);
		$stmt->execute();
		if($stmt->fetch()){
			$notice ="sellinne stuudio on juba olemas";
		}else{
			$stmt->close();
			$stmt=$conn->prepare("INSERT INTO production_company (company_name, company_address) VALUES(?,?)");
			echo $conn->error;
			$stmt-> bind_param ("ss", $selectedcompany, $company_address);
			if($stmt->execute()){
				$notice = "ok";
			} else {
				$notice ="Samad andmed on juba sisestatud: " . $stmt->error;
			}
		}
		$stmt->close();
		$conn->close();
		return $notice;
	}