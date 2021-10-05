<!DOCTYPE html>
<html>
<head>
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
	<title></title>
</head>
<body>

	<?php  
		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}


		$username = $password = "";
		$usernameErr = $passwordErr = "";
	
	if($_SERVER['REQUEST_METHOD']=="POST"){

		if(empty($_POST["username"])){
				$usernameErr = "Username is required";
			}

		else{

			$username = test_input($_POST["username"]);
			if (strlen($username) < 2) {
            $usernameErr = "Cannot contain less than two characters";
            //$isValid = false;
	        } 

	        elseif (preg_match('/^[A-Za-z0-9\s.-]+$/', $username) !== 1) {
	            $usernameErr = "Can contain a-z, A-Z, period and dash only";
	            //$isValid = false;
	        } 
		}


		if(empty($_POST["password1"])){
				$passwordErr1 = "Password is required";
			}

		else{

			$password1 = test_input($_POST["password1"]);
			if (strlen($password1) < 8) {
            $passwordErr1 = "Password must not be less than eight characters";
	        } 

	        elseif (preg_match('/[#$%@]/', $password1) !== 1) {
	            $passwordErr1 = "Password must contain at least one of the special characters (@, #, %)";
	        } 
		}
	}


	?>




	<form method="post" action ="<?php echo $_SERVER['PHP_SELF'];?>">
		<table class="table1" style="width: 300px;">
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
					<td class="textstyle" style="padding-left:40%;padding-right:auto; padding-bottom: 50px;" size="10">
						<div >
							<br><input type="SUBMIT" >
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</body>
</html>