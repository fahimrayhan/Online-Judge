<?php

	$contestOk = 0;

	if(isset($_GET['id'])){
		$contestId = $_GET['id'];
		$response = $Contest->checkContestInfoPage($contestId);
	}

	if($response['error'] == 1){
		include "404.php";
		return;
	}

	$contestId = $_GET['id'];
	$contestInfo = $Contest->getSingleContestInfo($contestId);
	

	$contestName  = $contestInfo['contestName'];
	$contestBanner = $contestInfo['contestBanner'];
	$contestStart = $DB->dateToString($contestInfo['contestStart']);
	$contestEnd = 	$DB->dateToString($contestInfo['contestEnd']);

	$problemList = $Contest->getContestProblemList($contestId);
	$totalProblem = count($problemList);

	$checkAuth = $Contest->checkContestParticipateAuth($contestId);
	if($checkAuth == "Accepted")$registrationTxt = "You can participate this contest";
	else if($checkAuth == "Pending")$registrationTxt = "Your registration is pending";
	else $registrationTxt = "You can not participate this contest. Please registration for participate this contest.";
?>



<style type="text/css">

	
	.bannerImg{
		width: 100%;
	}

  .contestInfoBox{
  	background-color: #ffffff;
  	border: 1px solid #eeeeee;
  	box-shadow: 1px 1px 3px #DADADA;
  }

  .contestInfoBody{
  	padding: 15px;
  }

  .contestTitle{
  	font-size: 20px;
  	font-weight: bold;
  }
  .contestInfoList{

  }


  .contest_list_li{
	padding: 10px;
	font-size: 15px;
	font-weight: bold;
	cursor: pointer;
	font-family: "Times New Roman", Times, serif;
	padding: 0px;

  }
  .listIcon{
	color: #7A8E96;
	padding: 10px 10px 10px 10px;
	border-radius: 0px;
	font-size: 25px;
	margin-bottom: 0px;
	text-align: center;
	margin-right: 5px;
  }
  .listLabel{
  	color: #767E96;
  	font-size: 14px;
  }
  .listTitle{
  	font-size: 15px;
  }
  .contestInfoTd{
  	padding-bottom: 10px;
  }
  .contestLabel{
  	padding: 5px;
  	border-radius: 5px;
  }
</style>


<div class="row">
	
	<div class="col-md-4">
		<div class="contestInfoBox">
			<img class="bannerImg" src="<?php echo $contestBanner;?>">
			<div style="padding: 10px;">
				<h3 style="font-size: 18px;margin: 10px 0px 10px 0px;"><?php echo $contestInfo['contestName']; ?></h3>
				<span class="label label-success contestLabel"><i class="fas fa-trophy"></i> <?php echo $contestInfo['contestFormat']; ?></span>
				<span class="label label-info contestLabel"> <?php echo $contestInfo['contestVisibility']; ?></span>
				<hr style="margin: 10px 0px 10px 0px;">
				<table>
					<tr>
						<td class="contestInfoTd"><i class="fas fa-hourglass listIcon"></i></td>
						<td class="contestInfoTd">
                            <div class="listTitle"><?php echo $contestInfo['contestTimerTimeTxt']; ?></div> 
                            <div class="listLabel"><?php echo $contestInfo['contestStatusTxt']; ?></div>       
                        </td>
					</tr>
					<tr>
						<td class="contestInfoTd"><i class="fas fa-calendar-alt	listIcon"></i></td>
						<td class="contestInfoTd">
                            <div class="listTitle"><?php echo $contestStart; ?> BDT</div> 
                            <div class="listLabel">Begin Time</div>       
                        </td>
					</tr>
					<tr>
						<td class="contestInfoTd"><i class="fas fa-clock listIcon"></i></td>
						<td class="contestInfoTd">
                            <div class="listTitle"><?php echo $contestInfo['contestDuration']; ?> Minutes</div> 
                            <div class="listLabel">Length</div>       
                        </td>
					</tr>
					<tr>
						<td class="contestInfoTd"><i class="fas fa-dice-d20	listIcon"></i></td>
						<td class="contestInfoTd">
                            <div class="listTitle"><?php echo $totalProblem; ?></div> 
                            <div class="listLabel">Problems</div>       
                        </td>
					</tr>
				</table>

			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="contestInfoBox" style="padding: 10px;">
			<h3><?php echo $contestInfo['contestName']; ?></h3>
			<hr>
			<?php echo $contestInfo['contestDescription']; ?>
			<hr>
			<div style="padding-bottom: 5px">
				<?php 
					if($contestInfo['contestStatus'] != -1){

				?>
				<a href="contest_arena.php?id=<?php echo "$contestId"; ?>&p=dashboard"><button class="btn-success" style="width: 100px;margin-bottom: 3px">Enter Arena</button></a>
				<button class="btn-info" style="width: 100px;margin-bottom: 3px">Standings</button>
			<?php } ?>
			<?php
				if($contestInfo['contestStatus'] != 1){
			?>
				<button style="width: 100px;margin-bottom: 3px" onclick="signUpContestForm()">Sign-Up</button>
			<?php } ?>
			<br/>
			* <?php echo $registrationTxt; ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var contestId = <?php echo $contestId; ?>;
	function signUpContestForm(){
		modal.md.open("Registration");
		loader(modal.md.body);
		$.post("contest_arena_action.php",buildData("signUpContestForm",contestId),function(response){
			modal.md.setBody(response);
		});
	}
</script>

