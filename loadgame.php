<?php
require "config.php";
unset($_SESSION['speelveld']);//Schoon beginnen
// Leeg speelveld maken
/*
for ($rij = 0; $rij < $_SESSION["rij"]; $rij++) {
	for ($kolom = 0; $kolom < $_SESSION["kolom"]; $kolom++) {
		$_SESSION["speelveld"][$rij][$kolom] = "Leeg";
		//echo "Speelveld Rij:".$rij."  Kolom:".$kolom."  Value=".$_SESSION["speelveld"][$rij][$kolom]."<br>";
	}
}
*/

$sel = $con->query("SELECT speelveld,gamehash FROM game_sessions WHERE id='".$con->real_escape_string($_GET['id'])."' LIMIT 1");
$row = $sel->fetch_assoc();
$_SESSION["speelveld"] = json_decode($row['speelveld']);
//$random = bin2hex(openssl_random_pseudo_bytes(10)); // 20 chars
//$game->firstSave($json,$random,$_SESSION['uid'],$_POST['player']);
//$game->sendInvite($_POST['player']);

// Aantal schijfjes geplaatst
$_SESSION['aantalschijfjes'] = 0;

// Zet de beginner op Rood
$_SESSION["beurt"] = rand(0, 1) ? 'Rood' : 'Geel';

// Activated is true
$_SESSION['activated'] = true;

// Er is nog geen winnaar
$_SESSION['erIsEenWinnaar'] = false;

// Redirect naar de game zelf
$_SESSION['gamehash'] = $row['gamehash'];
header('Location: game.php');
?>
