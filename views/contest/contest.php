<?php 
	$path="views/contest/";
	$page="404.php";
	if(isset($_GET['id'])){
		$page="info.php";
		if(isset($_GET['p'])){
			$name=$_GET['p'];
			if($name=="dashboard")$page="dashboard.php";
			else if($name=="problem")$page="problem.php";
			else if($name=="ranklist")$page="ranklist.php";
			else if($name=="submission")$page="submission.php";
			else if($name=="overview")$page="overview.php";
		}
		echo '<div class="" style="padding: 15px;margin-top: -20px;background: url("file/site_metarial/geometry.png")!important">';
		if($page!="info.php")include "views/contest/contest_header.php";
		$page=$path.$page;

	}
	include "$page";
	if($page!="info.php")include "views/contest/contest_footer.php";
	echo "</div>";

?>