<?php

	
	
	if(isset($_POST['createSubmission'])){
		echo $Submission->createSubmission($_POST['createSubmission'],2);
	}

	else if(isset($_POST['getSubmissionAllInfo'])){
		$data = $Submission->getSubmissionAllInfo($_POST['getSubmissionAllInfo']);
		echo json_encode($data);
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
	else if(isset($_POST['submissionListFilter'])){
		$filterData=$_POST['submissionListFilter'];
		include "views/submission/submission_list_table.php";
	}


	else include "views_action/submission/submission_ui.php";


?>