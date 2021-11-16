<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<?php 
		session_start();
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		require_once "C:/xampp/htdocs/web-tech/lab task 5/Controller/findproductController.php";
		

		

		$sname =  $_SESSION['name'];
		$productList = new productList();
		$products = $productList -> productList($sname);

		
		$name = $buyingprice = $sellingprice = $display = "";
		$nameErr = $buyingpriceErr = $sellingpriceErr = $displayErr = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			require_once "C:/xampp/htdocs/web-tech/lab task 5/Controller/deleteproductsController.php";

			$product = new product();
			if($product -> deleteProduct($sname)){
				session_destroy();
				header("location: view.php");
			}

		}
	?>
	<table>
		<tr>
			<td>
				<a href="addproducts.php">Add Products</a>
			</td>
			<td>
				<a href="view.php">View Products</a>
			</td>
			<td>
				<a href="searchproducts.php">Search Products</a>
			</td>
		</tr>
	</table>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<fieldset>
			<legend>Delete Product:</legend>
	<table style = "border:collapse;">
			<label>Name:</label>
			<input type="text" name="name" value="<?php echo $products["pname"]?>" disabled><br><br>
			<label>Buying Price:</label>
			<input type="text" name="buyingprice" value="<?php echo $products["buyingprice"]?>" disabled><br><br>
			<label>Selling Price:</label>
			<input type="text" name="sellingprice" value="<?php echo $products["sellingprice"]?>"disabled> <br><br>
			<input type="checkbox" name="displaycheck" value="display" <?php if($products["display"] = "true"){echo 'checked';}?> disabled><label>Display</label><br> <br>
			<input type="SUBMIT" value = "Delete">         <br>     
	</table>
	</fieldset>
	</form>
</body>
</html>