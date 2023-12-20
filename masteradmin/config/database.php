<?php 
ob_start();
session_start();  
function db() {
	static $conn;
		if ($conn===NULL){ 
			$servername = "localhost";
			$username = "little21_travbox_testing";
			$password = "Travbox@2023";
			$dbname = "little21_travbox_testing";
			$conn = mysqli_connect ($servername, $username, $password, $dbname);
	}
	return $conn;
}
?>