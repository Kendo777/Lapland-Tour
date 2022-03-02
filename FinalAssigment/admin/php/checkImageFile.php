<?php
/*
	file:	admin/php/checkImageFile.inc
	desc:	Checks some features of imgfile
*/
// Check if image file is a actual image or fake image
   $check = getimagesize($_FILES["imgFile"]["tmp_name"]);
		if($check !== false) {
			$msg= "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			$msg= "File is not an image.";
			$uploadOk = 0;
		}
	
	// Check if file already exists
	if (file_exists($target_file)) {
		$msg= "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["imgFile"]["size"] > 500000) {
		$msg= "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		$msg.= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
?>