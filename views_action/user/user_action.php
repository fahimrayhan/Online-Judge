<?php
	
	if(isset($_FILES["file"]["name"])){
		echo $SiteEnter->updateUserPhoto($_FILES);
	}

	if(isset($_POST['saveUserInfo'])){

	}

	else if(isset ($_POST['UpdatePassword'])){
		echo $SiteEnter->updatePassword($_POST['UpdatePassword']);
	}
	else include "views_action/user/user_action_ui.php";



?>