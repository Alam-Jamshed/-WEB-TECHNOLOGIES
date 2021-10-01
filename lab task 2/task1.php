<!DOCTYPE html>
<html>
<head>


	<style>

		.red{
			color: red;
		}

		table{
			border-collapse: collapse; 
			border: 1px  black;
	  		border-radius: 4px;
	  		box-shadow: 0px 0px 4px 2px #888;
	  		margin-right: auto;
	  		margin-left: auto;
	  		margin-top: 10%;
	  		width: 500px;
		}
		
		.t1{
			
			
	  		
	  		

		}
		tr.border_bottom{
			border-bottom: 1px black;
		}

		.textstyle{
			font-family:Helvetica;
			align: left | center; 
		}

		.divPadding{
			float:left;	
		}

	</style>


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

		$name = $email = $date = $month = $year = $gender = $bloodG = "";
		$degree = array();
		$nameErr = $emailErr = $dobErr = $genderErr = $degreeErr = $bloodGErr = "";

		if($_SERVER['REQUEST_METHOD']=="POST"){

			if(empty($_POST["name"])){
				$nameErr = "Name is required";
			}

			else{

				$name = test_input($_POST["name"]);


				if (str_word_count(test_input($_POST["name"]))<2) {
					$nameErr = "Name must contain at least two word";
				}

				

				elseif(!preg_match("/^[a-zA-Z-. ]*$/", $name)){
					$nameErr = "Name Can contain a-z, A-Z, period, dash only";
				}

				elseif (!ctype_alpha(mb_substr($name, 0, 1, "UTF-8"))) {
					$nameErr = "Name must start with a letter";
				}

				
			}

			if(empty($_POST["email"])){
				$emailErr = "Email is required";
			}
			else{
				$email = test_input($_POST["email"]);
			    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			    	$emailErr = "Invalid email format";
		    	}
			}

			if(empty($_POST["date"])){
				$dobErr = "Date is required";
			}

			else{
				$date = test_input($_POST["date"]);
				if ((int)$date < 1 || (int)$date > 31) {
					$dobErr = "Date must be between 1-31";
				}
			}

			if(empty($_POST["month"])){
				$dobErr = "Month is required";
			}

			else{
				$month = test_input($_POST["month"]);
				if ((int)$month < 1 || (int)$date > 12) {
					$dobErr = "Month must be between 1-12";
				}
			}

			if(empty($_POST["year"])){
				$dobErr = "Year is required";
			}

			else{
				$year = test_input($_POST["year"]);
				if ((int)$year < 1953 || (int)$year > 1998) {
					$dobErr = "Year must be between 1953-1998";
				}
			}

			

			if(!isset($_POST["gender"])){ 
		        $genderErr = " At least one of them must be selected."; 
		    }
		    else{
		    	$gender =  test_input($_POST["gender"]);
		    }
		

		    if (empty($_POST['check_list'])) {

		    	$degreeErr = "At least two of them must be selected.";
	              
          	}
			else {
			  	$checked_count = count($_POST['degree']);
	            
	            if (checked_count<2) {
	            	$degreeErr = "At least two of them must be selected";
	            }

	            else{
		            foreach (test_input($_POST['check_list']) as $selected) {
						array_push($degree, $selected);
	              	}
	            }
			}

			if(!isset($_POST["bloodgroup"])){ 
		        $bloodGErr = " At least one of them must be selected."; 
		    }
		    else{
		    	$bloodG =  test_input($_POST["bloodgroup"]);
		    }




		}
	 ?>

	<form method="post" action ="<?php echo $_SERVER['PHP_SELF'];?>">
		<table>
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
							<input type="text" id="email" name="email" placeholder="Email Address" size="57.5" style="border-radius: 4px;padding:5px; background-color :#f5f7fa "/><span class="red">*
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
						<td class="textstyle" style="padding-left:20px; padding-top: 10px;"><label>Date Of Birth</label></td>
					</div>
				</tr>

				
				<tr>
					<div class="divPadding">
						<td style="padding-left:20px; padding-right: 10px;" colspan="2">
							<input type="text" id="date" name="date" placeholder="Date" size="10" style="padding:5px;"/>
							<input type="text" id="month" name="month" placeholder="Month" size="10" style="padding:5px ;"/>
							<input type="text" id="year" name="year" placeholder="Year" size="10" style="padding:5px ;"/><span class="red">*
						    	<?php 
						    		if($dobErr) {
									echo $dobErr;
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
						<td  class="textstyle" style="padding-left:20px; padding-top: 10px;"><label>Degree</label></td>
					</div>
				</tr>

				<tr>
					
					<td class="textstyle" style="padding-left:20px; padding-right: 10px;" colspan="2" >
						<div class="divPadding">
							<input type="checkbox" id="degree1" name="degree[]" value="SSC" size="10" style="padding:5px;"/>
							<label>SSC</label>
							<input type="checkbox" id="degree2" name="degree[]" value="HSC" size="10" style="padding:5px ;"/>
							<label>HSC</label>
							<input type="checkbox" id="degree3" name="degree[]" value="BSc" size="10" style="padding:5px ;"/>
							<label>BSc</label>
							<input type="checkbox" id="degree4" name="degree[]" value="MSc" size="10" style="padding:5px ;"/>
							<label>MSc</label><span class="red">*
						    	<?php 
						    		if($degreeErr) {
									echo $degreeErr;
						    		}
						    	?>
					    		
					    	</span>
						</div>
					</td>
					
				</tr>


				<tr>
					<div>
						<td class="textstyle" style="padding-left:20px; padding-top: 10px;"><label>Blood Group</label></td>
					</div>
				</tr>

				<tr>
					<div class="divPadding">
						<td class="textstyle" style="padding-left:20px; padding-right: 10px;" size="10">
							<select name="bloodgroup" style="width: 100px;">
								<option style="display:none"></option>
							    <option value="A+">A+</option>
							    <option value="A-">A-</option>
							    <option value="B+">B+</option>
							    <option value="B-">B-</option>
							 </select><span class="red">*
						    	<?php 
						    		if($bloodGErr) {
									echo $bloodGErr;
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
	<?php 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		echo "<h1>Your Input:</h1>";
	}
	echo $name."<br>";
	echo $email."<br>";
	echo $gender."<br>";
	echo $date."<br>";
	echo $month."<br>";
	echo $year."<br>";
	echo $bloodG."<br>";
 ?>
	
	 

		

</body>
</html>