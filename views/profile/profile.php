<?php
	$ok=0;
	if(isset($_GET['id'])){
		$userId=$_GET['id'];
		$userInfo=$User->getSingleUserInfo($userId);
		if(isset($userInfo[0]))$ok=1;
	}

	if($ok==0)$Site->redirectPage("index.php");
	else include "views/profile/profile1.php";

?>