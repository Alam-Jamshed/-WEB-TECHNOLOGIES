<!DOCTYPE html>
<html>
<head>
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<?php include 'header.php'?>
	<form method="post" action ="<?php echo $_SERVER['PHP_SELF'];?>">
		<table class="table1" style="width: 300px;">
			<tbody>
				<tr class="border_bottom">
					<td class="textstyle" style="padding: 20px; font-size: 40px;"><b>Login</b></td>
				</tr>
				<tr>
					<div class="divPadding">
						<td style="padding-left:20px;">
							<input type="text"  name="name" placeholder="Username" size="23" style="border-radius: 4px; padding:5px; background-color : #f5f7fa"/><!--span class="red">*
						    	<?php 
						    		if($nameErr) {
									echo $nameErr;
						    		}
						    	?>
					    		
					    	</span-->
						</td>
					</div>
				</tr>
					
				<tr>
					<div>
						<td class="textstyle" style="padding-left:20px; padding-top: 10px; " colspan="2">
							<input type="text"  name="password" placeholder="Password" size="23" style="border-radius: 4px;padding:5px; background-color :#f5f7fa "/>
							<!--span class="red">*
						    	<?php 
						    		if($emailErr) {
									echo $emailErr;
						    		}
						    	?>
					    		
					    	</span-->
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