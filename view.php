<?php
session_start();
if(!isset($_SESSION['User']) || empty($_SESSION['User'])) {
  header('Location: adminlogin.php?error=Please Login to Continue');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<head>
        <title> View Details </title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src = "https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href = "https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"/>
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script>
			$(document).ready(function() {
				$('#example').DataTable({
					"order": [[ 0, "desc" ]]
				});
				$('#example2').DataTable({
					"order": [[ 0, "desc" ]]
				});
			} );

		</script>
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
		<div align = "right">
			Welcome Admin <a href = "logout.php">Log Out</a>
		</div>
		<br/>
		<h2>View Tracking Details</h2>
		<table id="example" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>SNo</th>
					<th>Vehicle Number</th>
					<th>User Name</th>
					<th>Location</th>
					<th>User Action</th>
					<th>Device Code</th>
					<th>Time</th>
				</tr>
			</thead>
			<tbody>
			<?php
				require_once('connection.php');
				$sql = "SELECT t.SNo,t.VehicleNumber,t.TimeStamp,u.UserName,u.Location,u.LoadingType,u.UserAction,u.DeviceCode FROM tracking t join user_detail u on t.UserId = u.user_id";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
			?>
						<tr>
							<td><?php echo $row["SNo"]; ?></td>
							<td><?php echo $row["VehicleNumber"]; ?></td>
							<td><?php echo $row["UserName"]; ?></td>
							<td><?php echo $row["Location"]; ?></td>
							<td><?php echo $row["LoadingType"]." ".$row["UserAction"]; ?></td>
							<td><?php echo $row["DeviceCode"]; ?></td>
							<td><?php echo $row["TimeStamp"]; ?></td>
						</tr>
			<?php
						}
					}
				
			?>
			</tbody>
		</table>
		<br/>
		<h2>View User Details</h2>
		<table id="example2" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>User Id</th>
					<th>User Name</th>
					<th>Password</th>
					<th>Location</th>
					<th>Loading Type</th>
					<th>User Action</th>
					<th>Device Code</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql = "SELECT * FROM user_detail where UserType = 'User'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
			?>
						<tr>
							<td><?php echo $row["user_id"]; ?></td>
							<td><?php echo $row["UserName"]; ?></td>
							<td><?php echo $row["Password"]; ?></td>
							<td><?php echo $row["Location"]; ?></td>
							<td><?php echo $row["LoadingType"]; ?></td>
							<td><?php echo $row["UserAction"]; ?></td>
							<td><?php echo $row["DeviceCode"]; ?></td>
							<td><a href = "edit.php?userId=<?php echo $row["user_id"]; ?>">Edit</a></td>
							<td>
								<form action = "delete.php" method ="post" onsubmit = "return confirm('Are You Sure Want to Delte?');">
									<input type= "hidden" name = "userId" value= "<?php echo $row["user_id"]; ?>"/>
									<button type ="submit" class="btn btn-danger">Delete User</button>
								</form>
							</td>
						</tr>
			<?php
						}
					}
			?>
			</tbody>
		</table>
		
		<?php
		
		$conn->close();
		?>
		<br/>
		<h2>Add User</h2>
		<form action = "adduser.php" method = "post" >
			<div class="form-group">
				<label for="user_name">User Name</label>
				<input type = "text" name = "user_name" id = "user_name" required class="form-control" autocomplete="off"/>
			</div>
			<div class="form-group">
				<label for="user_password">Password</label>
				<input type = "text" name = "user_password" id = "user_password" required class="form-control" autocomplete="off"/>
			</div>
			<div class="form-group">
				<label for="user_location">Location</label>
				<input type = "text" name = "user_location" id = "user_location" required class="form-control" autocomplete="off"/>
			</div>
			<div class="form-group">
				<label for="user_deviceCode">Device Code</label>
				<input type = "text" name = "user_deviceCode" id = "user_deviceCode" required class="form-control" autocomplete="off" onchange = "return checkDeviceCode();"/>
			</div>
			<div class="form-group">
				<label for="user_loadingtype">Loading Type</label>
				<select name = "user_loadingtype" id = "user_loadingtype" class="form-control">
					<option value = "Loading">Loading</option>
					<option value = "UnLoading">Un Loading</option>
				</select>
			</div>
			<div class="form-group">
				<label for="user_action">User Action</label>
				<select name = "user_action" id = "user_action" class="form-control">
					<option value = "IN">IN</option>
					<option value = "OUT">OUT</option>
				</select>
				
			</div>
			<button type ="submit" class="btn btn-primary">Add User</button>
			&nbsp;
			<button type ="reset" class="btn btn-danger">Clear</button>
		</form>
	</div>
	<br/>
	<br/>
	<br/>
	</body>
</html>