<?php

	if(isset($_POST['getContestAnnouncement'])){
		$contestId = $_POST['getContestAnnouncement'];
		$contestAnnouncementList = $Contest->getContestCommentList($contestId,"Announcement","desc");
		$contestAnnouncementList = json_encode($contestAnnouncementList,true);
		echo "$contestAnnouncementList";
	}

	if(isset($_POST['createContestSubmission'])){
		$retData = $Contest->createContestSubmission($_POST['createContestSubmission']);
		echo json_encode($retData);
	}
	if(isset($_POST['loadSubmitProblem'])){
		include "views/editor/editor.php";
	}

	if(isset($_POST['signUpContestForm'])){
		$contestId = $_POST['signUpContestForm'];
		include "views/contest/contest_list/contest_sign_up_form.php";
	}

	if(isset($_POST['saveData'])){
		//print_r($_POST);
		//print_r($_GET);
		$formData = array();
		parse_str($_POST['saveData']['registrationData'], $formData);
		$data['registrationInfo'] = json_encode($formData);
		$data['contestId'] = $_POST['saveData']['contestId'];
		$Contest->contestRegistration($data);
	}
	if(isset($_POST['updateFormSerial'])){
		$Contest->updateContestRegistrationFormSerial($_POST['updateFormSerial']);
	}
	if(isset($_POST['addFormField'])){
		$Contest->addFormField($_POST['addFormField']);
	}

	if(isset($_POST['loadFormSerial'])){
		include "views/form_builder/update_option_serial.php";
	}


?>