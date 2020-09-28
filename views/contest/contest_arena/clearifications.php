<style type="text/css">
	.filterBox{
		background-color: #ffffff!important;
		height: 45px;
		margin-bottom: 5px;

	}
</style>
<?php 

$clearificationList = $Contest->getClearificationList([
	'contestId' => $contestId
]);

print_r($clearificationList);


?>
<style type="text/css">
	.clearificationList:hover{
		cursor: pointer;
		background-color: #f5f5f5;
	}
	.clearificationTime{
		color: #aaaaaa;
		margin-top: 4px;
	}
</style>

<div class="row">
	<div class="col-md-9">
		<div class="contestBox">
			<div class="contestBoxHeader">Clearifications</div>
			<?php 
			
			foreach ($clearificationList as $key => $value) {
				$clearificationTime = $Site->dateToAgo($value['contestClearificationTime']);
				$problemNo = $value['contestClearificationProblem'];
				$clearificationTitle = $value['contestClearificationTitle'];
				$combineTitle = "<b>[".$problemNo."] </b>".$clearificationTitle;

			?>
			<div class="problemListBox" style="padding: 5px 5px 0px 10px">
				<div class="row clearificationList">
					<div class="col-md-12">
						<?php echo "$combineTitle"; ?><br/>
						<div class="pull-right" style="color: #7f8c8d"><span style="border: 1px solid #dddddd;border-width: 0px 0px 0px 0px; padding: 0px 2px 0px 2px; border-radius: 2px"><?php echo "$clearificationTime"; ?></span></div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="col-md-3">
		<div class="contestBox">
			<div class="contestBoxHeader">Request Clearifications</div>
			<div class="contestBoxBody">
				<button class="contestNavBtn" style="width: 100%" onclick="requestClearifications()"><i class="fa fa-upload" ></i> Request Clearifications</button>
			</div>
		</div>
		<div class="contestBox">
			<div class="contestBoxHeader">Filter</div>
			<div class="contestBoxBody">
				<button class="contestNavBtn" style="width: 100%" onclick="loadSubmitProblem(this)"><i class="fa fa-upload" ></i> Request Clearifications</button>
			</div>
		</div>
	</div>
</div>