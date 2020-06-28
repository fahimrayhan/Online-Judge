<title>Judge Status | CoderOJ</title>
<style type="text/css">
	.submissionFilter{
		text-align: center;
		padding-bottom: 10px;
	}
	.filter_td1{
		background-color: #eeeeee;
		padding: 6px 10px 6px 10px;
		border: 1px solid #ffffff;
		text-align: center;
	}
	.filter_td2{
		padding: 6px 10px 6px 10px;
		border: 1px solid #f5f5f5;
		text-align: center;
	}
</style>

<div class="box">
<div class="box_header">
	Submission
</div>
<div class="box_body">
<div class="submissionFilter">
	<center>
		<table style="">

			<tr>
				<td class="filter_td2"><input id="filterUserId" class="form-control" type="number" placeholder="User ID" name=""></td>
				<td class="filter_td2"><input id="filterProblemId" class="form-control" type="number" placeholder="Problem ID" name=""></td>
				<td class="filter_td2">
					<select id="filterLanguageId" class="form-control">
						<option value="-1">Any Language</option>
						<?php  
							$languageList=$Submission->getJudgeLanguageList();
							foreach ($languageList as $key => $value) {
								echo '<option value="'.$value['languageId'].'">'.$value['languageName'].'</option>';
							}
						?>
					</select>
				</td>
				<td class="filter_td2">
					<select id="filterVerdict" class="form-control">
						<option value="-1">Any Verdict</option>
						<?php  
							$verdictList=$Submission->getJudgeVerdictList();
							foreach ($verdictList as $key => $value) {
								echo '<option value="'.$value['id'].'">'.$value['description'].'</option>';
							}
						?>
					</select>
				</td>
				<td class="filter_td2"><button id="submissionFilterBtn" onclick="loadSubmissionListTable()" style="width: 120px;" class="btn-md">Filter</button></td>
			</tr>
		</table>
	</center>
</div>

<div id="submissionListTable">
	<?php include "views/submission/submission_list_table.php"; ?>
</div>


</div>
</div>
<script type="text/javascript" src="views/submission/js/submission_list.js"></script>