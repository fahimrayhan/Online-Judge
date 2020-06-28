<?php
	
	if(isset($_FILES["file"]["name"])){
		echo $User->updateUserPhoto($_FILES);
	}

	if(isset($_POST['updateProfileInfo'])){
		echo $User->updateProfileInfo($_POST['updateProfileInfo']);
	}

	else if(isset ($_POST['UpdatePassword'])){
		echo $SiteEnter->updatePassword($_POST['UpdatePassword']);
	}
	else include "views_action/user/user_action_ui.php";



?>