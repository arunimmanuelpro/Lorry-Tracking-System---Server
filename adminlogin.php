<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Login</title>
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
		if(!isset($_GET['error'])) {
	?>
	
			<br/>
			<div class="alert alert-danger">
			  <strong>Error!</strong> <?php echo $_GET['error']; ?>
			</div>
	<?php
		}
	?>
		<h2 align = "center">Admin Login </h2>
		<form action = "login.php" method = "post">
			<div class="form-group">
				<label for="uname">User Name</label>
				<input type = "text" name = "uname" id ="uname" required class="form-control" autofocus/>
			</div>
			<div class="form-group">
				<label for="upassword">Password</label>
				<input type = "password" name = "upassword" id = "upassword" required class="form-control"/>
			</div>
			<button type ="submit" class="btn btn-primary">Login</button>
			&nbsp;
			<button type ="reset" class="btn btn-danger">Clear</button>
		</form>
		
		 
		
	</div>
</body>

</html>