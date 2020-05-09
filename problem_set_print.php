<link rel="stylesheet" type="text/css" href="style/css/problem.css">
<link rel="stylesheet" type="text/css" href="style/css/color.css">
<link rel="stylesheet" type="text/css" href="style/lib/bootstrap/css/bootstrap.min.css">


<style type="text/css">
	.problemSet{
		padding: 20px;
	}
	.logoArea{
		border: 2px solid #CCCCCC;
		border-width: 0px 0px 1px 0px;
		margin-bottom: 15px;
		padding-bottom: 10px;
	}
	.logo{
		font-size: 30px;
		font-weight: bold;
		text-align: center;
	}
</style>

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="problemSet">
<div class="logoArea">
	<div class="logo">CoderOJ</div>
</div>
<?php
	include "script.php";
	$problemId=isset($_GET['id'])?$_GET['id']:10;
	$problemData=$Problem->getProblemInfo($problemId);
	$problemData['problemName']=$problemData['problemId'].". ".$problemData['problemName'];
	$ProblemFormat->buildProblemFormat($problemData);


?>

</div>

</div>
</div>