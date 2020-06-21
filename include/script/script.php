<?php
	
	include "config/config.php";
	include "script/hash/hash.php";
	include "script/site_enter/site_enter.php";
	include "script/site/site.php";
	include "script/user/user.php";
	include "script/admin/admin.php";
	include "script/problem/problem.php";
	include "script/problem/problem_format.php";
	include "script/test_case/test_case.php";
	include "script/submission/submission.php";
	include "script/judge/judge_process.php";
	include "script/file/file.php";
	include "script/download/download.php";
	$DB=new Database();

	$isLoggedIn=(isset($_SESSION['oj_login_handle_id']))?1:0;
	
	$SiteHash=new SiteHash();
	$SiteEnter=new SiteEnter();
	$Site=new Site();
	$User=new User();
	$Admin=new Admin();
	$Problem=new Problem();
	$ProblemFormat=new ProblemFormat();
	$TestCase=new TestCase();
	$Submission=new Submission();
	$JudgeProcess=new JudgeProcess();
	$Download=new Download();

	$File=new File();

	$loggedInUserInfo=array();
	if($isLoggedIn){
		$loggedInUserInfo=$User->getSingleUserInfo($DB->isLoggedIn);
		$loggedInUserInfo=$loggedInUserInfo[0];
	}

?>