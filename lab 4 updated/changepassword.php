<!DOCTYPE html>
<html>
<head>
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<?php include 'heading2.php'?>
	<?php include 'navigation.php'?>
	<?php include 'footer.php'; ?>
	<?php  
		$currentPass = $newPass = $reNewPass = "";
		$currentPassErr = $newPassErr = $reNewPassErr = "";
	
	if($_SERVER['REQUEST_METHOD']=="POST"){
		if(empty($_POST["currentPass"])){
				$currentPassErr = "Current Password is required";
			}

		if(empty($_POST["newPass"])){
				$newPassErr = "Password is required";
		}

		else{
			$currentPass = $_POST["currentPass"];

			if(strcmp($currentPass, $_POST["newPass"])!==0)
			{
				$newPass = $_POST["newPass"];
				if (strlen($newPass) < 8) {
	            $newPassErr = "Password must not be less than eight characters";
		        } 

		        elseif (preg_match('/[#$%@]/', $newPass) !== 1) {
		            $newPassErr = "Password must contain at least one of the special characters (@, #, %)";
		        } 
		    }
		    else{
		    	$newPassErr = "New Password should not be same as the Current Password";
		    }
		}


		if(empty($_POST["reNewPass"])){
				$reNewPassErr = "Retype the password";
		}

		elseif(strcmp($newPass, $_POST["reNewPass"])!==0)
		{
			$reNewPassErr = "New Password must match with the Retyped Password";
		}
		else{
			if(file_exists('data.json'))  
				{  
				    $current_data = file_get_contents('data.json');  
				    $current_data = json_decode($current_data, true);  
				    if (!empty($current_data)) {
						foreach ($current_data as $key => $row) {
							if ($row["username"] == $username && $password != $row["password"] ) {
								$currentPassErr = "Invalid password";
								break;
							}
							elseif($row["username"] == $username && $password == $row["password"]){
								if (!empty($data)) {
									foreach ($data as $key => $row) {
										if ($row["username"] == $_SESSION['username']) {
											$data[$key]['password'] = $newPass;
											$_SESSION['password'] = $newPass;
											$message = "Password changed!";
											break;
										}
									}

									file_put_contents('data.json', json_encode($data));
								}
							}
						}
					}
				    $final_data = json_encode($current_data);  
				    if(file_put_contents('data.json', $final_data))  
				    {  
				         $message = "<label class='text-success'>Profile Edited.</p>";  
				    }  
				}  
				else  
				{  
				    $error = 'Profile edit unsuccessful';  
				}
			$message="Password Changed!";
		}
		


	}


	?>




	<form method="post" action ="<?php echo $_SERVER['PHP_SELF'];?>">
		<table class="dashboard" style="width: 300px;">
			<tbody>
				<tr class="border_bottom">
					<td class="textstyle" style="padding: 20px; font-size: 40px;"><b>Login</b></td>
				</tr>
				<tr>
					<div class="divPadding">
						<td class="textstyle" style="padding-left:20px; padding-top: 10px; ">
							<input type="text"  name="currentPass" placeholder="Current Pass" size="23" style="border-radius: 4px; padding:5px; background-color : #f5f7fa"/><span class="red">*
						    	<?php 
						    		if($currentPassErr) {
									echo $currentPassErr;
						    		}
						    	?>
					    		
					    	</span>
						</td>
					</div>
				</tr>
					
				<tr>
					<div class="divPadding">
						<td class="textstyle" style="padding-left:20px; padding-top: 10px; ">
							<input type="text"  name="newPass" placeholder="New Password" size="23" style="border-radius: 4px; padding:5px; background-color : #f5f7fa"/><span class="red">*
						    	<?php 
						    		if($newPassErr) {
									echo $newPassErr;
						    		}
						    	?>
					    		
					    	</span>
						</td>
					</div>
				</tr>

				<tr>
					<div class="divPadding">
						<td class="textstyle" style="padding-left:20px; padding-top: 10px; ">
							<input type="text"  name="reNewPass" placeholder="Retype New Password" size="23" style="border-radius: 4px; padding:5px; background-color : #f5f7fa"/><span class="red">*
						    	<?php 
						    		if($reNewPassErr) {
									echo $reNewPassErr;
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

	<div class="footer">
  		<p style="text-align: center;"><?php if(isset($message)){echo $message;} ?></p>
	</div>
</body>
</html>