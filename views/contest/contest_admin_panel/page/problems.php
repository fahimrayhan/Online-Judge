<div class="row">
	<div class="col-md-12">
		<div class="pull-right" style="margin-bottom: 10px;">
			<button class="" onclick="addProblemDilog()">Add Problem</button>
			<a href="contest_dashboard.php?id=<?php echo $contestId; ?>&problems_move"><button class="">Update Serial</button></a>
		</div>
	</div>
</div>

<table style="width: 100%">
	<tr>
		<td class="contestTd1">#</td>
		<td class="contestTd1">Problem ID</td>
		<td class="contestTd1">Problem Name</td>
		<td class="contestTd1">Problem Author</td>
		<td class="contestTd1"></td>
	</tr>
	<?php 
		$problemList = $Contest->getContestProblemList($contestId);
		//print_r($problemList);

		foreach ($problemList as $key => $value) {
	?>
	<tr>
		<td class="contestTd2"><b><?php echo $key; ?></b></td>
		<td class="contestTd2"><?php echo $value['problemId']; ?></td>
		<td class="contestTd2"><a href ="javascript:viewContestProblem('<?php echo $key ?>');"><?php echo $value['problemName']; ?></a></td>
		<td class="contestTd2"><a href="profile.php?id=<?php echo $value['userId']; ?>"><?php echo $value['userHandle']; ?></a></td>
		<td class="contestTd2">
			<button class="btn btn-danger btn-sm" onclick="deleteProblem(this)" value="<?php echo $key; ?>">Delete</button>
        </td>
	</tr>
	<?php } ?>
</table>