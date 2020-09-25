<?php
	$contestId = -1;

	if(isset($_POST['contestId'])){
		$contestId = $_POST['contestId'];
	}


	if(isset($_POST['contestRegistrationList'])){
		include "views_action/contest/contest_dashboard/contest_registration_list.php";
		return;
	}

	if(isset($_POST['updateContestInfo'])){
		$contestInfo = array();
		parse_str($_POST['updateContestInfo'], $contestInfo);
		$contestInfo['contestId'] = $_POST['contestId'];
		$response = $Contest->updateContest($contestInfo);
		echo json_encode($response);
	}
	
	//registratiom area
	if(isset($_POST['updateParticipantRegistration'])){

		$registrationList = $_POST['updateParticipantRegistration']['registrationList'];
		$registrationStatus = $_POST['updateParticipantRegistration']['registrationStatus'];

		foreach ($registrationList as $key => $value) {
			$data = [
				'contestId' => $contestId,
				'contestRegistrationId' => $value,
				'registrationStatus' => $registrationStatus
			];
			$response = $Contest->updateRegistration($data);
		}
		
		echo json_encode([
			'error' => 0,
			'errorMsg' => "Successfully $registrationStatus ".count($registrationList)." Registration"
		]);
	}

	if(isset($_POST['deleteParticipantRegistration'])){
		$registrationList = $_POST['deleteParticipantRegistration'];

		foreach ($registrationList as $key => $value) {
			$data = [
				'contestId' => $contestId,
				'contestRegistrationId' => $value
			];
			$response = $Contest->deleteRegistration($data);
		}
		
		echo json_encode([
			'error' => 0,
			'errorMsg' => "Successfully Deleted ".count($registrationList)." Registration"
		]);
	}

	//contest problem area
	if(isset($_POST['addProblem'])){
		$response = $Contest->addProblem($_POST['contestId'],$_POST['addProblem']);
		echo json_encode($response);
	}

	if(isset($_POST['loadProblemsPage'])){
		include "views/contest/contest_admin_panel/page/problems.php";
	}
	
	if(isset($_POST['viewContestProblem'])){
		$problemNumber = $_POST['viewContestProblem'];
		include "views/contest/contest_admin_panel/page/view_problem.php";
	}

	if(isset($_POST['deleteProblem'])){
		$response = $Contest->deleteProblem($_POST['contestId'],$_POST['deleteProblem']);
		echo json_encode($response);
	}

	if(isset($_POST['viewFileManager'])){
		include "views/upload/upload.php";
	}

	if(isset($_POST['downloadRegistrationList'])){
		include "views/contest/contest_admin_panel/page/registration_download.php";
	}

	if(isset($_POST['createRegistrationDownloadFile'])){
		$filterKeyList = $_POST['createRegistrationDownloadFile'];
		include "views/contest/contest_admin_panel/page/registration_csv.php";
	}
	if(isset($_POST['generateUser'])){
		$data = $_POST['generateUser'];
		$data['contestId'] = $_POST['contestId'];
		$response = $Contest->generateUser($data);
		echo json_encode($response);
		
	}
