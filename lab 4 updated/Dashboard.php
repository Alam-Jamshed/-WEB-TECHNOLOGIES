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
	<?php include 'footer.php'?>
	<?php 
		if (isset($_SESSION['name'])) {
			$name = $_SESSION['name'];
		}
	?>
	<table class="dashboard">
			<tbody>
				<tr class="border_bottom">
					<td class="textstyle" style="padding: 20px; font-size: 40px;"><b>Welcome</b></td>
				</tr>
			</tbody>
	</table>
</body>
</html>