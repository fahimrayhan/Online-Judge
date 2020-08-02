<style type="text/css">
	.filterBox{
		background-color: #ffffff!important;
		height: 45px;
	}
</style>

<div class="row">
	<div class="col-md-9">
		<div class="contestBox">
			<div class="contestBoxHeader">Submission</div>
			<div class="" style="padding: 0px;">
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
		if(isset($filterData['userId']))$info['where']['userId']=$filterData['userId'];
		if(isset($filterData['problemId']))$info['where']['problemId']=$filterData['problemId'];
		if(isset($filterData['languageId']))$info['where']['languageId']=$filterData['languageId'];
		if(isset($filterData['verdict']))$info['where']['submissionVerdict']=$filterData['verdict'];
		$pageNo=isset($filterData['pageNo'])?$filterData['pageNo']:1;
		$numberOfRow=30;
		$limit=($pageNo-1)*$numberOfRow+0;

		$info['filter']['limit']="$limit,$numberOfRow";
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
			<td class='td2'><a href='profile.php?id=$userId'>$userHandle</a></td>
			<td class='td2'><a href='p.php?id=$problemId'>$problemId - $problemName</a></td>
			<td class='td2'>$languageId</td>
			<td class='td2' id='submissionGlobalVerdictStatus_$submissionId'>$judgeStatus</td>
			<td class='td2' id='submissionGlobalVerdictTime_$submissionId'>$time s</td>
			<td class='td2' id='submissionGlobalVerdictMemory_$submissionId'>$memory kb</td>
			</tr>";
		}
		?>
		</table></div>

<center>
	<nav aria-label="...">
  		<ul class="pagination">
    	
    	<?php for($i=1; $i<=15; $i++){ 
    		$active=$i==$pageNo?"active":"";
    		?>
    		<li class="page-item <?php echo $active;  ?>"><a class="page-link" onclick="loadSubmissionListTable(<?php echo $i; ?>)"><span class="page-link"><?php echo "$i"; ?></span></a></li>
    	
    	<?php } ?>
    	
 		</ul>
	</nav>
</center>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="contestBox">
			<div class="contestBoxHeader">Filter</div>
			<div class="contestBoxBody">
				<input type="text" name="" class="form-control filterBox" placeholder="Author">
				<select id="filterLanguageId" class="form-control filterBox">
						<option value="-1">Any Language</option>
						<?php  
							$languageList=$Submission->getJudgeLanguageList();
							foreach ($languageList as $key => $value) {
								echo '<option value="'.$value['languageId'].'">'.$value['languageName'].'</option>';
							}
						?>
				</select>
				<select id="filterVerdict" class="form-control filterBox" style="margin-top: 10px;">
						<option value="-1">Any Verdict</option>
						<?php  
							$verdictList=$Submission->getJudgeVerdictList();
							foreach ($verdictList as $key => $value) {
								echo '<option value="'.$value['id'].'">'.$value['description'].'</option>';
							}
						?>
				</select>
				<button style="margin-top: 10px; width: 100%">Apply</button>
			</div>
		</div>
	</div>
</div>
