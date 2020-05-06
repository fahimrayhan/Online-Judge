<?php

	
	
	if(isset($_POST['createSubmission'])){
		echo $Submission->createSubmission($_POST['createSubmission'],2);
	}

	else if(isset($_POST['getSubmissionAllInfo'])){
		echo $Submission->getSubmissionAllInfo($_POST['getSubmissionAllInfo'],true);
	}

	else if(isset($_POST['getSubmissionStatusInfo'])){
		echo $Submission->getJudgeStatusFromId($_POST['getSubmissionStatusInfo'],true);
	}
	else if(isset($_POST['rejudgeSubmission'])){
		$Submission->rejudgeSubmission($_POST['rejudgeSubmission']);
	}

	else if(isset($_POST['updateSubmissionVerdictAllPage'])){
		$info=array();
		$info['filter']['limit']=50;
		$info=$Submission->getSubmissionList(json_encode($info,true),true);
		echo "$info";
	}


	else include "views_action/submission/submission_ui.php";


?>