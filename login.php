<?php
session_start();
			require_once('connection.php');
			$user_name = $_POST["uname"];
			$password = $_POST["upassword"];

			$sql = "SELECT * FROM user_detail where BINARY  UserName = '$user_name' and BINARY  Password = '$password'";
//echo $sql;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
                              if($row = $result->fetch_assoc()){
					if($row["UserType"] == "Admin"){

                                                 $_SESSION["User"]="Admin";
						 header('Location: view.php');

					}else{
						header('Location: adminlogin.php?error=You are Not Admin to Access this Site');
					}
			}else{
				header('Location: login.html');
			}
                        }else{
                            header('Location: adminlogin.php?error=You are Not Authorized to use this site');
                        }
			$conn->close();
		?>