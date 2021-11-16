<?php
    class product{
        

        

        function deleteProduct($sname)
        {
         
    		
                require_once "C:/xampp/htdocs/web-tech/lab task 5/Model/model.php";
                $delete = new model();
                return $delete -> deleteProduct($sname);
            

        }

    
    }
?>