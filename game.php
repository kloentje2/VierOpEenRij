<?php
require "config.php";

// Schijfje geplaatst staat op false,
// Deze wordt gebruikt om te bepalen of de beurt gewisseld moet worden
$schijfjegeplaatst = false;

if (isset($_GET['kolom']) && $_SESSION['erIsEenWinnaar'] == false) {
	if ($_GET['kolom'] > -1 && $_GET['kolom']<$_SESSION['kolom']) {
		
		// Checken op welke rij het schijfje geplaatst moet worden
		$kolom = $_GET['kolom'];
		for ($teller = $_SESSION["rij"]-1; $teller > -1; $teller--) {
			if ($_SESSION["speelveld"][$teller][$kolom] == "Leeg") {
				$_SESSION["speelveld"][$teller][$kolom] = $_SESSION["beurt"];
				$schijfjegeplaatst = true;
				break;
			}
		}

		// Als schijfje is geplaatst dan checken op winnaar en eventueel beurt wisselen
		if ($schijfjegeplaatst == true) {
			
			
			$_SESSION['aantalschijfjes']++;
			
			// Check of er al een winnaar is
			if ($game->checkWin($_SESSION['speelveld']) == false) {
			
				// Wisselen van beurt
				if ($_SESSION["beurt"] == "Geel") {
					$_SESSION["beurt"] = "Rood";
				}
				else {
					$_SESSION["beurt"] = "Geel";
				}
			} else {
				//Gewonnen, pagina moet leeg zijn bij winst.
				die;
			}
		}
		/*
		else {
			echo "Error: In deze kolom kan geen schijfje worden geplaatst<br><br>";
		}
		*/
	} 
}

echo "<table border=0 cellpadding=0 cellspacing=0>";
for ($rij = 0; $rij < $_SESSION["rij"]; $rij++) {
	echo "<tr>";
		for ($kolom = 0; $kolom < $_SESSION["kolom"]; $kolom++) {
			echo "<td><a href='game.php?kolom=".$kolom."'><img src='images/".$_SESSION["speelveld"][$rij][$kolom].".png' width='39' height='39' alt=''></a></td>";
		}
	echo "</tr>";
}
echo "</table>";

echo "<pre>";
var_dump($_SESSION['speelveld']);
echo "</pre>";
?>