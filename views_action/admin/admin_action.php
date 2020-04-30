<?php
	
	if($DB->userRole>20)return;

	if(isset($_POST['delJudgeProblemList'])){
		echo $Problem->delJudgeProblemList($_POST['delJudgeProblemList']);
	}

	if(isset($_POST['addJudgeProblemList'])){
		$data=array();
		$data['judgeProblemListId']=$_POST['addJudgeProblemList'];
		$data['status']=1;
		echo $Problem->addJudgeProblemList($data);
		
	}
	else include "views_action/admin/admin_action_ui.php";

?>