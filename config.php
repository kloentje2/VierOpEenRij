<?php
ini_set("session.hash_function","sha512");
session_start();

$_SESSION["rij"]   = 8;
$_SESSION["kolom"] = 8;

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_data = "4opeenrij";

$con = new mysqli($db_host,$db_user,$db_pass,$db_data);

require "classes/class.user.php";
require "classes/class.game.php";

$user = new User($con);
$game = new Game($con);
?>