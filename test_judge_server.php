<?php
	include "script.php";
	include "script/judge/judge.php";

	$Judge1=new Judge(0);
	$Judge1->judgeSubmission();

	$Judge2=new Judge(1);
	$Judge2->judgeSubmission();

	$Judge3=new Judge(2);
	$Judge3->judgeSubmission();

	$Judge4=new Judge(3);
	$Judge4->judgeSubmission();

	$Judge5=new Judge(4);
	$Judge5->judgeSubmission();
?>