<?php
	
	if(isset($_POST['saveSubmission'])){
		
	}

	if(isset($_POST['getSubmissionAllInfo'])){
		echo $Submission->getSubmissionAllInfo($_POST['getSubmissionAllInfo'],true);
	}

	else include "views_action/submission/submission_ui.php";


?>