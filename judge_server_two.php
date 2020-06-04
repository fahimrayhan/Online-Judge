
<?php
	include "config/db.php";
	include "config/connect.php";
	include "script/hash/hash.php";
	include "script/site/site.php";
	include "script/judge/judge.php";

	$Judge1=new Judge(1);
	$Judge1->judgeMultipleSubmission();

?>