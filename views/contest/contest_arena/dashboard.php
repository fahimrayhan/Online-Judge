<style type="text/css">

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
