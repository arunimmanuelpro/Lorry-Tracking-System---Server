<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit User</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<div class="container">

	<?php
		require_once('connection.php');
		$userId= $_POST["userId"];
		$user_name= $_POST["user_name"];
		$user_password= $_POST["user_password"];
		$user_location= $_POST["user_location"];
		$user_deviceCode= $_POST["user_deviceCode"];
		$user_loadingtype= $_POST["user_loadingtype"];
		$user_action= $_POST["user_action"];
		
		$sql = "UPDATE user_detail set UserName = '$user_name',Password = '$user_password',UserAction = '$user_action',DeviceCode = '$user_deviceCode',Location = '$user_location',LoadingType = '$user_loadingtype' where user_id = '$userId'";
		if ($conn->query($sql) === TRUE) {
		?>
			<div class="alert alert-success">
			  <strong>Success!</strong> <?php echo "User Updated Successfully"; ?>
			  <br/>
			  <a href = "view.php">Go back</a>
			</div>
			
		<?php	
		} else {
			?>
			<div class="alert alert-danger">
			  <strong>Error!</strong> <?php echo $conn->error; ?>
			  <br/>
			  <a href = "view.php">Go back</a>
			</div>
		<?php
		}

		$conn->close();
	?>
		</div>
	</body>
</html>