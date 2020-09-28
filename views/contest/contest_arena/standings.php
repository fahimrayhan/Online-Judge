
<link rel="stylesheet" type="text/css" href="">

<style type="text/css">
	.table-standings thead tr th:nth-child(1),.table-standings tbody tr td:nth-child(1){
    width:48px;
    text-align:center
}
.table-standings thead tr th:nth-child(n+4),.table-standings tbody tr td:nth-child(n+4){
    width:64px;
    text-align:center
}
.table-standings tbody tr td .label{
    display:block
}
.table-standings tbody tr td .label:first-child{
    border-radius:.25em .25em 0 0
}
.table-standings tbody tr td .label:last-child{
    border-radius:0 0 .25em .25em
}
.table-standings td:nth-child(n+3) a{
    text-decoration:none
}
.table tbody tr td{
    vertical-align:middle
}
.label{
	min-width: 50px;
}


.label-success{
	background: #41C281;

}
.label-default{
	background: #2c3e50;
}

.label-info{
	background: #2980b9;
}

.label-warning{
	background: #E87F35;
}

.rankList{
	padding: 5px;
}

tr{
	border-color: #3742fa!important;
}

th{
	background: #ffffff;
}

.teamName{
	color: #297FB9!important;
    font-family: "Exo 2";
    font-weight: bold;
    font-size: 14px;
}

.teamNameSub{
    font-size: 13px;
    color: #706788;
    margin-top: -2px;
}

.contestStandingTable th{
    border-width: 0px!important;
    border-color: #eeeeee!important;
}

.contestStandingTable td{
    border-width: 1px!important;
    border-color: #F3F5F8!important;
}

.acLabel{
    background-color: #41C281!important;
}
.waLabel{
    background-color: #E35B5A!important;
}
</style>
<?php 
    $rankList = $ContestAreana->getRankList($contestId);
    $solvedProblemStat = $rankList['solvedProblemStat'];
    $attemptedProblemStat = $rankList['attemptedProblemStat'];
    unset($rankList['solvedProblemStat']);
    unset($rankList['attemptedProblemStat']);
    $problemList = $Contest->getContestProblemList($contestId);
    $contestParticipateList = $Contest->contestParticipateUserList($contestId);

?>

<div class="row">
    <div class="col-md-12">
    	<div class="contestBox">
    	<div class="contestBoxHeader">Rank List</div>
        <div class="contestBoxBody contestStandingTable" style="padding: 0px">
            <div class="table-responsive">
                <table data-reload="no" class="table table-standings">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align: middle;">#</th>
                            <th rowspan="2" style="vertical-align: middle;">Name</th>
                            <th rowspan="2" style="width: 64px;"></th>
                            <th rowspan="2" style="width: 24px;"></th>
                            <?php foreach ($problemList as $key => $value) { ?>
                            <th style="width: 64px;"><a href="<?php echo "contest_arena.php?id=$contestId&problem=$key" ?>"><?php echo $key; ?></a></th>
                          
                            <?php } ?>
                            
                        </tr>
                        <tr>
                        <?php 
                        foreach ($problemList as $key => $value) { 
                            $problemId = $value['problemId'];
                            $solvedBy = isset($solvedProblemStat[$problemId])?$solvedProblemStat[$problemId]:0;
                            $attemptedBy = isset($attemptedProblemStat[$problemId])?$attemptedProblemStat[$problemId]:0;
                        ?>
                        <th class="text-center"><?php echo $solvedBy."/".$attemptedBy; ?></th>
                        <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php 
                        $rank = 0;

                        foreach ($rankList as $key => $value) {
                        $rank ++;
                        $userId = $value['userId'];
                        $totalSolved = $value['totalSolved'];
                        $totalPanalty = $value['totalPanalty'];
                        $displayName = $contestParticipateList[$userId]['displayName'];
                        $displaySubName = $contestParticipateList[$userId]['displaySubName'];
                        $submissionLink = "contest_arena.php?id=$contestId&submissions&user=$userId";
                        ?>
                        <tr data-id="5e1e73d227f0ba0400c43465">
                            <td><?php echo "$rank"; ?></td>
                            <td style="min-width: 250px;">
                                <a href="profile.php?id=<?php echo $userId; ?>">
                                    <div class="teamName"><?php echo $displayName; ?></div>
                                </a>
                                <div class="teamNameSub"><?php echo $displaySubName; ?></div> 
                            </td>
                            <td>
                                <a  href="<?php echo $submissionLink; ?>">
                                    <div class="label label-info"><?php echo $totalSolved; ?></div>
                                    <div class="label label-default"><?php echo $totalPanalty; ?></div>
                                </a>
                                <td style="width: 26px;"></td>
                            </td>
                           <?php 
                            foreach ($problemList as $key1 => $value1) {

                           ?>
                            <td>
                                <?php 
                                    $problemId = $value1['problemId'];
                                    if(!isset($value['problems'][$problemId]))continue;
                                    $verdict = $value['problems'][$problemId]['verdict'];
                                    $labelClass = "";
                                    if($verdict == 3){
                                        $labelClass = "acLabel";
                                        $iconLabel = "fa fa-check";
                                    }
                                    else {
                                        $labelClass = "waLabel";
                                        $iconLabel = "fa fa-times";
                                    }
                                    $attempted = $value['problems'][$problemId]['attempted'];
                                    $panalty = $value['problems'][$problemId]['panalty'];
                                    $point = $attempted.(($verdict == 3)?" ($panalty)":"");

                                    $submissionLink = "contest_arena.php?id=$contestId&submissions&user=$userId&problem=$key1";

                                ?>
                                <a href="<?php echo $submissionLink; ?>">
                                    <div class="label <?php echo $labelClass; ?>">
                                        <div class="<?php echo $iconLabel; ?>"></div>
                                    </div>
                                    <div class="label label-default"><?php echo "$point"; ?></div>
                                </a>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
            	</div>
            	</div>
        	</div>
    	</div>