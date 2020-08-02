<?php
	$problemData=$Contest->getContestProblemList($contestId);
	$problemNumber = $_GET['problem'];
	if(!isset($problemData[$problemNumber])){
		include "$basePath"."dashboard.php";
		return;
	}
	$problemData = $problemData[$problemNumber];
	$problemData['problemName']="$problemNumber. ".$problemData['problemName'];

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
			<div class="contestBoxHeader">Submit</div>
			<div class="contestBoxBody">
				<button style="width: 100%" onclick="loadSubmitProblem(this)">Submit Your Solution</button>
			</div>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.0/ace.js"></script>
