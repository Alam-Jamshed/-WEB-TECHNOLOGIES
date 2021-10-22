<!DOCTYPE html>
<html>
<head>
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<?php include 'heading.php'?>
	<?php  
		session_start();
		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}


		$username = $password = "";
		$usernameErr = $passwordErr1 = "";
	
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$username = test_input($_POST["username"]);
		$password = test_input($_POST["password1"]);
		$data = file_get_contents("data.json");  
		$data = json_decode($data, true);  
		foreach($data as $row)  
		{	
			if($row["username"] == $username)
			{
				if($row["password"] == $password){
					$_SESSION['username'] = $row["username"];
					$_SESSION['password'] = $row["password"];
					$_SESSION['name'] = $row["name"];
					$_SESSION['email'] = $row["e-mail"];
					$_SESSION['dob'] = $row["dob"];
					$_SESSION['gender'] = $row["gender"];
					$_SESSION['picture'] = $row["picture"];
					header("location: Dashboard.php");
				}

				else{
					$passwordErr1 = "Incorrect Password";
				}
			}
			else{
				$usernameErr = "Invalid Username!";
			}
		} 
	}


	?>




	<form method="post" action ="<?php echo $_SERVER['PHP_SELF'];?>">
		<table class="main" style="width: 300px;">
			<tbody>
				<tr class="border_bottom">
					<td class="textstyle" style="padding: 20px; font-size: 40px;"><b>Login</b></td>
				</tr>
				<tr>
					<div class="divPadding">
						<td class="textstyle" style="padding-left:20px; padding-top: 10px; ">
							<input type="text"  name="username" placeholder="Username" size="23" style="border-radius: 4px; padding:5px; background-color : #f5f7fa"/><span class="red">*
						    	<?php 
						    		if($usernameErr) {
									echo $usernameErr;
						    		}
						    	?>
					    		
					    	</span>
						</td>
					</div>
				</tr>
					
				<tr>
					<div class="divPadding">
						<td class="textstyle" style="padding-left:20px; padding-top: 10px; ">
							<input type="text"  name="password1" placeholder="Password" size="23" style="border-radius: 4px; padding:5px; background-color : #f5f7fa"/><span class="red">*
						    	<?php 
						    		if($passwordErr1) {
									echo $passwordErr1;
						    		}
						    	?>
					    	</span>
						</td>
					</div>
				</tr>
				<tr >
					<td class="textstyle" style="padding-left:auto;padding-right:auto; padding-bottom: 20px;" size="10">
						<div >
							<br><a href="forgotPass.php">Forgot Password?</a>
						</div>
					</td>
				</tr>
				<tr >
					<td class="textstyle" style="padding-left:40%;padding-right:auto; padding-bottom: 50px;" size="10">
						<div >
							<br><input type="SUBMIT" >
						</div>
					</td>
				</tr>
				
			</tbody>
		</table>

	</form>
	<?php include 'footer.php'; ?>
</body>
</html>