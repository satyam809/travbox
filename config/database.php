<?php 
ob_start();
session_start();  
function db() {
	static $conn;
		if ($conn===NULL){ 
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "little21_travbox_testing";
			$conn = mysqli_connect ($servername, $username, $password, $dbname);
	}
// 	print_r($conn);die;
	return $conn;
}
?>