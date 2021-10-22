<!DOCTYPE html>
<html>
<head>

	<link href="style.css" rel="stylesheet">
	<style type="text/css">
		
	</style>
	

	<meta charset="utf-8">
	<title></title>
</head>
<body>
<?php include 'heading2.php'?>
<?php include 'navigation.php'?>

	<?php 
		$name = $email = $gender = "";
		$dob = date('Y/m/d');

		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}

		$name = $_SESSION['name'];
		$email  = $_SESSION['email'];
		$gender =  $_SESSION['gender'];;
		$dob = $_SESSION['dob'];


		$nameErr = $emailErr = $dobErr = $genderErr =  "";

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
				    $current_data = json_decode($current_data, true);  
				    if (!empty($current_data)) {
						foreach ($current_data as $key => $row) {
							if ($username == $row["username"] ?? "") {
								$current_data[$key]['name'] = $name;
								$_SESSION['name'] = $name;
								$current_data[$key]['email'] = $email;
								$_SESSION['email'] = $email;
								$current_data[$key]['dob'] = $dob;
								$_SESSION['dob'] = $dob;
								$current_data[$key]['gender'] = $gender;
								$_SESSION['gender'] = $gender;
								break;
							}
						}
					}
				    $final_data = json_encode($current_data);  
				    if(file_put_contents('data.json', $final_data))  
				    {  
				         $message = "<label class='text-success'>Profile Edited.</p>";  
				    }  
				}  
				else  
				{  
				    $error = 'Profile edit unsuccessful';  
				}

        	}
		}
	 ?>

	<form method="post" action ="<?php echo $_SERVER['PHP_SELF'];?>">
		<table class="dashboard">
			<tbody>
				<tr class="border_bottom">
					<td class="textstyle" style="padding: 20px; font-size: 40px;"><b>Sign Up</b></td>
				</tr>
				<tr>
					<div class="divPadding">
						<td style="padding-left:20px;">
							<input type="text" id="name" name="name" value="<?php echo $name ?>" size="23" style="border-radius: 4px; padding:5px; background-color : #f5f7fa" disabled/><span class="red">*
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
							<input type="text" id="email" name="email" value="<?php echo $email ?>" size="46" style="border-radius: 4px;padding:5px; background-color :#f5f7fa " disabled/><span class="red">*
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
					<div>
						<td class="textstyle" style="padding-left:20px; padding-top: 10px;"><label>Gender</label></td>
					</div>
				</tr>

				<tr>
					<div class="divPadding">
						<td class="textstyle" style="padding-left:20px; padding-right: 10px;" colspan="2">
							<?php 
								if($gender == "Male"){
									$g1 = 'checked';
									$g2 = '';
									$g3 = '';
								}
								elseif($gender == "Female"){
									$g1 = '';
									$g2 = 'checked';
									$g3 = '';
								}
								else{
									$g1 = '';
									$g2 = '';
									$g3 = 'checked';
								}
								echo $genderRadio = "<input type=radio  name=gender value='Male' size=10 style=padding:5px; disabled $g1>
								<label>Male</label>
								<input type=radio name=gender value='Female' size=10 style=padding:5px ; disabled $g2>
								<label>Female</label>
								<input type=radio name=gender value='Other' size=10 style=padding:5px ;  disabled $g3>
								<label>Other</label>";
						    	
								
								if($genderErr) {
								echo $genderErr;
								}
							?>
						</td>
					</div>
				</tr>

				<tr>
					<div>
						<td class="textstyle" style="padding-left:20px; padding-top: 10px;"><label>Date Of Birth</label></td>
					</div>
				</tr>

				<tr>
					<div class="divPadding">
						<td style="padding-left:20px; padding-right: 10px; padding-bottom: 20px" colspan="2">
							<input type="date" name="dob" value="<?php echo $dob ?>" size="10" style="padding:5px; width: 150px;" disabled/><span class="red">*
						    	<?php 
						    		if($dobErr) {
									echo $dobErr;
						    		}
						    	?>
					    		
					    	</span>
							
						</td>
					</div>
				</tr>


			</tbody>
		</table>

	</form>
		
	 

	<?php include 'footer.php'; ?>


</body>

</html>