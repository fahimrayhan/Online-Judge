<?php
	
	if(!$isLoggedIn){
		include "404.php";
		return;
	}

	if(isset($_POST['problemId'])){
		$problemId = $_POST['problemId'];
		$ok = 1;

		$checkProblemInProblemSet = $Problem->checkProblemInProblemSet($problemId);
        if($checkProblemInProblemSet ==0 )$ok=0;

        $problemRoles=$Problem->checkProblemModeratorRoles($problemId);
        if($problemRoles == -1)$ok=0;
        if($ok == 0){
        	include "404.php";
        	return;
        }

	}

	
	if(isset($_POST['previewProblem'])){
		$ProblemFormat->buildProblemFormat($_POST['previewProblem']);
	}

	else if(isset($_POST['updateProblem'])){
		$Problem->updateProblem($_POST['updateProblem']);
	}

	else if(isset($_POST['addTestCase'])){
		$TestCase->addTestCase($_POST['addTestCase']);

	}
	else if(isset($_POST['deleteTestCase'])){
		$TestCase->deleteTestCase($_POST['deleteTestCase']);
	}

	if(isset($_POST['updateTestCase'])){
		$TestCase->updateTestCase($_POST['updateTestCase']);
	}

	if(isset($_POST['createSubmission'])){
		$_POST['createSubmission']['submissionJudgeType']="partial";
		echo $Submission->createSubmission($_POST['createSubmission'],1);
	}
	else if(isset($_POST['getModeratorsList'])){
		echo $Problem->getNonProblemModeratorList($_POST['getModeratorsList'],true);
	}

	else if(isset($_POST['addProblemModerator'])){
		$Problem->addProblemModerator($_POST['addProblemModerator']);
	}

	else if(isset($_POST['deleteProblemModerator'])){
		echo $Problem->deleteProblemModerator($_POST['deleteProblemModerator']);
	}

	else if(isset($_POST['addProblem'])){
		echo $Problem->addProblem($_POST['addProblem']);
	}

	else if(isset($_POST['updateProblemSetting'])){
		echo $Problem->updateProblemSetting($_POST['updateProblemSetting']);
	}

	else if(isset($_POST['deleteProblem'])){
		echo $Problem->deleteProblem($_POST['deleteProblem']);
	}

	else if(isset($_POST['reqJudgeProblemList'])){
		echo $Problem->reqJudgeProblemList($_POST['reqJudgeProblemList']);
	}

	else if(isset($_POST['sendProblemSetterRequest'])){
		echo $User->changeUserRole($DB->isLoggedIn,35);
	}
	else if(isset($_POST['changeProblemSample'])){
		$TestCase->updateTestCase($_POST['changeProblemSample']);
	}

	else 
		include "views_action/problem_dashboard/problem_dashboard_ui.php";

?>