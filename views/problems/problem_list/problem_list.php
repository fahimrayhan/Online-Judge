<table id="datatable" class="table table-striped table-bordered" style="border: 1px solid #DDDDDD" cellspacing="0" width="100%">
    				<thead>
						<tr>
							<th class="td_list1"><b>#ID</b></th>
							<th class="td_list1">
								<div class="pull-left">Problem Name</div>
								<div class="pull-right">Tags</div>
							</th>
                        </tr>
					</thead>

					<tbody>
					<?php 
						$problemList=$Problem->getAllJudgeProblemList("status=1");
						//print_r($problemList);
						foreach ($problemList as $key => $value) {
							$problemId=$value['problemId'];
							$problemName=$value['problemName'];
							$problemStat=$Problem->problemListStat($problemId);
							$totalSolved=$problemStat['totalSolved'];
							$label="default";
							if($problemStat['userVerdict']==1)$label="success";
							else if($problemStat['userVerdict']==0)$label="danger";

					?>			
						<tr>
							<td class="td_list2" style="width: 10%"><a href='p.php?id=<?php echo $problemId; ?>'><?php echo $problemId; ?></a></td>
							<td class="td_list2" style="width: 60%;text-align: left;padding-left: 10px!important">
								<div class="pull-left"><a href='p.php?id=<?php echo $problemId; ?>'><?php echo "$problemName"; ?></a>
								</div>
								<div class="pull-right">
								<span style="text-align: right;">
								<?php 
								
								echo "<span class='label label-$label problem_tags'><i class='fas fa-users'></i> $totalSolved</span> ";
								?>
								</span>
								</div>
							</td>
							
							
						</tr>
					<?php } ?>	
					</tbody>
				</table>

<style type="text/css">


	.td_list1{
		padding: 12px 10px 12px 10px!important;
		border-color: #DDDDDD;
		font-weight: bold;
		background-color: #F4F6F8;
	}
	.td_list2{
		padding: 12px 10px 12px 10px!important;
		border-color: #000000;
	}
	.problem_tags{
		border-radius: 7px;
	}
	.percentcont {
		width: 100%;
		height: 19px;
		padding: 0px;
		border: 1px solid #5CB85C;
		display: block;
		background-color: #fcfcfc;
		border-radius: 0px;
		overflow: hidden;
		font-size: 11px;
		color: #2C3542;
	}

	.perfill {
		background: #5CB85C repeat-x 50% 50%;
		height: 19px;
	}

	.pertext {
		position: relative;
		top: -19px;
		text-align: center;
		font-weight: bold;
	}
	
</style>