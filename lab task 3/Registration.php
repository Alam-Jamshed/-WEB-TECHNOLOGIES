<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.footer {
		   left: 0;
		   bottom: 0;
		   width: 100%;
		   text-align: center;
		   height: 200px;
		}
	</style>
	

	<link href="style.css" rel="stylesheet">


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

		$name = $email = $password1 = $password2 = $date = $month = $year = $gender = $bloodG = $username = "";
		$dob = date('Y/m/d');


		$nameErr = $emailErr = $dobErr = $genderErr = $degreeErr = $bloodGErr = $usernameErr = $passwordErr1 = $passwordErr2 = "";

		$isValid = True;


		if($_SERVER['REQUEST_METHOD']=="POST"){

			if(empty($_POST["name"])){
				$nameErr = "Name is required";
				$isValid = False;
			}

			else{
				if (str_word_count(test_input($_POST["name"]))<2) {
					$nameErr = "Name must contain at least two word";
					$isValid = False;
				}

				elseif (is_numeric(test_input($_POST["name"])[0])==True) {
					$nameErr = "Name must start with a letter";
					$isValid = False;
				}

				elseif(preg_match("/^[a-zA-Z-. ]*$/", test_input($_POST["name"]))!==1){
					$nameErr = "Name Can contain a-z, A-Z, period, dash only";
					$isValid = False;
				}

				else{
					$name = test_input($_POST["name"]);
				}

					
			}

			if(empty($_POST["email"])){
				$emailErr = "Email is required";
				$isValid = False;
			}
			else{
				
			    if (!filter_var(test_input($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
			    	$emailErr = "Invalid email format";
			    	$isValid = False;
		    	}
		    	else{
					$email = test_input($_POST["email"]);
				}
			}

			if(empty($_POST["username"])){
				$usernameErr = "Username is required";
				$isValid = False;
			}

			else{

				
				if (strlen(test_input($_POST["username"])) < 2) {
		            $usernameErr = "Cannot contain less than two characters";
		            $isValid = False;
		        } 

		        elseif (preg_match('/^[A-Za-z0-9\s.-]+$/', test_input($_POST["username"])) !== 1) {
		            $usernameErr = "Can contain a-z, A-Z, period and dash only";
		            $isValid = False;
		        } 
		        else{
					$username = test_input($_POST["username"]);
				}
    		}

    		if(empty($_POST["password1"])){
				$passwordErr1 = "Password is required";
				$isValid = False;
			}

    		else{

				
				if (strlen(test_input($_POST["password1"])) < 8) {
	            	$passwordErr1 = "Password must not be less than eight characters";
	            	$isValid = False;
		        } 

		        elseif (preg_match('/[#$%@]/', test_input($_POST["password1"])) !== 1) {
		            $passwordErr1 = "Password must contain at least one of the special characters (@, #, %)";
		            $isValid = False;
		        }
		        else{
					$password1 = test_input($_POST["password1"]);
				} 
			}

			if(strcmp($password1, test_input($_POST["password2"]))!==0){
				$passwordErr2 = "Password do not match";
				$isValid = False;
			}



			if(!isset($_POST["gender"])){ 
		        $genderErr = " At least one of them must be selected.";
		        $isValid = False;
		    }
		    else{
				$gender =  test_input($_POST["gender"]);
		    }


		    if(empty($_POST["dob"])){
            	$dobErr = "Date of Birth required";
            	$isValid = False;
        	}

        	else{
	            if($_POST["dob"] > date('1999-1-1')){
	                $dobErr="Must be 21+ years old";
	                $isValid = False;
	            }
	            else{
	                $dob=$_POST["dob"];
	            }
        	}


        	if($isValid == True){
        		if(file_exists('data.json'))  
				{  
				    $current_data = file_get_contents('data.json');  
				    $array_data = json_decode($current_data, true);  
				    $extra = array(  
				         'name'               =>     $_POST['name'],  
				         'e-mail'          =>     $_POST["email"],  
				         'username'     =>     $_POST["username"], 
				         'password1'     =>     $_POST["password1"],  
				         'gender'     =>     $_POST["gender"],  
				         'dob'     =>     $_POST["dob"]  
				    );  
				    $array_data[] = $extra;  
				    $final_data = json_encode($array_data);  
				    if(file_put_contents('data.json', $final_data))  
				    {  
				         $message = "<label class='text-success'>File Appended Success fully</p>";  
				    }  
				}  
				else  
				{  
				    $error = 'JSON File does not exist';  
				}

        	}
		}
	 ?>

	<form method="post" action ="<?php echo $_SERVER['PHP_SELF'];?>">
		<table class="table1">
			<tbody>
				<tr class="border_bottom">
					<td class="textstyle" style="padding: 20px; font-size: 40px;"><b>Sign Up</b></td>
				</tr>
				<tr>
					<div class="divPadding">
						<td style="padding-left:20px;">
							<input type="text" id="name" name="name" placeholder="Name" size="23" style="border-radius: 4px; padding:5px; background-color : #f5f7fa"/><span class="red">*
						    	<?php 
						    		if($nameErr) {
									echo $nameErr;
						    		}
						    	?>
					    		
					    	</span>
						</td>
					</div>
				</tr>
					
				<tr>
					<div>
						<td class="textstyle" style="padding-left:20px; padding-top: 10px; " colspan="2">
							<input type="text" id="email" name="email" placeholder="Email Address" size="46" style="border-radius: 4px;padding:5px; background-color :#f5f7fa "/><span class="red">*
						    	<?php 
						    		if($emailErr) {
									echo $emailErr;
						    		}
						    	?>
					    		
					    	</span>
						</td>
					</div>
				</tr>

				<tr>
					<div class="divPadding">
						<td class="textstyle" style="padding-left:20px; padding-top: 10px; ">
							<input type="text"  name="username" placeholder="Username" size="23" style="border-radius: 4px; padding:5px; background-color : #f5f7fa"/><span class="red">*
						    	<?php 
						    		if($usernameErr) {
									echo $usernameErr;
						    		}
						    	?>
					    		
					    	</span>
						</td>
					</div>
				</tr>

				<tr>
					<div class="divPadding">
						<td class="textstyle" style="padding-left:20px; padding-top: 10px; ">
							<input type="text"  name="password1" placeholder="Password" size="23" style="border-radius: 4px; padding:5px; background-color : #f5f7fa"/><span class="red">*
						    	<?php 
						    		if($passwordErr1) {
									echo $passwordErr1;
						    		}
						    	?>
					    		
					    	</span>
						</td>
					</div>
				</tr>


				<tr>
					<div class="divPadding">
						<td class="textstyle" style="padding-left:20px; padding-top: 10px; ">
							<input type="text"  name="password2" placeholder="Confirm Password" size="23" style="border-radius: 4px; padding:5px; background-color : #f5f7fa"/><span class="red">*
						    	<?php 
						    		if($passwordErr2) {
									echo $passwordErr2;
						    		}
						    	?>
					    		
					    	</span>
						</td>
					</div>
				</tr>

				

				
				

				<tr>
					<div>
						<td class="textstyle" style="padding-left:20px; padding-top: 10px;"><label>Gender</label></td>
					</div>
				</tr>

				<tr>
					<div class="divPadding">
						<td class="textstyle" style="padding-left:20px; padding-right: 10px;" colspan="2">
							<input type="radio" id="male" name="gender" value="Male" size="10" style="padding:5px;"/>
							<label>Male</label>
							<input type="radio" id="female" name="gender" value="Female" size="10" style="padding:5px ;"/>
							<label>Female</label>
							<input type="radio" id="Other" name="gender" value="Other" size="10" style="padding:5px ;"/>
							<label>Other</label><span class="red">*
						    	<?php 
						    		if($genderErr) {
									echo $genderErr;
						    		}
						    	?>
					    		
					    	</span><br>
						</td>
						<td></td>
					</div>
				</tr>

				<tr>
					<div>
						<td class="textstyle" style="padding-left:20px; padding-top: 10px;"><label>Date Of Birth</label></td>
					</div>
				</tr>

				<tr>
					<div class="divPadding">
						<td style="padding-left:20px; padding-right: 10px;" colspan="2">
							<input type="date" name="dob" size="10" style="padding:5px; width: 150px;"/><span class="red">*
						    	<?php 
						    		if($dobErr) {
									echo $dobErr;
						    		}
						    	?>
					    		
					    	</span>
							
						</td>
					</div>
				</tr>

				

				


				

				<tr >
					<td class="textstyle" style="padding-left:45%; padding-bottom: 50px;" size="10">
						<div >
							<br><input type="SUBMIT" >
						</div>
					</td>
				</tr>

			</tbody>
		</table>

	</form>
		
	 

	<div class="footer">
  		<p style="text-align: center;"><?php if(isset($message)){echo $message;} ?></p>
	</div>


</body>

</html>