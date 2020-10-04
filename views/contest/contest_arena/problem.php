<?php
	$problemData=$Contest->getContestProblemList($contestId);
	$problemNumber = $_GET['problem'];
	if(!isset($problemData[$problemNumber])){
		include "$basePath"."dashboard.php";
		return;
	}
	$problemData = $problemData[$problemNumber];
	$problemData = $Problem->getProblemInfo($problemData['problemId']);
	$problemData['problemName']="$problemNumber. ".$problemData['problemName'];

	

	$submissionList = $ContestAreana->getContestSubmissionList([
		'contestId' => $contestId,
		'where' => [
			'userId' => $DB->isLoggedIn,
			'problemId' => $problemData['problemId']
		],
		'limit' => 5
	]);

?>
<script type="text/javascript">
	var problemNumber = "<?php echo $problemData['problemNumber']; ?>";
</script>

<div class="row">
	<div class="col-md-9">
		<div class="contestBox">
			<div class="contestBoxBody">
				<?php $ProblemFormat->buildProblemFormat($problemData); ?>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="contestBox">
			<div class="contestBoxHeader">Clearifications</div>
			<div class="contestBoxBody" style="margin-bottom: 1px;">
				sdf
			</div>
			<div class="contestBoxBody">
				sadf
			</div>
		</div>
		<div class="contestBox">
			<div class="contestBoxHeader">Submit</div>
			<div class="contestBoxBody">
				<button class="contestNavBtn" style="width: 100%" onclick="loadSubmitProblem(this)"><i class="fa fa-upload" ></i> Submit Your Solution</button>
			</div>
		</div>
		<div class="contestBox">
			<div class="contestBoxHeader">Recent Submission</div>
			<div class="contestBoxBody">
			<table width="100%">
				<?php 
						$c=0;
						foreach ($submissionList as $key => $value) {
							$submissionId=$value['submissionId'];
							$submissionTime=$value['submissionTimeTimer'];
							//$ago=$Site->dateToAgo($submissionTime);
							$c++;
							if($c>5)break;
					?>
					<tr style="border: 1px solid #E7ECF1;border-width: 0px 0px 1px 0px;">
						<td style="padding: 7px 0px 7px 0px;"><a href="javascript:viewSubmissionById(<?php echo $submissionId; ?>)" title='<?php echo $value['submissionTime']; ?>'><?php echo $submissionTime; ?></a></td>
						<td style="padding: 7px 0px 7px 0px;" id="submissionGlobalVerdictStatus_<?php echo $submissionId; ?>"><?php echo $value['judgeStatus']['verdictLabel']; ?></td>
					</tr>
					<?php } ?>
					
			</table>
			</div>
		</div>
	</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.0/ace.js"></script>
