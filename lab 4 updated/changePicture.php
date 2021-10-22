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
		$pictureErr  = "";
		$ImageError = $UploadConfirmation = "";
		$target_file = "";
		$old_file = $_SESSION['picture'];
		$mypic = "";
	
		if (isset($_POST['submit'])) {
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			$filepath = "";
			if ($_FILES['fileToUpload']['name'] != "") {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if ($check !== false) {
	
					$uploaded = 1;
				} else {
					$ImageError = "File is not an image.";
					$uploaded = 0;
				}
	
				if (file_exists($target_file)) {
					$ImageError = "File already exists.";
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
	
				if ($uploaded == 0) {
					$ImageError = "Sorry, your file was not uploaded.";
				} else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						$mypic = $target_file;
						$UploadConfirmation = "File has been uploaded Successfully";
						if ($old_file != "broken.png") {
							unlink($old_file);
						}
						$filepath = $target_dir . htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
	
						$data = file_get_contents("data.json");
						$data = json_decode($data, true);
						if (!empty($data)) {
							foreach ($data as $key => $row) {
								if ($row["username"] == $_SESSION['username']) {
									$data[$key]['picture'] = $filepath;
									$_SESSION['picture'] = $filepath;
									break;
								}
							}
	
							file_put_contents('data.json', json_encode($data));
						}
					} else {
						$ImageError = "Sorry, there was an error uploading your file.";
					}
				}
			} else {
				$ImageError = "No Image was selected";
			}
		}
	 ?>

	<form method="post" action ="<?php echo $_SERVER['PHP_SELF'];?>">
		<table class="dashboard">
			<tbody>
				<tr class="border_bottom">
					<td class="textstyle" style="padding: 20px; font-size: 40px;"><b>Change Picture</b></td>
				</tr>
				<tr>
					<div class="divPadding">
						<td style="padding-left:20px;">
						<img src="<?php if (!empty($filepath)) {
                                            echo $filepath;
                                        } else {
                                            echo $old_file;
                                        } ?>" alt="" width="300px" height="300px"><br>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <span style="color: red;font-size: 15px;font-weight: 247px; width: 247px; margin-top: 0px; margin-bottom: 0px;">
                                <?php
                                if ($ImageError !== "") {
                                    echo ($ImageError);
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
		
	 

	<?php include 'footer.php'; ?>


</body>

</html>