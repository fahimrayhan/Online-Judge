<?php
	include "config/db.php";
	include "config/connect.php";
	include "script/judge/judge_process.php";
	include "script/site/site.php";
	$JudgeProcess=new JudgeProcess();
	$JudgeProcess->processMultipleSubmission();


?>