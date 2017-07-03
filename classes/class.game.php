<?php
Class Game extends User {
	public function firstSave($sv,$gamehash,$userid1,$userid2) {
		$add = $this->con->query("INSERT INTO game_sessions (id,userid1,userid2,timestamp,speelveld,gamehash,verlopen) VALUES ('','".$this->con->real_escape_string($userid1)."','".$this->con->real_escape_string($userid2)."','".date('d-m-o H:i:s')."','".$this->con->real_escape_string($sv)."','".$this->con->real_escape_string($gamehash)."','false')");
		if ($add) {
			return true;
		} else {
			return false;
		}
	}
	public function save() {

	}
	
	public function checkWin($sv) {
		define("KOLOMMEN",$_SESSION["kolom"]);
		define("RIJEN",$_SESSION["rij"]);
		// Eerst de kolommen checken of er vier op een rij is
		for ($checkKolom = KOLOMMEN-1; $checkKolom >= 0; $checkKolom--) {
			for ($rij = RIJEN-1; $rij >= 3; $rij--) {
				if (
				
					($sv[$rij][$checkKolom] == 1 || $sv[$rij][$checkKolom] == 2) 
					 
					&&
					
					$sv[$rij][$checkKolom] 		== 
					$sv[$rij-1][$checkKolom] 	&&
					$sv[$rij][$checkKolom] 	== 
					$sv[$rij-2][$checkKolom] &&
					$sv[$rij][$checkKolom] 	== 
					$sv[$rij-3][$checkKolom]
					) return true;
					
			}
		}
		
		// er is nog geen winnaar
		return false;
	}
	
	public function sendInvite($uid) {
		
		$selq = $this->con->query("SELECT email FROM users WHERE id='".$this->con->real_escape_string($uid)."' LIMIT 1");
		$row = $selq->fetch_assoc();
		
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <mail@koenhollander.nl>' . "\r\n";

		$m = mail($row['email'],"Je bent uitgedaagd!","Hoi! Je bent uitgedaagd om Vier-op-een-rij te spelen. Log snel in om jezelf te bewijzen!",$headers);
		if ($m) {
			return true;	
		} else {
			return false;
		}
	}
}
?>