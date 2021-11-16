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

		if (isset($_POST['search'])){
			require_once "C:/xampp/htdocs/web-tech/lab task 5/Controller/findproductController.php";
			$searchname =  test_input($_POST['searchname']);
			$productList = new productList();
			$products = $productList -> productList($searchname);
		}

		
            if (isset($_POST['edit'])){
                $_SESSION['name']  = test_input($_POST['edit']);
				header("location: editproduct.php");
            }
            elseif(isset($_POST['delete'])){
				$_SESSION['name']  = test_input($_POST['delete']);
                header("location: deleteproduct.php");

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
	<table>
		<tr><div style="display: inline-block;"><label>Search Product:  </label><input type="text" name="searchname" >
		<input type="submit" name="search" value="search">  </div></tr>
		
		<?php
			if(!empty($products)){
				echo "<tr>";
				echo "<th>Products</th>";
				echo "<th></th>";
				echo "<th></th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>$products[pname]</td>"; 
				echo "<td>$products[buyingprice]</td>"; 
				echo "<td>$products[sellingprice]</td>"; 
				echo "<td><button name='edit' value='$products[pname]' type='submit' style='text-align: center;''>Edit</button></td>";
				echo "<td><button name='delete' value='$products[pname]' type='submit' style='text-align: center;'>Delete</button></td>";
				echo "</tr>";
			}
		?>
	</table>
	</form>
</body>
</html>