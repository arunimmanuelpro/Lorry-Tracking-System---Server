<?php
	$servername = "localhost";
	$username = "id1264021_root";
	$password = "Looser@2305";
	$dbname = "id1264021_trackingdb";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
?>