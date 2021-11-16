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
			require_once "C:/xampp/htdocs/web-tech/lab task 5/Controller/editproductsController.php";

			$product = new product();
			$product -> addProduct($sname, $data);
			$error=$product->getError();
			$nameErr=$error["nameErr"];
			$buyingpriceErr=$error["buyingpriceErr"];
			$sellingpriceErr=$error["sellingpriceErr"];
			session_destroy();
			header("location: view.php");

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
			<legend>Edit Product:</legend>
	<table>
		<label>Name:</label>
		<input type="text" name="name" value="<?php echo $products["pname"]?>"><br><br>
		<label>Buying Price:</label>
		<input type="text" name="buyingprice" value="<?php echo $products["buyingprice"]?>"><br><br>
		<label>Selling Price:</label>
		<input type="text" name="sellingprice" value="<?php echo $products["sellingprice"]?>"><br><br>
		<input type="checkbox" name="displaycheck" <?php if($products["display"] == "true"){echo 'checked';}?>><label>Display</label><br> <br>
		<input type="SUBMIT" >         <br>     
	</table>
	</fieldset>
	</form>
</body>
</html>