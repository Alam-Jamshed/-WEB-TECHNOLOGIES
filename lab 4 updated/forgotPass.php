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
		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}


		$email = "";
		
		$emailFound = $emailErr =  "";
	
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$email = test_input($_POST["email"]);
		$data = file_get_contents("data.json");  
		$data = json_decode($data, true);  
		foreach($data as $row)  
		{	
			if($row["e-mail"] == $email)
			{
				$emailFound = "Check your email for Password Reset instructions!";
			}
			else{
				$emailErr = "No account exists with this email address!";
			}
		} 
	}


	?>




	<form method="post" action ="<?php echo $_SERVER['PHP_SELF'];?>">
		<table class="nav" style="width: 300px;">
			<tbody>
				<tr class="border_bottom">
					<td class="textstyle" style="padding: 20px; font-size: 40px;"><b>Forgot Password</b></td>
				</tr>
				<tr>
					<div class="divPadding">
						<td class="textstyle" style="padding-left:20px; padding-top: 10px; ">
							<input type="text"  name="email" placeholder="Email" size="23" style="border-radius: 4px; padding:5px; background-color : #f5f7fa"/><span class="red">*
						    	<?php 
						    		if($emailErr) {
									echo $emailErr;
						    		}
									else
									echo $emailFound;
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
	<?php include 'footer.php'; ?>
</body>
</html>