<?php
	
	$ok = 1;
	if(!isset($_GET['id'])){
		$Site->goRedirectPage("index.php","Invalid Action");
		return;
	}

	$contestId = $_GET['id'];

	$checkContestInfo = $Contest->checkContestInfoPage($contestId);

	//$error = $Contest->checkContestAuth($contestId);
	
	if($checkContestInfo['error'] == 1){
		$Site->goRedirectPage("index.php",$checkContestInfo['errorMsg'] );
		include "404.php";
		return;
	}

	$contestInfo = $Contest->getSingleContestInfo($contestId);

	if($contestInfo['contestStatus'] == -1){
		$Site->goRedirectPage("index.php","Contest Is Not Start");
		include "404.php";
		return;
	}
	
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