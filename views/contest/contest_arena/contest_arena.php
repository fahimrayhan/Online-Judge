<?php
	
	$ok = 1;
	if(!isset($_GET['id'])){
		$Site->goRedirectPage("index.php","Invalid Action");
		return;
	}

	$contestId = $_GET['id'];
	$error = $Contest->checkContestAuth($contestId);
	
	if($error != ""){
		$Site->goRedirectPage("index.php",$error);
		return;
	}

	$contestInfo = $Contest->getSingleContestInfo($contestId);
	
	$pageList = array(
		"dashboard","problem","standings","submissions","clearifications"
	);

	$actionPage = "dashboard";
	foreach ($pageList as $key => $value) {
		$actionPage = isset($_GET[$value])?$value:$actionPage;
	}

	$basePath = "views/contest/contest_arena/";
	echo "<script>var contestId = $contestId;</script>";

	include $basePath."nav_bar.php";
	include $basePath."contest_header.php";
	include $basePath.$actionPage.".php";
	include $basePath."contest_footer.php";

	

?>