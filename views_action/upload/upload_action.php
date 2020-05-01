<?php
	if($DB->userRole>30){
		include "404.php";
		return;
	}

	if(isset($_FILES["file"]["name"])){
		echo $File->uploadFile($_FILES);
	}

	if(isset($_POST['deleteUploadPhoto'])){
		$File->deleteFile($_POST['deleteUploadPhoto']);
	}

	if(isset($_POST['loadImageList'])){
		include "views/upload/upload_list.php";
	}

	if(isset($_POST['loadUploadPhotoArea'])){
		include "views/upload/upload_form.php";
	}


?>