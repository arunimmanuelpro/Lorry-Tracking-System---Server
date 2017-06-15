<?php
	require_once('connection.php');
	$vNo = $_POST["vNo"];
	$user_id = $_POST["userId"];
	date_default_timezone_set('Asia/Kolkata');
	$date = date('Y-m-d H:i:s');
	$sql = "INSERT INTO tracking (VehicleNumber, UserId,Timestamp) VALUES ('$vNo', '$user_id','$date')";
	if ($conn->query($sql) === TRUE) {
		$data = [ 'success' => 1 ];
	} else {
		$data = [ 'success' => 0 ];
	}

	$conn->close();
	header('Content-type: application/json');
	echo json_encode( $data );
?>