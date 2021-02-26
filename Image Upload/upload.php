<?php 
	
	$image = '';

	if (isset($_FILES['file']['name'])) {
		$image_name        =  $_FILES['file']['name'];
		$valid_extensions  =  array("jpg", "jpeg", "png");
		$extension 		   =  pathinfo($image_name, PATHINFO_EXTENSION);
		if(in_array($extension, $valid_extensions)){
			$upload_path = '../Image Upload/' . time() . '.' . $extension;
			if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_path)) {
				$message = "Image Uploaded Successfully";
				$image   = $upload_path;
			}
			else{
				$message = "Image not uploaded";
			}
		}
		else{
			$message = "Only .jpg, .jpeg and .png image allowed to upload";
		}
	}
	else{
		$message = "Select Image";
	}	
	$output = array(
		'message'	=>	$message,
		'image'		=>  $image
	);
		echo json_encode($output);

?>