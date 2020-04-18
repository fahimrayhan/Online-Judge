<?php
	include "script.php";
	if(isset($_POST['updateSiteStatus'])){
		$User->updateUserStatus($_POST['updateSiteStatus']);
	}
	


?>