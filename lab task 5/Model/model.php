<?php
    require_once 'db_connect.php';
    class model{
        function addProduct($data){

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "db";

            $pname = $buyingprice = $sellingprice = $display = "";

            $pname = $data["name"];
            $buyingprice = $data["buyingprice"];
            $sellingprice = $data["sellingprice"];
            $display = $data["display"];

                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO products (pname, buyingprice, sellingprice, display)
                VALUES ('$pname', '$buyingprice', '$sellingprice', '$display')";
                $conn->exec($sql);
              
              $conn = null;
        }

        function getProductList(){
            $conn = db_conn();
            $selectQuery = 'SELECT * FROM `products` ';
            try{
                $stmt = $conn->query($selectQuery);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }

        function findProduct($name){
            $conn = db_conn();
	    $selectQuery = "SELECT * FROM `products` where pname = ?";

            try {
                $stmt = $conn->prepare($selectQuery);
                $stmt->execute([$name]);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        function editProduct($sname, $data){
            $conn = db_conn();
            $selectQuery = "UPDATE products set pname = ?, buyingprice = ?, sellingprice = ?, display = ? where pname = ?";
            try{
                $stmt = $conn->prepare($selectQuery);
                $stmt->execute([$data['name'], $data['buyingprice'], $data['sellingprice'], $data['display'], $sname]);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            
            $conn = null;
            return true;
        }

        function deleteProduct($sname){
            $conn = db_conn();
            $selectQuery = "DELETE FROM `products` WHERE `pname` = ?";
            try{
                $stmt = $conn->prepare($selectQuery);
                $stmt->execute([$sname]);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            $conn = null;

            return true;
        }
    }
?>