<style type="text/css">
	.problemListBox{
		margin-top: 4px;
		padding: 10px;
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
</style>

<?php 

	$problemList=array();
	$problemList['A']="3 Friends";
	$problemList['B']="Food blogging";
	$problemList['C']="Rectangle Partitioning";
	$problemList['D']="Yet Another Max Sum Problem";
	$problemList['E']="3 Friends";
	$problemList['F']="3 Friends";
	$problemList['G']="3 Friends";

?>


<div class="row">
	<div class="col-md-9">
		<div class="box">
			<div class="box_header">Problems</div>
			<div class="box_body">
				<?php foreach ($problemList as $key => $value) { ?>
					<a href="contest.php?id=4&p=problem" style="position: relative;" class="list-group-item problemListBox">
						<div style="margin-top: 9px;" class="pull-right"><i class="fa fa-user"></i> &times; 5</div>
						<div class="pull-left problemNo"><?php echo $key; ?></div>
						<h4 style="margin: 5px 0 4px; line-height: 30px;" class="list-group-item-heading"><?php echo $value; ?></h4>
					</a>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="box">
			<div class="box_header"></div>
			<div class="box_body" style="height: 180px;">
			</div>
		</div>
	</div>
</div>
