
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript" src="views/problems/single_problem/js/problem.js"></script>

<?php
	$info=$Problem->problemVerdictStat($problemId);
	$AC=(isset($info[3]))?$info[3]:0;
	$WA=(isset($info[4]))?$info[4]:0;
	$TLE=(isset($info[5]))?$info[5]:0;
	$MLE=(isset($info[13]))?$info[13]:0;
	$CE=(isset($info[6]))?$info[6]:0;
	$RTE=(isset($info[7]))?$info[7]:0;
	$RTE+=(isset($info[8]))?$info[8]:0;
	$RTE+=(isset($info[9]))?$info[9]:0;
	$RTE+=(isset($info[10]))?$info[10]:0;
	$RTE+=(isset($info[11]))?$info[11]:0;
	$RTE+=(isset($info[12]))?$info[12]:0;

?>

<script>
	var problemId=<?php echo "$problemId"; ?>;
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: ""
	},
	axisY: {
		title: ""
	},
	data: [{        
		type: "column",  
		showInLegend: false, 
		legendMarkerColor: "grey",
		legendText: "AC = Accepted",
		dataPoints: [      
			{ y: <?php echo $AC; ?>, label: "AC" },
			{ y: <?php echo $WA; ?>,  label: "WA" },
			{ y: <?php echo $TLE; ?>,  label: "TLE" },
			{ y: <?php echo $MLE; ?>,  label: "MLE" },
			{ y: <?php echo $RTE; ?>,  label: "RTE" },
			{ y: <?php echo $CE; ?>, label: "CE" }
		]
	}]
});
chart.render();

}
</script>



<div class="row">
	<div class="col-md-9">
		<div class="box sm_border">
			<div class="box_body" style="overflow-x: scroll;">
				 <?php include "views/problems/single_problem/problem_stat.php"; ?>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="box none_border">
			<div class="box_header">Problem Info</div>
			<div class="box_body">
				<table width="100%">
					<tr>
						<td class="problem_info_td"><i class="fa fa-info-circle"></i> Problem ID</td>
						<td class="problem_info_td1"> <?php echo $problemData['problemId']; ?></td>
					</tr>
					<tr>
						<td class="problem_info_td"><span class="glyphicon glyphicon-time"></span> Time Limit</td>
						<td class="problem_info_td1"><?php echo $problemData['cpuTimeLimit']; ?> s</td>
					</tr>
					<tr>
						<td class="problem_info_td"><span class="glyphicon glyphicon-inbox"></span> Memory Limit</td>
						<td class="problem_info_td1"><?php echo $problemData['memoryLimit']; ?> KB</td>
					</tr>
					<tr>
						<td class="problem_info_td"><i class="fa fa-user"></i> Author</td>
						<td class="problem_info_td1"> <a href="profile.php?id=<?php echo $problemData['userId'] ?>"> <?php echo $problemData['userHandle']; ?></a></td>
					</tr>
					
				</table>
			</div>
		</div>
		<div class="box none_border">
			<div class="box_header">Statistics</div>
			<div class="box_body">
				<div id="chartContainer" style="height: 150px; width: 100%;"></div>
			</div>
		</div>
		<div class="box none_border">
			<div class="box_header">Submit</div>
			<div class="box_body" style="text-align: center;">
				<?php 
					if($DB->isLoggedIn==0)echo "<b>Please <a href='login.php?back=$page'>Login</a> For Submission.</b>";
					else echo "<button onclick='loadSubmiProblemPage()'>Submit Your Solution</button>";
				?>
			</div>
		</div>

		<div class="box none_border">
			<div class="box_body" style="text-align: center;">
				
				<?php 
					$data=array();
					$data['where']['submissionType']=2;
					$data['where']['problemId']=$problemId;
					$data['where']['userId']=$DB->isLoggedIn;

					$submissionList=$Submission->getSubmissionList(json_encode($data));

				?>

				<table width="100%">
					
					<?php 
						$c=0;
						foreach ($submissionList as $key => $value) {
							$submissionId=$value['submissionId'];
							$submissionTime=$value['submissionTime'];
							$ago=$Site->dateToAgo($submissionTime);
							$c++;
							if($c>5)break;
					?>
					<tr style="border: 1px solid #E7ECF1;border-width: 0px 0px 1px 0px;">
						<td style="padding: 7px 0px 7px 0px;"><a href="javascript:viewSubmissionById(<?php echo $submissionId; ?>)"><?php echo $ago; ?></a></td>
						<td style="padding: 7px 0px 7px 0px;" id="submissionGlobalVerdictStatus_<?php echo $submissionId; ?>"><?php echo $value['judgeStatus']; ?></td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>

	</div>
</div>

<style type="text/css">
	.problem_info_td{
		border: 1px solid #CCCCCC;
		padding: 4px;
		font-size: 12px;
		width: 50%;
	}
	.problem_info_td1{
		border: 1px solid #CCCCCC;
		padding: 4px;
		font-size: 12px;
	}
</style>