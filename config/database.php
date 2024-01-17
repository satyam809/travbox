<?php 
ob_start();
session_start();  
function db() {
	static $conn;
		if ($conn===NULL){ 
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "travbox";
			$conn = mysqli_connect ($servername, $username, $password, $dbname,3308);
	}
// 	print_r($conn);die;
	return $conn;
}
?>