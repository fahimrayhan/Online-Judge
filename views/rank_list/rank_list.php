<style type="text/css">
	.rankTop{
		text-align: center;
		background: url('file/site_metarial/geometry.png');
		height: 250px;
	}
	.rankTopInfo{
		margin-top: 5px;
		font-weight: bold;
	}
	.rankTopHandle{
		font-size: 16px;
		font-weight: bold;
	}
	.rankTopBadge{
		margin-top: -50px;
		height: 60px;
		width: 53px;
		margin-left: 23px;
		position: absolute;
	}

	.rankTopSolved{
		margin-top: 7px;
		padding: 15px;
		font-size: 20px;
		border: 1px solid #eeeeee;
	}

	.rankTopImg{
		height: 120px;
		width: 120px;
		border-radius: 100%;
	}
	.rankListTr{
		border: 1px solid #eeeeee;
		border-width: 0px 0px 2px 0px;
	}
	.rankListTd{
		padding: 5px;
		text-align: center;
	}
	.rankListImg{
		height: 60px;
		width: 60px;
		border-radius: 100%;
	}
</style>

<?php

	$rankList=$Submission->submissonRankList();

?>

<div class="row">
	
	<?php
		$rank=0;
		foreach ($rankList as $key => $value) {
		$value['rank']=++$rank;
		if($rank>3)break;
		$badge="one_badge.png";
		if($value['rank']==2)$badge="two_badge.png";
		if($value['rank']==3)$badge="three_badge.png";
	?>
	<div class="col-md-4">
		<div class="boxBody box rankTop">
			<img class="rankTopImg img-thumbnail" src="<?php echo $value['userPhoto'] ?>"><br/>
			<img class="rankTopBadge" src="file/site_metarial/<?php echo $badge; ?>">
			<div class="rankTopInfo">
				<div class="rankTopHandle"><a href="profile.php?id=<?php echo $value['userId']; ?>"><?php echo $value['userHandle'] ?></a></div>
				<div><?php echo $value['instituteName'] ?></div>
				<div class="rankTopSolved ">Solved: <?php echo $value['totalSolved'] ?></div>
			</div>		
		</div>
	</div>
	<?php } ?>
	<div class="col-md-12">
		<div class="boxBody box" style="height: auto;margin-top: 5px;">
			<table style="width: 100%">
			<?php
				$rank=0;
				foreach ($rankList as $key => $value) {
				$value['rank']=++$rank;
				if($value['rank']<=3)continue;
				?>
				<tr class="rankListTr">
					<td style="width: 10%" class="rankListTd"><?php echo $value['rank'] ?></td>
					<td style="width: 10%" class="rankListTd"><img class="rankListImg img-thumbnail" src="<?php echo $value['userPhoto'] ?>"></td>
					<td style="width: 20%" class="rankListTd"><a href="profile.php?id=<?php echo $value['userId']; ?>"><?php echo $value['userHandle'] ?></a></td>
					<td style="width: 50%" class="rankListTd"><?php echo $value['instituteName'] ?></td>
					<td style="width: 10%" class="rankListTd">Solved <br/><b><?php echo $value['totalSolved'] ?></b></td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>

</div>