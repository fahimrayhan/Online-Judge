<style type="text/css">
	.labelAc{
		background-color: #5CB85C;
		color: #ffffff;
		padding: 3px 5px 3px 5px;
		border-radius: 4px;
		font-size: 12px!important;
	}
	.labelWa{
		background-color: #E35B5A;
		color: #ffffff;
		padding: 3px 5px 3px 5px;
		border-radius: 4px;
		font-size: 12px!important;
	}
	.labelNormal{
		background-color: #eeeeee;
		color: #000000;
		padding: 3px 5px 3px 5px;
		border-radius: 4px;
		font-size: 12px!important;
	}
</style>

<?php 
	$rankList = $ContestAreana->getRankList($contestId);
    $solvedProblemStat = $rankList['solvedProblemStat'];
    $attemptedProblemStat = $rankList['attemptedProblemStat'];
    unset($rankList['solvedProblemStat']);
    unset($rankList['attemptedProblemStat']);
    
    $problemList = $Contest->getContestProblemList($contestId);
    
    $userId = $DB->isLoggedIn;

    $userProblemList = array();
    foreach ($rankList as $key => $value) {
    	if($value['userId'] == $userId){
    		$userProblemList = $value['problems'];
    		break;
    	}
    }

    foreach ($problemList as $key => $value) { 
        $problemNumber = $key;
        $problemId = $value['problemId'];
        $solvedBy = isset($solvedProblemStat[$problemId])?$solvedProblemStat[$problemId]:0;
        $attemptedBy = isset($attemptedProblemStat[$problemId])?$attemptedProblemStat[$problemId]:0;
        $verdict = (isset($userProblemList[$problemId]))?$userProblemList[$problemId]['verdict']: -1;

        $verdictLabel = "labelNormal";
        if($verdict == 3)$verdictLabel = "labelAc";
        else if($verdict > 3)$verdictLabel = "labelWa";
        

?>
        <a href="contest_arena.php?id=<?php echo $contestId; ?>&problem=<?php echo $problemNumber; ?>" style="position: relative;" class="list-group-item problemListBox">
            <div style="margin-top: 9px;" class="pull-right <?php echo $verdictLabel ?>"><i class="fa fa-user"></i> &times; <?php echo "$solvedBy"; ?></div>
            <div class="pull-left problemNo"><?php echo $problemNumber; ?></div>
            <h4 style="margin: 5px 0 4px; line-height: 30px;" class="list-group-item-heading"><?php echo $value['problemName']; ?></h4>
        </a>
<?php } ?>