<?php

	if(isset($_POST['login'])){
		$resonse = $User->login($_POST['login']);
		echo json_encode($resonse);
	}
	else if(isset($_POST['register'])){
		echo $SiteEnter->register($_POST['register']);
	}
	


?>