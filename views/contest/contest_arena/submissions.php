<style type="text/css">
	.filterBox{
		background-color: #ffffff!important;
		height: 45px;
		margin-bottom: 5px;
	}
</style>

<?php 

	$userId = $DB->isLoggedIn;
	$myLink = ($userId>0)?"| <a href='contest_arena.php?id=$contestId&submissions&user=$userId'>My</a>":"";

?>

<div class="row">
	<div class="col-md-9">
		<div class="contestBox">
			<div class="contestBoxHeader">Submission <?php echo $myLink; ?></div>
			<div class="" style="padding: 0px;">
			<div class='table-responsive'>
			<table width='100%'><tr>
			<td class='td1'>#</td>
			<td class='td1'>When</td>
			<td class='td1'>Who</td>
			<td class='td1'>Problem Name</td>
			<td class='td1'>Lang</td>
			<td class='td1'>Verdict</td>
			<td class='td1'>Time</td>

			</tr>
		<?php 

		$getReqList = array("user","problem","language","verdict");
		$getUrl = "id=$contestId&submissions";
		foreach ($getReqList as $key => $value) {
			if(isset($_GET[$value])){
				if($getUrl != "")$getUrl .="&";
				$getUrl .= $value."=".$_GET[$value];
			}
		}

		$getLanguage = isset($_GET['language'])?$_GET['language']:-1;
		$getVerdict = isset($_GET['verdict'])?$_GET['verdict']:-1;
		$getUser = isset($_GET['user'])?$_GET['user']:"";
		$getProblem = isset($_GET['problem'])?$_GET['problem']:-1;

		$pageNo=(isset($_GET['page'])?$_GET['page']:1);
		$numberOfRow=30;
		$limit=($pageNo-1)*$numberOfRow+0;
		$limit = "$limit,$numberOfRow";

		$where = array();
		if(isset($_GET['user'])){
			$where['userId'] = (int)$_GET['user'];
		}
		if(isset($_GET['problem'])){
			$problemList = $Contest->getContestProblemList($contestId);
			$problemNumber = $_GET['problem'];
			if(isset($problemList[$problemNumber])){
				$where['problemId'] = (int)$problemList[$problemNumber]['problemId'];
			}

		}
		if(isset($_GET['language']))
			$where['languageId'] = $_GET['language'];

		if(isset($_GET['verdict']))
			$where['submissionVerdict'] = $_GET['verdict'];

		$totalSubmission =  $ContestAreana->getContestSubmissionList([
			'contestId' => $contestId,
			'where' => $where
		]);

		$totalSubmission = count($totalSubmission);
		$totalPage = ceil($totalSubmission/$numberOfRow);

		$submissionList = $ContestAreana->getContestSubmissionList([
			'contestId' => $contestId,
			'where' => $where,
			'limit' => $limit
		]);
		foreach ($submissionList as $key => $value) {
			$submissionId=$value['submissionId'];
			$languageId=$value['languageName'];
			$userId=$value['userId'];
			$displayName=$value['displayName'];
			$displayName .= strlen($value['displaySubName'])>0?" [".$value['displaySubName']."]":"";
			$submissionTime=$value['submissionTime'];
			$submissionTimeTimer=$value['submissionTimeTimer'];
			$judgeStatus=$value['judgeStatus']['verdictLabel'];
			$time=$value['maxTime'];
			$memory=$value['maxMemory'];
			$problemName=$value['problemName'];
			$problemNumber=$value['problemNumber'];


			echo "<tr>
			<td class='td2'><a onclick='viewSubmissionById($submissionId)'>$submissionId</a></td>
			<td class='td2'><font title= '$submissionTime'>$submissionTimeTimer</font></td>
			<td class='td2'><a href='profile.php?id=$userId'>$displayName</a></td>
			<td class='td2'><a href='contest_arena.php?id=$contestId&problem=$problemNumber'>$problemNumber - $problemName</a></td>
			<td class='td2'>$languageId</td>
			<td class='td2' id='submissionGlobalVerdictStatus_$submissionId'>$judgeStatus</td>
			<td class='td2' id='submissionGlobalVerdictTime_$submissionId'>$time s</td>
			</tr>";
		}
		?>
		</table></div>

<center>
	<nav aria-label="...">
  		<ul class="pagination">
    	
    	<?php for($i=1; $i<=$totalPage; $i++){ 
    		$active=$i==$pageNo?"active":"";
    		?>
    		<li class="page-item <?php echo $active;  ?>"><a href="contest_arena.php?<?php echo $getUrl.'&page='.$i; ?>"><span class="page-link"><?php echo "$i"; ?></span></a></li>
    	
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
				<input type="number" name="" value="<?php echo $getUser; ?>" id="filterUser" class="form-control filterBox" placeholder="User Id">
				<select id="filterProblem" class="form-control filterBox">
						<option value="-1">Any Problem</option>
						<?php  
							$problemList=$Contest->getContestProblemList($contestId);
							foreach ($problemList as $key => $value) {
								$selected = $key == $getProblem?"selected":"";
								echo '<option value="'.$key.'" '.$selected.'>'.$key.'</option>';
							}
						?>
				</select>
				<select id="filterLanguage" class="form-control filterBox">
						<option value="-1">Any Language</option>
						<?php  
							$languageList=$Submission->getJudgeLanguageList();
							foreach ($languageList as $key => $value) {
								$selected = $value['languageId'] == $getLanguage?"selected":"";
								echo '<option value="'.$value['languageId'].'" '.$selected.'>'.$value['languageName'].'</option>';
							}
						?>
				</select>
				<select id="filterVerdict" class="form-control filterBox">
						<option value="-1">Any Verdict</option>
						<?php  
							$verdictList=$Submission->getJudgeVerdictList();
							foreach ($verdictList as $key => $value) {
								$selected = $value['id'] == $getVerdict?"selected":"";
								echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['description'].'</option>';
							}
						?>
				</select>
				<button style="margin-top: 10px; width: 100%" onclick="fiterSubmission()">Apply</button>
			</div>
		</div>
	</div>
</div>
