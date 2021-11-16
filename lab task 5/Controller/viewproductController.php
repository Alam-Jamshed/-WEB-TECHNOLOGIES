<?php
    class productList{
        function productList(){
			require_once "C:/xampp/htdocs/web-tech/lab task 5/Model/model.php";
			$productList=new model();
	
			return $productList->getProductList();
		}
    }
?>