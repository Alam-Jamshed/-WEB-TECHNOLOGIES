<!DOCTYPE html>
<html>
<head>
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<?php
    $pictureErr=$passwordErr=$confirm_passwordErr= "";
    $ImageError = $UploadConfirmation = "";
    $target_file="";

    if(isset($_POST['submit'])){
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        echo $target_file;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $filepath = "";    
        if($_FILES['fileToUpload']['name'] != "")
        {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                
                $uploaded = 1;
            } else {
                $ImageError = "File is not an image.";
                $uploaded = 0;
            }
        
            if (file_exists($target_file)) {
                $ImageError = "Sorry, file already exists.";
                $uploaded = 0;
            }
        
            if ($_FILES["fileToUpload"]["size"] > 40000000000) {
                $ImageError = "Sorry, your file is too large.";
                $uploaded = 0;
            }
        
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $ImageError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploaded = 0;
            }
        
            if ($uploadOk == 0) {
                $ImageError = "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $UploadConfirmation = "File has been uploaded Successfully";
                    $filepath = $target_dir . htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
                } else {
                    $ImageError = "Sorry, there was an error uploading your file.";
                }
            }
        }else{
            $ImageError="No Image was selected";
        }
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <h1>Change Picture</h1>
		<div class="picture">
      		<img src="<?php if(!empty($target_file)){echo $target_file;} ?>" alt="" width="100px" height="200px"><br>
      		<span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
	        <?php
	        	if ($ImageError) {
	            echo ($ImageError);
	        }
	        ?>
      		</span>
		<input type="file" name="fileToUpload" id="fileToUpload">
		</div>
		<div class="button">
            <input type="submit" name="submit" class="submit_button" value="Submit">
        </div>
    </form>
	<span style="color:green; margin-top: 0px; margin-bottom: 0px;text-align: center;">
	    <?php  
	         if(isset($message))  
	         {  
	              echo $message;  
	         }  
	    ?>
	</span>

</body>
</html>