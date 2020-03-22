<?php
	if(isset($_POST['loadTestCasePage'])){
		$problemId=$_POST['loadTestCasePage'];
		echo "<div style='text-align: right; margin-bottom: 10px;'><button onclick='loadAddTestCasePage()'><span class='glyphicon glyphicon-plus'></span> Add Test Case</button></div>";
		echo "<table width='100%'>";
		echo "<tr>
			<td class='td1'>Order</td>
			<td class='td1'>Input File</td>
			<td class='td1'>Output File</td>
			<td class='td1'>Added Date</td>
			<td class='td1'>Added By</td>
			<td class='td1'></td>
			</tr>";
		$info=$TestCase->getTestCaseList($problemId);

		$c=0;
		foreach ($info as $key => $value) {
			$c++;
			$date=$value['testCaseAddedDate'];
			$handle=$value['userHandle'];
			$inputUrl=$value['inputUrl'];
			$inputSize=$value['inputFileSize'];
			$outputUrl=$value['outputUrl'];
			$outputSize=$value['outputFileSize'];
			$hashId=$value['testCaseIdHash'];
			echo "<tr>
			<td class='td2'>$c</td>
			<td class='td2'><a href='$inputUrl' target='_blank'>input-$c.txt ($inputSize Bytes)</a></td>
			<td class='td2'><a href='$outputUrl' target='_blank'>output-$c.txt ($outputSize Bytes)</a></td>
			<td class='td2'>$date</td>
			<td class='td2'>$handle</td>
			<td class='td2'> 
				<button value='$hashId' class='btn-sm' id='btn_edit_$c' onclick='loadEditTestCasePage($c)'><span class='glyphicon glyphicon-pencil'></span></button>
				<button id='btn_del_$c' onclick='deleteTestCase($c)' value='$hashId' class='btn-sm'><span class='glyphicon glyphicon-trash'></span></button>
			</td>
			</tr>";
		}
		echo "</table>";
	}

	else if(isset($_POST['loadProblemAddPage'])){
		echo "<div id='error_area' style='display: none' class='alert alert-danger'></div>";
		echo "<b>Problem Name</b><input id='problemName' class='form-control' placeholder='Enter Problem Name'></input>";
		echo "<br/><b>Time Limit</b> (Time limit unit is second and max time limit is 15 s)<input id='problemTimeLimit' type='number' max='4' class='form-control' placeholder='Enter Problem Time Limit'></input>";
		echo "<br/><b>Memory Limit</b> (Memory Limit unit is KB)<input id='problemMemoryLimit' type='number' step='0.01' class='form-control' placeholder='Enter Problem Memory'></input>";
		echo "<br/><center><button id='addProblem' onclick='addProblem()'>+Add Problem</button></center>";
	}

	else if(isset($_POST['loadAddTestCasePage'])){
		echo "<b style='font-size: 17px;'>Input</b><br/><textarea class='dashboard_input_text_area' id='inputValue'></textarea><br/>";
		echo "<b style='font-size: 17px;'>Output</b><br/><textarea class='dashboard_input_text_area' id='outputValue'></textarea><br/>";
		echo "<center><button onclick='addTestCase()'>Add Test Case</button></center>";
	}

	else if(isset($_POST['loadEditTestCasePage'])){
		$hashId=$_POST['loadEditTestCasePage'];
		$info=$TestCase->getTestCaseData($hashId);
		$input=$info['input'];
		$output=$info['output'];
		echo "<b style='font-size: 17px;'>Input</b><br/><textarea class='dashboard_input_text_area' id='inputValue'>$input</textarea><br/>";
		echo "<b style='font-size: 17px;'>Output</b><br/><textarea class='dashboard_input_text_area' id='outputValue'>$output</textarea><br/>";
		echo "<center><button onclick='updateTestCase()' id='btnUpdate' value='$hashId'>Update Test Case</button></center>";
	}

	else if(isset($_POST['loadOverviewPage'])){
		$problemStat=$Problem->problemStat($_POST['loadOverviewPage']);
		$totalModerator=$problemStat['totalModerator'];
		$totalTestCase=$problemStat['totalTestCase'];
		$totalSubmission=$problemStat['totalSubmission'];
		echo "<div class='row'>
    			<div class='col-md-4'>
      				<div class='card-counter custom'>
        				<i class='fa fa-code-fork'></i>
        				<span class='count-numbers'>$totalSubmission</span>
        				<span class='count-name'>Total Submission</span>
      				</div>
      			</div>
      			<div class='col-md-4'>
      				<div class='card-counter custom'>
        				<i class='fa fa-code-fork'></i>
        				<span class='count-numbers'>$totalTestCase</span>
        				<span class='count-name'>Total Test Case</span>
      				</div>
      			</div>
      			<div class='col-md-4'>
      				<div class='card-counter custom'>
        				<i class='fa fa-users'></i>
        				<span class='count-numbers'>$totalModerator</span>
        				<span class='count-name'>Total Moderator</span>
      				</div>
      			</div>

    		</div>";
	}

	else if(isset($_POST['loadModeratorsPage'])){
		$problemId=$_POST['loadModeratorsPage'];
		$moderatorList=$Problem->getProblemModeratorList($problemId,false);
		$problemRoles=$Problem->checkProblemModeratorRoles($problemId);
		
		echo "
		<div class='row'>	
			<div class='col-md-7'>
				<div class='boxx none_border'>
				<div class='box_bodyy' style='padding-left: 15px;'>
		";
		foreach ($moderatorList as $key => $value) {
			$userPhoto=$value['userPhoto'];
			$userHandle=$value['userHandle'];
			$userId=$value['userId'];
			$moderatorRoles=$value['moderatorRoles'];

			$delBtn="";
			$roleName="<span class='label label-success'>Owner</span>";
			if($moderatorRoles>10){
				$delBtn="<button onclick='deleteProblemModerator($userId)' class='btn btn-sm btn-danger'>Delete</button>";
				$roleName="<span class='label label-default'>Moderator</span>";
			}

			if($problemRoles==2){
				if($userId!=$DB->isLoggedIn)
					$delBtn="";
			}

			echo "<div class='row userListCard'>
				<div class='col-md-2 col-sm-2'>
					<img class='img-thumbnail userListImg' src='$userPhoto'>
				</div>
				<div class='col-md-10 col-sm-10'>
					<div class='userListBody'>
						<div class='pull-right'>
							$delBtn
						</div>
						<a href=''>$userHandle</a><br/>
						<span class='userPermission'>$roleName</span>
					</div>
				</div>
			</div>";
		}

		if($problemRoles==1){

			echo "</div></div></div>
				<div class='col-md-5'>
					<div class='box none_border'>
					<div class='box_header'>Add Moderator</div>
					<div class='box_body'>
						<input type='text' onkeyup='search_moderators()' autocomplete='off' class='form-control' id='search_moderators' placeholder='Enter Moderator Handle'>
						<div id='suggestion_box' class='moderators_suggestion_box'>
						</div>
					</div>
					</div>
					</div>
			</div>";
		}
	}


	if(isset($_POST['loadTestingPage'])){
		$problemId=$_POST['loadTestingPage'];
		echo "<div style='text-align: right; margin-bottom: 10px;'><button onclick='loadCreateSubmissionPage()'><span class='glyphicon glyphicon-plus'></span> Create Submission</button></div>";

		echo "<div class='table-responsive'><table width='100%'>";
		echo "<tr>
			<td class='td1'>#</td>
			<td class='td1'>When</td>
			<td class='td1'>Who</td>
			<td class='td1'>Lang</td>
			<td class='td1'>Verdict</td>
			<td class='td1'>Time</td>
			<td class='td1'>Memory</td>
			</tr>";
		$info=$Submission->getSubmissionList('{"problemId":'.$problemId.'}');
		foreach ($info as $key => $value) {
			$submissionId=$value['submissionId'];
			$languageId=$value['languageName'];
			$userId=$value['userId'];
			$userHandle=$value['userHandle'];
			$submissionTime=$value['submissionTime'];
			$judgeStatus=$value['judgeStatus'];
			$time=$value['maxTimeLimit'];
			$memory=$value['maxMemoryLimit'];
			
			echo "<tr>
			<td class='td2'><a href='submission.php?id=$submissionId' target='_blank'>$submissionId</a></td>
			<td class='td2'>$submissionTime</td>
			<td class='td2'><a href='profile.php?id=$userId'>$userHandle</a></td>
			<td class='td2'>$languageId</td>
			<td class='td2'>$judgeStatus</td>
			<td class='td2'>$time s</td>
			<td class='td2'>$memory kb</td>
			</tr>";
		}
		echo "</table></div>";
	}

	if(isset($_POST['loadCreateSubmissionPage'])){
		$ProblemFormat->getSubmissionArea('createSubmission');
	}

	if(isset($_POST['loadSettingPage'])){
		$problemInfo=$Problem->getProblemInfo($_POST['loadSettingPage']);
		$problemName=$problemInfo['problemName'];
		$timeLimit=$problemInfo['cpuTimeLimit'];
		$memoryLimit=$problemInfo['memoryLimit'];
		$check=$Problem->checkJudgeProblemList($_POST['loadSettingPage']);
		$arcive="<button id='reqArc' onclick='reqJudgeProblemList()'>Request For Add This Problem In Judge Problem List</button>";
		if($check==1)$arcive="Your problem is added in judge problem list.";
		else if($check==0)$arcive="Your Request is pending";
		echo "<div class='row'>";
		echo "<div class='col-md-6'>";
		echo "<div id='error_area' style='display: none' class='alert alert-danger'></div>";
		echo "<b>Problem Name</b><input id='problemName' value='$problemName' class='form-control' placeholder='Enter Problem Name'></input>";
		echo "<br/><b>Time Limit</b> (Time limit unit is second and max time limit is 15 s)<input id='problemTimeLimit' type='number' value='$timeLimit' max='4' class='form-control' placeholder='Enter Problem Time Limit'></input>";
		echo "<br/><b>Memory Limit</b> (Memory Limit unit is KB)<input id='problemMemoryLimit' value='$memoryLimit' type='number' step='0.01' class='form-control' placeholder='Enter Problem Memory'></input>";
		echo "<br/><center><button id='updateProblem' onclick='updateProblemSetting()'>Update Problem Problem</button></center>";
		echo "</div><div class='col-md-6'><center>$arcive</center></div>";
		echo "</div>";
	}



?>
