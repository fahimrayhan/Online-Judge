<?php
	$problemData=$Problem->getProblemInfo($problemId);
	echo "<title>".$problemData['problemId'].". ".$problemData['problemName']." || CoderOJ</title>";
	$ProblemFormat->buildProblemFormat($problemData);
	
?>
