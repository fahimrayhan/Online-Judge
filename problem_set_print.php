<link rel="stylesheet" type="text/css" href="style/css/problem.css">
<link rel="stylesheet" type="text/css" href="style/css/color.css">
<link rel="stylesheet" type="text/css" href="style/lib/bootstrap/css/bootstrap.min.css">
<?php
set_include_path(get_include_path() . PATH_SEPARATOR . "style/lib/dompdf");

require_once "dompdf_config.inc.php";

$dompdf = new DOMPDF();

$html = "hello";

$dompdf->load_html($html);
$dompdf->render();

$dompdf->stream("hello.pdf");

?>

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
		width: 300px;
	}
</style>

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="problemSet">
<div class="logoArea">
	<img class="logo" src="https://sta.codeforces.com/s/19784/images/codeforces-logo-with-telegram.png">
</div>
<?php
	include "script.php";
	$problemId=10;
	$problemData=$Problem->getProblemInfo($problemId);
	$problemData['problemName']=$problemData['problemId'].". ".$problemData['problemName'];
	$ProblemFormat->buildProblemFormat($problemData);


?>

</div>

</div>
</div>