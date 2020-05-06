<?php
	if(isset($_POST['loadSubmiProblemPage'])){
		$ProblemFormat->getSubmissionArea('createSubmission');
	}

	if(isset($_POST['viewSubmission'])){
    	$submissionId=$_POST['viewSubmission'];
    	include "views/submission/submission_page_ui.php";
  	}



?>