<?php
	$ok=0;
	$problemId = -1;
	if(isset($_POST['loadTestCasePage']))$problemId = $_POST['loadTestCasePage'];
	if(isset($_GET['loadTestCasePage']))$problemId = $_GET['loadTestCasePage'];

	$ok = $Problem->checkProblemInProblemSet($problemId);

	if($ok)include "views/test_case/test_case_list.php";
	else include "404.php";


?>