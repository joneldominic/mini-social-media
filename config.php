<?php
//session_start();

Class config {
/*
	public function __construct(){
		$servername = "localhost";
		$username 	= "root";
		$password 	= "";
		$dbname		= "socialmediamini_db";
		$conn = new mysqli($servername, $username, $password,$dbname);
		//Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			header('Location: dberror.php');
		}
		return header('Location: index.php');
	}
*/

	public function dbconnect(){
		$servername = "localhost";
		$username 	= "root";
		$password 	= "";
		$dbname		= "socialmediamini_db";
		// connect to database
		$conn = new mysqli($servername, $username, $password,$dbname);
		// Check connection
		if ($conn->connect_error) {
		    // die("Connection failed: " . $conn->connect_error);
				header('Location: dberror.php');
		}
		// return the database connection
		return $conn;
	}

}
?>
