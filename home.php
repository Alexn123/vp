<?php
$username = "Alex Nelke";
$fulltimenow = date("d.m.Y H:i:s");
$hournow = date("H");
$partofday = "lihtsalt aeg";
if($hournow < 7){
	$partofday = "ärkamine";
}
if($hournow >= 8 and $hournow < 18) {
	$partofday = "kooliaeg";
}
if($hournow > 18 and $hournow < 22) {
	$partofday = "vabaaeg";
}
if($hournow > 22 and $hournow <= 7) {
	$partofday = "öörahu";
}
?>

<!DOCTYPE html>
<html lang="et">

<head>
  <meta charset="utf-8">
  <title><?php echo $username; ?> programmist</title>

</head>

<body>
  <h1><?php echo $username; ?> </h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Lehe avamisel oli aeg: <?php echo $fulltimenow ?> <p>
  <p><?php echo "praegu on " . $partofday . "."; ?></p>

</body>

<footer>
<img src="https://cdn.pixabay.com/photo/2017/07/11/00/24/house-2492054_960_720.png" alt="maja">

</footer>
</html>