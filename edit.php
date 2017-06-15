<?php
session_start();
if(!isset($_SESSION['User']) || empty($_SESSION['User'])) {
  header('Location: adminlogin.php?error=Please Login to Continue');
}
?>
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
	<script>
		function checkDeviceCode(){
			var deviceCode = document.getElementById("user_deviceCode").value;
			$.post("chcekDeviceCode.php",
				{
				  deviceCode: deviceCode
				},
				function(data,status){
					if(data == "Valid Device Code"){
						
					}else{
						document.getElementById("user_deviceCode").value = ""
						alert(data);
						
					}
					
				});
		}
	</script>
</head>
<body>
	<div class="container">
	<?php
		require_once('connection.php');
		$userId = $_GET["userId"];
		$sql = "SELECT * FROM user_detail where user_id = '$userId'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				
			
	?>
		<h2 align = "center">Edit User </h2>
		<form action = "edituser.php" method = "post">
			<div class="form-group">
				<label for="user_name">User Name</label>
				<input type = "text" name = "user_name" id = "user_name" required class="form-control" value = "<?php echo $row["UserName"]; ?>" autocomplete="off"/>
			</div>
			<div class="form-group">
				<label for="user_password">Password</label>
				<input type = "text" name = "user_password" id = "user_password" required class="form-control" value = "<?php echo $row["Password"]; ?>" autocomplete="off"/>
			</div>
			<div class="form-group">
				<label for="user_location">Location</label>
				<input type = "text" name = "user_location" id = "user_location" required class="form-control" autocomplete="off" value = "<?php echo $row["Location"]; ?>"/>
			</div>
			<div class="form-group">
				<label for="user_deviceCode">Device Code</label>
				<input type = "text" name = "user_deviceCode" id = "user_deviceCode" required class="form-control" value = "<?php echo $row["DeviceCode"]; ?>"autocomplete="off" onchange = "return checkDeviceCode();"/>
			</div>
			<div class="form-group">
				<label for="user_loadingtype">Loading Type</label>
				<select name = "user_loadingtype" id = "user_loadingtype" class="form-control">
					<?php
						$userLoadingType = $row["LoadingType"];
					?>
					<option value = "Loading" <?php  if($userLoadingType=="Loading"){ echo "selected";}?>>Loading</option>
					<option value = "UnLoading" <?php  if($userLoadingType=="UnLoading"){ echo "selected";}?>>Un Loading</option>
				</select>
			</div>
			<div class="form-group">
				<label for="user_action">User Action</label>
				<select name = "user_action" id = "user_action" class="form-control" >
					<?php
						$userAction = $row["UserAction"];
					?>
					<option value = "IN" <?php  if($userAction=="IN"){ echo "selected";}?>>IN</option>
					<option value = "OUT" <?php  if($userAction=="OUT"){ echo "selected";}?>>OUT</option>
				</select>
				
			</div>
			<input type= "hidden" name=  "userId" value = "<?php echo $userId;?>"/>
			<button type ="submit" class="btn btn-primary">Update User</button>
			&nbsp;
			<button type ="reset" class="btn btn-danger">Clear</button>
		</form>
		
	<?php
			}
		}else{
	?>
	<div class="alert alert-danger">
	  <strong>Error!</strong> Invalid User Id
	</div>
	
	<?php
	}
	$conn->close();
	?>
		
	</div>
</body>

</html>