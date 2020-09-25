


<link rel="stylesheet" type="text/css" href="style/css/problem.css">
<link rel="stylesheet" type="text/css" href="style/css/color.css">
<link rel="stylesheet" type="text/css" href="style/lib/bootstrap/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Exo 2" rel="stylesheet">

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
		font-size: 70px;
		font-weight: bold;
		text-align: center;
		font-family: "Exo 2";
	}
	.logoImg{
		height: 80px;
		width: 80px;
		margin-top: -30px;
	}

	.contestTitle{
		font-size: 30px;
		font-weight: bold;
	}
	.coverPage{
		text-align: center;
		font-family: "Exo 2";
	}
	
</style>

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="problemSet">
<div class="logoArea">
	<div class="coverPage">
		<div class="contestTitle">EWU Programming Contest</div>
		<div class="logo">
			<div style="margin-top: 50px;"></div>
			<img src="file/site_metarial/coderoj_logo.png" height="45px">
		</div>
	</div>
</div>
<?php
	include "script.php";
	$problemList = $Contest->getContestProblemList(3);
	foreach ($problemList as $key => $value) {
		$problemId = $value['problemId'];
		$problemData=$Problem->getProblemInfo($problemId);
		$problemData['problemName']=$key.". ".$problemData['problemName'];
		echo "<page size='A4'>";
			$ProblemFormat->buildProblemFormat($problemData);
		echo "</page>";
		
	}
	
?>

</div>

</div>
</div>

<page size="A4"></page>

<style type="text/css">
	body {
  background: rgb(204,204,204); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}
page[size="A4"][layout="landscape"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="landscape"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="landscape"] {
  width: 21cm;
  height: 14.8cm;  
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}
</style>