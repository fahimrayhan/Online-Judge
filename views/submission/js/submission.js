var url="submission_action.php";
var submissionInfo;
var submissionTestCaseInfo;
var loadData=1;
var openToggleSourceCode=false;
getSubmissionAllInfo();


function getSubmissionAllInfo(){
	if(loadData==0)
		return;
	var data = {
		'submissionId': submissionId
	}

	$.post(url,buildData("getSubmissionAllInfo",data),function(response){
		console.log(response);
		info=JSON.parse(response);
		submissionInfo=info.submissionInfo;
		submissionTestCaseInfo=info.submissionTestCase;
		if(submissionInfo.judgeComplete==1)
			loadData=0;
		setSubmissionInfo();
		setTestCaseInfo();
	});
}

function rejudgeSubmission(){
	var ok=confirm('Are You Want To Rejudge Submission.');
	if(!ok)return;
	btnOff("rejudgeBtn","Rejudging....")
	$.post(url,buildData("rejudgeSubmission",submissionId),function(response){
		location.reload();
	});
}


function setSubmissionInfo(){
	$("#submission_cpu").html(submissionInfo.maxTimeLimit+" s");
	$("#submission_memory").html(submissionInfo.maxMemoryLimit+" KB");
	$("#submission_verdict").html(submissionInfo.judgeStatus);
}

function setTestCaseInfo(){ 
	if(testCaseReady!=1){
		$.each( submissionTestCaseInfo, function( key, value ) {
			var sl=value.testCaseSerialNo;
  			td_sl="<td class='td2 submissionTd submissionTd2' id='"+sl+"_sl'>"+value.testCaseSerialNo+"</td>";
  			td_cpu="<td class='td2 submissionTd submissionTd2' id='"+sl+"_cpu'>"+value.totalTime+" s</td>";
  			td_memory="<td class='td2 submissionTd submissionTd2' id='"+sl+"_memory'>"+value.totalMemory+" KB</td>";
  			td_point="<td class='td2 submissionTd submissionTd2' id='"+sl+"_point'>"+value.point+"</td>";
  			td_checkerLog="";
  			td_verdict="<td class='td2 submissionTd submissionTd2 submissionVerdictTd' id='"+sl+"_verdict'>"+value.judgeStatus+"</td>";
  			tr_build="<tr class='submissionTr'>"+td_sl+td_cpu+td_memory+td_point+td_checkerLog+td_verdict+"</tr>";
  			$('#testCaseTable tr:last').after(tr_build);
		});
		testCaseReady=submissionInfo.testCaseReady;
	}
	else{
		$.each(submissionTestCaseInfo, function( key, value ) {
			var sl=value.testCaseSerialNo;
			$("#"+sl+"_verdict").html(value.judgeStatus);
  			$("#"+sl+"_cpu").html(value.totalTime+" s");
  			$("#"+sl+"_memory").html(value.totalMemory+" KB");	
  			$("#"+sl+"_point").html(value.point);	
  			//$("#"+sl+"_checkerLog").html(value.checkerLog);	
		});
	}	
}

function copySourceCode(){
	openToggleSourceCode=false;
	toggleSourceCode();
  	var copyText = document.getElementById("sourceCodeTextArea");
  	copyText.select();
  	copyText.setSelectionRange(0, 99999)
  	document.execCommand("copy");
  	toast.info("Copied Source Code");
}
function toggleSourceCode(){
	var openToggleDiv=openToggleSourceCode?"sourceCodeText":"sourceCodeTextArea";
	var closeToggleDiv=openToggleSourceCode?"sourceCodeTextArea":"sourceCodeText";
	$("#"+openToggleDiv).show();
	$("#"+closeToggleDiv).hide();
	openToggleSourceCode^=1;
}


setInterval(function(){ 
	getSubmissionAllInfo();
}, 2000);