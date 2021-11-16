<?php
    class product{
        public $error = array('nameErr' => "", 'buyingpriceErr' => "", 'sellingpriceErr' => "");
        

        

        function addProduct($sname, $data)
        {
            $isValid = True;

            if(empty($data["name"])){
				$this -> error["nameErr"] = "Name is required";
				$isValid = False;
			}

			

			if(empty($data["buyingprice"])){
				$this -> error["buyingpriceErr"] = "Buying price is required";
				$isValid = False;
			}
			else{
				if (!is_numeric($data["buyingprice"])) {
			    	$this -> error["buyingpriceErr"] = "Buying Price can only be number";
			    	$isValid = False;
		    	}
			    if ((int)$data["buyingprice"]<0) {
			    	$this -> error["buyingpriceErr"] = "Buying Price cannot be less than zero";
			    	$isValid = False;
		    	}
			}

			if(empty($data["sellingprice"])){
				$this -> error["sellingpriceErr"] = "Selling price is required";
				$isValid = False;
			}
			else{
				if (!is_numeric($data["sellingprice"])) {
			    	$this -> error["buyingpriceErr"] = "selling Price can only be number";
			    	$isValid = False;
		    	}

			    if ((int)$data["sellingprice"]<0) {
			    	$this -> error["sellingpriceErr"] = "Selling Price cannot be less than zero";
			    	$isValid = False;
		    	}
			}


    		

            if($isValid == True){
                require_once "C:/xampp/htdocs/web-tech/lab task 5/Model/model.php";
                $add = new model();
                $add -> editProduct($sname, $data);
            }

            

        }

        function getError(){
            return $this -> error;
        }
    
    }
?>