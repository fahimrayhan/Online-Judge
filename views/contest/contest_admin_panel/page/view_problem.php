<?php
	$problemList = $Contest->getContestProblemList($contestId);
	if(isset($problemList[$problemNumber])){
		$ProblemFormat->buildProblemFormat($problemList[$problemNumber]);
	}
?>