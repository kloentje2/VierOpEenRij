<?php
require "config.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
	Header("Location:index.php?error=nopost");
}

// Leeg speelveld maken
for ($rij = 0; $rij < $_SESSION["rij"]; $rij++) {
	for ($kolom = 0; $kolom < $_SESSION["kolom"]; $kolom++) {
		$_SESSION["speelveld"][$rij][$kolom] = "Leeg";
		//echo "Speelveld Rij:".$rij."  Kolom:".$kolom."  Value=".$_SESSION["speelveld"][$rij][$kolom]."<br>";
	}
}

//Laten we de inhoud van speelveld in de database zetten, dit doen we in JSON formaat.
$json = json_encode($_SESSION["speelveld"]);
$random = sha1(time()); 
$game->firstSave($json,$random,$_SESSION['uid'],$_POST['player']);
$game->sendInvite($_POST['player']);

// Aantal schijfjes geplaatst
$_SESSION['aantalschijfjes'] = 0;

// Zet de beginner op Rood
$_SESSION["beurt"] = rand(0, 1) ? 'Rood' : 'Geel';

// Activated is true
$_SESSION['activated'] = true;

// Er is nog geen winnaar
$_SESSION['erIsEenWinnaar'] = false;

// Redirect naar de game zelf
$_SESSION['gamehash'] = $random;
header('Location: game.php');
?>
