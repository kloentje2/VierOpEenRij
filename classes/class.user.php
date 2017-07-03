<?php
Class User {
	protected $con;
	public $res;
	public function __construct($con) {
		$this->con = $con;
	}
	public function createUser($email,$password) {
		$password = password_hash($password, PASSWORD_BCRYPT);
		$add = $this->con->query("INSERT INTO users (id,email,password,level) VALUES ('','".$this->con->real_escape_string($email)."','".$this->con->real_escape_string($password)."','user')");
		if ($add) {
			return true;
		} else {
			return false;
		}
	}
	public function authenticate($email,$password) {
		$select = $this->con->query("SELECT id,password FROM users WHERE email='".$this->con->real_escape_string($email)."' LIMIT 1");
		$row = $select->fetch_assoc();
		if (password_verify($password,$row['password'])) {
			$this->id = $row['id'];
			return $this;
		} else {
			return false;
		}
	}
	
	public function getUserdata($uid) {
		$sel = $this->con->query("SELECT id,email,level FROM users WHERE id = '".$this->con->real_escape_string($uid)."' LIMIT 1");
		$sela = $sel->fetch_assoc();
		$this->res = $sela;
		if ($sela != false) {
			return $this;
		} else {
			return false;
		}
	}
}
?>