<style type="text/css">
	.problemListBox{
		margin-bottom: 2px;
		padding: 10px 10px 10px 10px;
		border: 1px solid #EEEEEE;
	}
	.problemNo{
		font-size: 35px;
		margin-top: -6px; 
		margin-right: 16px; 
		text-align: center; 
		width: 50px;
	}

	.p_list{
  		padding: 15px;
  		border-style: solid;
  		border-width: 1px;
  		border-color: #E7ECF1;
  		font-size: 18px;
  		margin-bottom: 5px;
  	}
  	.contestInfoRight{
  		text-align: center;
  		color: #000000;
  		position: -webkit-sticky;
  		position: sticky;
  		top: 118px;
  		font-weight: bold;
  		z-index: 99999!important;
  		

  	}
  	.contestInfoRightTitle{
  		border: 1px solid #E7ECF1;
  		border-width: 0px 0px 1px 0px;
  		padding-bottom: 10px;
  		margin-bottom: 10px;
  		color: #2F353B;
  	}
  	.contestTimeRight{
  		text-align: center;
  	}
  	.contestTimeRightSpan{
  		color: #ffffff;
  		background: var(--bg-color);
  		border-radius: 10px;
  		padding: 6px;
  		margin-right: 1px;
  		font-size: 17px;
  	}
</style>

<div class="row">
	<div class="col-md-9">
		<div class="contestBox">
			<div class="contestBoxHeader">Problems</div>
			<div class="">
				<?php include $basePath."problem_list.php"; ?>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="contestBox">
			<div class="contestBoxHeader">Resources</div>
			<div class="problemLdistBox">
				<?php 
				$contestResourceList = $Contest->getContestCommentList($contestId,"Resources");
				foreach ($contestResourceList as $key => $value) {
					$commentTime = $Site->dateToAgo($value['commentTime']);
				?>
					<div class="problemListBox" style="cursor: pointer;">
						<?php echo $value['commentTitle']; ?>
					</div>
				<?php } ?>
			</div>
		</div>

		<div class="contestBox">
			<div class="contestBoxHeader">Announcement</div>
			<?php 
			$contestAnnouncementList = $Contest->getContestCommentList($contestId,"Announcement","desc");
			foreach ($contestAnnouncementList as $key => $value) {
				//$commentTime = $Site->dateToAgo($value['commentTime']);
			?>
			<div class="problemListBox" style="padding: 5px 5px 0px 10px">
				<div class="row">
					<div class="col-md-12">
						<?php echo 'commentDetail'; ?><br/>
						<div class="pull-right" style="color: #7f8c8d"><span style="border: 1px solid #dddddd;border-width: 0px 0px 0px 0px; padding: 0px 2px 0px 2px; border-radius: 2px"><?php echo "commentTime"; ?></span></div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
