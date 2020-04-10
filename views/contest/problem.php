<?php
	$problemData=$Problem->getProblemInfo(1);
	$problemData['problemName']="A. ".$problemData['problemName'];

?>

<div class="row">
	<div class="col-md-9">
		<div class="box">
			<div class="box_body">
				<?php $ProblemFormat->buildProblemFormat($problemData); ?>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="box">
			<div class="box_header">Submit</div>
			<div class="box_body">
				<button style="width: 100%">Submit Your Solution</button>
			</div>
		</div>
	</div>
</div>