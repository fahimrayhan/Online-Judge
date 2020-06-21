<?php 

	if(isset($_POST['loadAddTestCasePage'])){
		include "views/test_case/add_test_case.php";
		return;
		$data = array();
		$data = $_POST['loadAddTestCasePage'];
		$data['inputData']['type']="text";
		$data['inputData']['text']="1 2 3";
		$data['outputData']['type']="url";
		$data['outputData']['url']="https://judgedat.u-aizu.ac.jp/testcases/ITP1_1_A/1/out";

		$TestCase->addTestCase($data);
		//downloadFile();
	}

	if (isset($_POST['loadUpdateTestCasePage'])) {
		$testCaseHashId = $_POST['loadUpdateTestCasePage'];
		include "views/test_case/edit_test_case.php";
	}

	if(isset($_POST['saveTestCase'])){
		$TestCase->addTestCase($_POST['saveTestCase']);
	}


	if(isset($_POST['downloadProblem'])){
		$response = $Download->singleProblemZip($_POST['downloadProblem'],true);
		echo "$response";
	}

	if(isset($_POST['updateTestCase'])){
		//print_r($_POST['updateTestCase']);
		$TestCase->updateTestCase($_POST['updateTestCase']);
	}



?>