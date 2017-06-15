<!DOCTYPE html>
<html lang="en">
<head>
	<title>Delete User</title>
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
		$user_name= $_POST["userId"];
		
		$sql = "DELETE FROM user_detail where user_id = '$user_name'";
		if ($conn->query($sql) === TRUE) {
		?>
			<div class="alert alert-success">
			  <strong>Success!</strong> <?php echo "User Deleted Successfully"; ?>
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