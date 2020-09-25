
<?php
	include "config/db.php";
	include "config/connect.php";
	include "script/hash/hash.php";
	include "script/test_case/test_case.php";
	include "script/site/site.php";
	include "script/judge/judge.php";

	$Judge1=new Judge(8);
	$Judge1->judgeMultipleSubmission();

?>