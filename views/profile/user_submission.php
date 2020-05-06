<?php
		
		$page=(isset($_GET['p']))?$_GET['p']:1;
		$limit=($page-1)*20+0;

		echo "<div class='table-responsive'><table width='100%'>";
		echo "<tr>
			<td class='td1'>#</td>
			<td class='td1'>When</td>
			<td class='td1'>Problem Name</td>
			<td class='td1'>Lang</td>
			<td class='td1'>Verdict</td>
			<td class='td1'>Time</td>
			<td class='td1'>Memory</td>
			</tr>";
		$info=array();
		$info['where']['userId']=$userId;
		$info['where']['submissionType']=2;
		$info['filter']['limit']="$limit,20";
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
			<td class='td2'><a onclick='viewSubmissionById($submissionId)'>$submissionId</a></td>
			<td class='td2'>$submissionTime</td>
			<td class='td2'><a href='p.php?id=$problemId'>$problemName</a></td>
			<td class='td2'>$languageId</td>
			<td class='td2' id='submissionGlobalVerdictStatus_$submissionId'>$judgeStatus</td>
			<td class='td2' id='submissionGlobalVerdictTime_$submissionId'>$time s</td>
			<td class='td2' id='submissionGlobalVerdictMemory_$submissionId'>$memory kb</td>
			</tr>";
		}
		echo "</table></div>";
?>
<center>
	<nav aria-label="...">
  		<ul class="pagination">
    	
    	<?php for($i=1; $i<=5; $i++){ 
    		$active=$i==$page?"active":"";
    		?>
    		<li class="page-item <?php echo $active;  ?>"><a class="page-link" href="profile.php?id=<?php echo $userId; ?>&action=submission&p=<?php echo $i; ?>"><span class="page-link"><?php echo "$i"; ?></span></a></li>
    	
    	<?php } ?>
    	
 		</ul>
	</nav>
</center>
