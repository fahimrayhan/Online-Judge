<?php

	$contestOk = 0;

	if(isset($_GET['id'])){
		$contestId = $_GET['id'];
		$contestOk = $Contest->checkContest($contestId)&$Contest->checkContestPublish($contestId);
	}


	if($contestOk == 0){
		include "views/contest/contest_list/contest_list.php";
		return;
	}

	$contestId = $_GET['id'];
	$contestInfo = $Contest->getSingleContestInfo($contestId);
	

	$contestName  = $contestInfo['contestName'];
	$contestBanner = $contestInfo['contestBanner'];
	$contestStart = $DB->dateToString($contestInfo['contestStart']);
	$contestEnd = $DB->dateToString($contestInfo['contestEnd']);

?>



<style type="text/css">

	.contestBanner{
		width: 100%;
		background: #000000;
		border-width: 3px;
		border-style: solid;
		border-color: #2C3542;
		
	}
	.BannerTitle{
		background: #2C3542;
	  	text-align: center;
	  	font-size: 45px;
	  	color: #ffffff;
	  	font-family: "Trebuchet MS", Helvetica, sans-serif;
	  	
	}
	.BannerTime{
		background: #bdc3c7;
		font-size: 18px;
	}
	.animationBanner{
		background: #2C3542;
		height: 100px;
		width: 100%;
	}
	.contestTitle{
		text-align: center;
		font-weight: bold;
		font-size: 30px;
		padding: 10px 5px 0px 5px;
		font-family: "Exo 2";
	}
	.contestBtn{
		text-align: center;
	}
	.bannerArea{
	}
	.bannerImg{
		width: 100%;

	}

	.ContestTime{
		background: #bdc3c7;
		font-size: 18px;
	}

	.contestInfoArea{
		padding: 10px;
		min-height: 240px;
		max-height: auto;
	}
	.contestInfoAreaBody{
		font-size: 18px;
		padding-top: 10px;
		text-align: center;
	}
	.infoTimer{
		text-align: center;
		padding: 0;

	}

	.infoTimerSpan{
		padding: 5px 10px 5px 10px;
		background: #eeeeee;
		color: #46525D;
		font-size: 2.5em;
		font-weight: bold;
		border-radius: 5px;
	}

	.contestInfoButtonArea{
		padding: 15px 0px 15px 0px;
	}

</style>

<div class="row">
<div class="col-md-12">

<script type="text/javascript">
	var contestId = <?php echo $contestId; ?>;
	function signUpContestForm(){
		modal.md.open("Submit Your Solution");
		loader(modal.md.body);
		$.post("contest_arena_action.php",buildData("signUpContestForm",contestId),function(response){
			modal.md.setBody(response);
		});
	}
</script>


<div class="row">
	<div class="col-md-12">
		
	</div>
	<div class="col-md-12">

		<div class="contestInfoArea boxBody box">
				
				

				<div class="contestTitle"><?php echo $contestName; ?></div>
				<hr/>
				<div class="row">
				<div class="contestInfoAreaBody col-md-3">
					Start ON:<br/>
					<b><?php echo $contestStart; ?> BDT</b><br/>
					
				</div>
				<div class="col-md-3">
					<div class="infoTimer">
						Before Contest<br/>
						<span class="infoTimerSpan">04</span>
						<span class="infoTimerSpan">55</span>
						<span class="infoTimerSpan">49</span>
					</div>
				</div>
				<div class="contestInfoAreaBody col-md-3">
					End ON:<br/>
					<b><?php echo $contestEnd; ?> BDT</b><br/>
				</div>
				<div class="col-md-3">
					<a href="contest_arena.php?id=<?php echo "$contestId"; ?>&p=dashboard"><button class="btn-success" style="width: 100%;margin-bottom: 3px">Enter</button></a>
						<button class="btn-info" style="width: 100%;margin-bottom: 3px">Standing</button>
						<button style="width: 100%;margin-bottom: 3px" onclick="signUpContestForm()">Sign Up</button>
				</div>

				<div class="col-md-9">
					<div style="color:#aaaaaa;border: 2px solid #eeeeee;border-width: 1px 0px 0px 0px;margin-top: -35px">
						* Contest Is Private<br/>
						* You Can Participate Contest
					</div>
				</div>
				
			</div>
</div>
<div class="box boxBody">
<img class="bannerImg img-thumbnail" src="<?php echo $contestBanner;?>">
<h2>Schedule</h2>

<p>The contest will start on&nbsp;<strong>March 13, 2020</strong>&nbsp;at&nbsp;<strong>11:00 AM +0200</strong>&nbsp;and will run for&nbsp;<strong>2 hours 30 minutes</strong>.</p>

<h2>Rating</h2>

<p>This contest is rated for all participants. Toph uses the&nbsp;<a href="https://help.toph.co/toph/glicko-2-rating-system">Glicko-2 rating system</a>.</p>


<h2>Rules</h2>

<p>This contest is formatted as per the official rules of ICPC Regional Programming Contests.&nbsp;<a href="https://icpc.baylor.edu/regionals/rules" target="_blank">See details...</a></p>

<p>You can use Bash 5.0, Brainf*ck, C# Mono 6.0, C++11 GCC 7.4,&nbsp;and&nbsp;16 other programming languages&nbsp;in this contest.</p>

<p>Be fair, be honest. Plagiarism will result in disqualification. Judges&rsquo; decisions will be final.</p>


		</div>
	
	</div>
	
	
	
	
	


</div>

</div>


</div>