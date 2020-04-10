
<?php
	include "config/db.php";
	include "config/connect.php";
	include "script/judge/judge.php";

	$Judge1=new Judge(2);
	$Judge1->judgeMultipleSubmission();

?>