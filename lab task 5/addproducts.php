<!DOCTYPE html>
<html>
<head>
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

		$name = $buyingprice = $sellingprice = $display = "";
		$nameErr = $buyingpriceErr = $sellingpriceErr = $displayErr = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = test_input($_POST["name"]);
			$buyingprice = test_input($_POST["buyingprice"]);
			$sellingprice = test_input($_POST["sellingprice"]);
			if(empty($_POST['displaycheck'])){
				$display = "false";
			}
			else{
				$display = "true";
			}
		

		$data = array(
			'name' => $name,
			'buyingprice' => $buyingprice,
			'sellingprice' => $sellingprice,
			'display' => $display
		);

		require_once "C:/xampp/htdocs/web-tech/lab task 5/Controller/addproductsController.php";
		$product = new product();
		$product -> addProduct($data);
		$error=$product->getError();
		$nameErr=$error["nameErr"];
        $buyingpriceErr=$error["buyingpriceErr"];
        $sellingpriceErr=$error["sellingpriceErr"];

		}



	?>

	<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
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
		<br><br>
		<fieldset>
			<legend>Add Product:</legend>
			<label>Name:</label>
			<input type="text" name="name"><br><br>
			<label>Buying Price:</label>
			<input type="text" name="buyingprice"><br><br>
			<label>Selling Price:</label>
			<input type="text" name="sellingprice"><br><br>
			<input type="checkbox" name="displaycheck" value="display"><label>Display</label><br> <br>
			<input type="SUBMIT" >         <br>            
		</fieldset>
	</form>
</body>
</html>