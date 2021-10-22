<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">

		.header {
		  overflow: hidden;
		  padding: 20px 10px;
		  font-family: Segoe UI;
		}

		.header-right {
  			float: right;
		}	
	</style>

	<title></title>
</head>
<body>
	<?php 
		session_start();
		if (isset($_SESSION['name'])) {
			$name = $_SESSION['name'];
			$username = $_SESSION['username'];
			$password = $_SESSION['password'];
		}
	?>
	<div class="header">
		<img src="logo.png" alt="BlackCat" align="center">
		<a  class="logo">BlackCat Software INC.</a>
	<div class="header-right">
	    Welcome  <?php echo $name ?> |  
	    <a href="logout.php">Logout</a> 
	  </div>
	</div>
  	</header>
</body>
</html>