<?php

	if(isset($_POST['formHashId'])){

	}

	if(isset($_POST['addQuestion'])){

		$formData = $_POST['addQuestion'];
		$formData['formId'] = $_POST['formId'];
		$processData = $Form->processFormQuestion($formData);

		echo "<pre>";
		print_r($processData);
		echo "</pre>";


		if(isset($processData['error']))
			echo json_encode($processData);
		else {
			$response = $Form->addQuestion($processData);
			echo json_encode($response);
		}
	}


	if(isset($_POST['formQuestionList'])){
		$formHashId = $_POST['formHashId'];
		$formId = $Form->getFormIdFromHashId($formHashId);
		include "views/form_builder/form_builder.php";
	}

	if(isset($_POST['deleteFormQuestion'])){
		$response = $Form->deleteFormQuestion($_POST['deleteFormQuestion']);
		echo json_encode($response);
	}

	if(isset($_POST['loadAddQuestionPage'])){
		echo "<div class='formBuilder'>";
			include "views/form_builder/add_form.php";
		echo "</div>";
	}

?>