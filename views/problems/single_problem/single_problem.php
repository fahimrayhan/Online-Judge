<?php
	$ok=0;
	if(isset($_GET['id'])){
		$problemId=$_GET['id'];
		$ok=$Problem->checkProblemInJudgeList($problemId);
	}

	if($ok==1)include "views/problems/single_problem/problem_description.php";
	else $Site->redirectPage("problems.php");



?>