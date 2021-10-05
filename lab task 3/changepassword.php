<!DOCTYPE html>
<html>
<head>
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
	<title></title>
</head>
<body>

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
			$message="Password Changed!";
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