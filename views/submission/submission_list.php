
<div class="box">
<div class="box_header">
	Submission
</div>
<div class="box_body">
<div class='table-responsive'><table width='100%'><tr>
			<td class='td1'>#</td>
			<td class='td1'>When</td>
			<td class='td1'>Who</td>
			<td class='td1'>Problem Name</td>
			<td class='td1'>Lang</td>
			<td class='td1'>Verdict</td>
			<td class='td1'>Time</td>
			<td class='td1'>Memory</td>
			</tr>
		<?php 
		$info=array();
		$info['where']['submissionType']=2;
		$info=$Submission->getSubmissionList(json_encode($info,true));
		foreach ($info as $key => $value) {
			$submissionId=$value['submissionId'];
			$languageId=$value['languageName'];
			$userId=$value['userId'];
			$userHandle=$value['userHandle'];
			$submissionTime=$value['submissionTime'];
			$judgeStatus=$value['judgeStatus'];
			$time=$value['maxTimeLimit'];
			$memory=$value['maxMemoryLimit'];
			$problemName=$value['problemName'];
			$problemId=$value['problemId'];


			echo "<tr>
			<td class='td2'><a href='submission.php?id=$submissionId' target='_blank'>$submissionId</a></td>
			<td class='td2'>$submissionTime</td>
			<td class='td2'>$userHandle</td>
			<td class='td2'><a href='p.php?id=$problemId'>$problemName</a></td>
			<td class='td2'>$languageId</td>
			<td class='td2'>$judgeStatus</td>
			<td class='td2'>$time s</td>
			<td class='td2'>$memory kb</td>
			</tr>";
		}
		?>
		</table></div></div>
</div>