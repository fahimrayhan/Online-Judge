<?php

	if(!$isLoggedIn){
		include "404.php";
		return;
	}
	
	if(isset($_POST['createSubmission'])){
		echo $Submission->createSubmission($_POST['createSubmission'],2);
	}

	if(isset($_POST['getSubmissionAllInfo'])){
		echo $Submission->getSubmissionAllInfo($_POST['getSubmissionAllInfo'],true);
	}

	if(isset($_POST['getSubmissionStatusInfo'])){
		echo $Submission->getJudgeStatusFromId($_POST['getSubmissionStatusInfo'],true);
	}

	else include "views_action/submission/submission_ui.php";


?>