<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<?php 
		session_start();

		session_destroy();
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		require_once "Controller/viewproductController.php";

		$productList = new productList();
		$products = $productList -> productList();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			session_start();
            

            if (isset($_POST['edit'])){
                $_SESSION['name']  = test_input($_POST['edit']);
				header("location: editproduct.php");
            }
            elseif(isset($_POST['delete'])){
				$_SESSION['name']  = test_input($_POST['delete']);
                header("location: deleteproduct.php");

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
			<legend>Products</legend>
	<table>
		<?php
			if(!empty($products)){

				echo "<tr>";
				echo "<th>Product name</th>";
				echo "<th>Profit</th>";
				echo "<th></th>";
				echo "<th></th>";
				echo "</tr>";
				foreach($products as $product){
					$profit = $product["buyingprice"]-$product["sellingprice"];
					if($product["display"]=="true"){
						echo "<tr>";
						echo "<td>$product[pname]</td>"; 
						echo "<td>$profit</td>"; 
						echo "<td><button name='edit' value=$product[pname] type='submit' style='text-align: center;'>Edit</button></td>";
						echo "<td><button name='delete' value=$product[pname] type='submit' style='text-align: center;'>Delete</button></td>";
						echo "</tr>";
					}
				}  
			}
		?>
	</table>
	</fieldset>
	</form>
</body>
</html>