<!DOCTYPE html>
<html>
<head>
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">

	
	<title></title>
</head>
<body>
	<form method="post" action ="<?php echo $_SERVER['PHP_SELF'];?>">
		<table class="nav" style="padding-left: 0px">
			<tbody>
				<tr class="border_bottom">
					<td class="textstyle"> 
						<a href="dashboard.php">Dashboard</a>
					</td>
				</tr>
				<tr class="border_bottom">
					<td class="textstyle"> 
						<a href="viewprofile.php">View Profile</a>
					</td>
					
				</tr>
				<tr class="border_bottom">
					
					<td class="textstyle"> 
						<a href="editprofile.php">Edit Profile</a>
					</td>
				</tr>
				<tr class="border_bottom">
					<td class="textstyle"> 
						<a href="changePicture.php">Change Profile Picture</a>
					</td>
				</tr>
				<tr class="border_bottom">
					<td class="textstyle" style="padding-bottom: 10px"> 
						<a href="changepassword.php">Change Password</a>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</body>
</html>