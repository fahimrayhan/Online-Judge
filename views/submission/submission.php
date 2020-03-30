


<?php

    $ok=-1;

    if(isset($_GET['id'])){
        $submissionId=$_GET['id'];
        $ok=$Submission->checkSubmissionAuth($submissionId);
    }

    if($ok==-1){
        include "404.php";
        return;
    }

    
    $info=array();
    $info['submissionId']=$submissionId;
    $submissionAllInfo=$Submission->getSubmissionAllInfo($info);
    
    $submissionInfo=$submissionAllInfo['submissionInfo'];
    $submissionTestCase=$submissionAllInfo['submissionTestCase'];

    $sourceCodePermission=$ok;
    $testCaseAreaCol=$sourceCodePermission==1?6:12;


    $sourceCode=$submissionInfo['sourceCode'];


?>

<script type="text/javascript">
    var submissionId = <?php echo $submissionInfo['submissionId']; ?>;
    var testCaseReady = <?php echo $submissionInfo['testCaseReady']; ?>; 
</script>

<script type="text/javascript" src="views/submission/js/submission.js"></script>

<div class='row'>
    <div class='col-md-12'>
        <div class="box">
        	<div class="box_header">Submission</div>
           	<div class="box_body">
                <div id="result"></div>
           		<div style="position: left"><button onclick="rejudgeSubmission()">Rejudge</button></div>
                <table width="100%" id="submission_table" class="table">
                	<tr>
                		<td class="td1">#</td>
                		<td class="td1">Author</td>
                		<td class="td1">Problem</td>
                		<td class="td1">Time</td>
                		<td class="td1">Language</td>
                		<td class="td1">CPU</td>
                		<td class="td1">Memory</td>
                		<td class="td1">Verdict</td>
                	</tr>
                	<tr>
                		<td class="td2"><?php echo $submissionInfo['submissionId']; ?></td>
                		<td class="td2"><a href="profile.php?id=<?php echo $submissionInfo['userId']; ?>"><?php echo $submissionInfo['userHandle']; ?></a></td>
                		<td class="td2"><a href="p.php?id=<?php echo $submissionInfo['problemId']; ?>"><?php echo $submissionInfo['problemName']; ?></a></td>
                		<td class="td2"><?php echo $submissionInfo['submissionTime']; ?></td>
                		<td class="td2"><?php echo $submissionInfo['languageName']; ?></td>
                		<td class="td2" id="submission_cpu"><?php echo $submissionInfo['maxTimeLimit']; ?> s</td>
                		<td class="td2" id="submission_memory"><?php echo $submissionInfo['maxMemoryLimit']; ?> KB</td>
                		<td class="td2" id="submission_verdict"><?php echo $submissionInfo['judgeStatus']; ?></td>
                	</tr>
            	</table>
           	</div>
        </div>
    </div>
    <div class='col-md-<?php echo $testCaseAreaCol ?>'>
    	<div class="box">
    		<div class="box_header">Test Cases</div>
    		<div class="box_body">
    			<table width="100%" id="testCaseTable">
                	<thead>
                    <tr>
                		<td class="td1">#</td>
                		<td class="td1">CPU</td>
                		<td class="td1">Time</td>
                		<td class="td1">Verdict</td>
                	</tr>
                    </thead>
                    <tbody>
                	<?php 
                        $c=0;
                    foreach ($submissionTestCase as $key => $value) { 
                        $c=$value['testCaseSerialNo'];
                    ?>
                	<tr>
                		<td class="td2" id="<?php echo $c ?>_sl"><?php echo $c; ?></td>
                		<td class="td2" id="<?php echo $c ?>_cpu"><?php echo $value['totalTime']; ?> s</td>
                		<td class="td2" id="<?php echo $c ?>_memory"><?php echo $value['totalMemory']; ?> KB</td>
                		<td class="td2" id="<?php echo $c ?>_verdict"><?php echo $value['judgeStatus']; ?></td>
                	</tr>
                	<?php } ?>
                    </tbody>
                </table>
    		</div>
    	</div>
    </div>
    <?php if($sourceCodePermission==1){ ?>
    
    <script type="text/javascript" src="style/lib/editarea_0_8_2/edit_area/edit_area_full.js"></script>
    
    <div class='col-md-6'>
        <div class="box">
            <div class="box_header">Source Code</div>
            <div class="box_body">
               <textarea id='sourceCodeEditor' style='height: 250px; width: 100%;'><?php echo $sourceCode; ?></textarea>
                <script type="text/javascript">
                    setEditor("d");
                </script>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

