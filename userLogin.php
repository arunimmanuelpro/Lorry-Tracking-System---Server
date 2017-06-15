<?php
	require_once('connection.php');
	

	$user_name = $_POST["userName"];
	$password = $_POST["password"];
	$deviceCode = $_POST["deviceCode"];

	$sql = "SELECT * FROM user_detail where BINARY UserName = '$user_name' and   Password = '$password' and DeviceCode = '$deviceCode'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	  if($row = $result->fetch_assoc()){
		  $data = [ 'success' => 1, 'user_id' => '$row["user_id"]' ];
		}else{
			$data = [ 'success' => 0 ];
		}
	}else{
		$data = [ 'success' => 0 ];
	}
	header('Content-type: application/json');
	echo json_encode( $data );
	$conn->close();
		?>