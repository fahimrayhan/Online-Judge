<?php 
	
	$contestList = $Contest->getContestList();
	foreach ($contestList as $key => $value) {
		$contestId = $value['contestId'];
		echo "<a href='contest.php?id=$contestId'>".$value['contestName']."</a>";
	}

?>

<style type="text/css">
	.contestListBanner{
		height: 140px;
		width: 100%;
		border-radius: 5px 5px 0px 0px;
	}
	.contestListInfoBody{
		text-align: center;
		padding-top: 15px;
		height: 120px;
		font-family: "Exo 2";
	}
	.contestTitle{
		font-size: 16px;
		font-weight: bold;
	}

	.contestBox{
		margin-bottom: 10px;
	}

	.contestType{
		color: #B3A4B8;
	}
	.contestRegistration{
		background-color: #ffffff;
		margin-top: -30px;
	}
</style>


<div class="row">
	<div class="col-md-12">
		<div class="box">
		<div class="boxHeader">Running Contest</div>
		<div class="boxBody" style="background-image: url(file/site_metarial/geometry.png);margin-bottom: 20px;">
		<div class="row">
			<?php for($i=1; $i<=5; $i++){ ?>
			<div class="col-md-3">
				<div class="boxx">
					<div class="boxBody contestBox" style="padding: 0px;">
						<img src="https://www.codechef.com/download/small-banner/PCJ2019/1565602107.jpg" class="contestListBanner">
						<div class="contestListInfoBody">
							<div class="contestType">Private</div>
							<div class="contestTitle">
								EWU Programming Contest
							</div>
						</div>
						
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
		</div>
		</div>
		<div class="box">
		<div class="boxHeader">Running Contest</div>
		<div class="boxBody">
		<div class="row">
			<?php for($i=1; $i<=4; $i++){ ?>
			<div class="col-md-3">
				<div class="boxx">
					<div class="boxBody" style="padding: 0px;">
						<img src="https://www.codechef.com/download/small-banner/PCJ2019/1565602107.jpg" class="contestListBanner">
						<div class="contestListInfoBody">
							<div class="contestTitle">
								EWU Programming Contest
							</div>
						</div>
						
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
		</div>
	</div>
	</div>
	<div class="col-md-3">
		<div class="boxHeader">Create Contest</div>
		<div class="boxBody"></div>
	</div>

</div>





<div class="boxx" style="margin-top: 15px;">
	<div class="boxBody">
		<button onclick="reload()">Reload</button>
		<div id="response" style="margin-top: 15px;"></div>
	</div>
</div>

<script type="text/javascript">
	function reload(){
		//loader("response");
		$.post("contest_arena_action.php",buildData("signUpContestForm",2),function(response){
			$("#response").html(response);
		});
	}
</script>