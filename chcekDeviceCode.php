<?php

require_once('connection.php');
	$deviceCode = $_POST["deviceCode"];
	$sql = "SELECT * FROM user_detail where DeviceCode = '$deviceCode'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "Device Code Alreay Exist for ".$row["UserName"];
		}
	}else{
		echo "Valid Device Code";
	}
	$conn->close();
?>