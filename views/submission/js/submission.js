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
	$("#submission_cpu").html(submissionInfo.maxTime+" s");
	$("#submission_memory").html(submissionInfo.maxMemory+" KB");
	$("#submission_verdict").html(submissionInfo.judgeStatus.verdictLabel);
}

function setTestCaseInfo(){ 
	if(testCaseReady!=1){
		$.each( submissionTestCaseInfo, function( key, value ) {
			var sl=value.testCaseSerialNo;
			trBuild  = 	"<td class='td2 submissionTd submissionTd2'><span class='fa fa-angle-double-down' id='viewTest_"+value.testCaseSerialNo+"'></span></td>";
			trBuild += 	"<td class='td2 submissionTd submissionTd2' id='"+sl+"_sl'>"+value.testCaseSerialNo+"</td>";
			trBuild += 	"<td class='td2 submissionTd submissionTd2' id='"+sl+"_cpu'>"+value.totalTime+" s</td>";
			trBuild += 	"<td class='td2 submissionTd submissionTd2' id='"+sl+"_memory'>"+value.totalMemory+" KB</td>";
			trBuild += 	"<td class='td2 submissionTd submissionTd2' id='"+sl+"_point'>"+value.point+"</td>";
			trBuild += 	"<td class='td2 submissionTd submissionTd2 submissionVerdictTd' id='"+sl+"_verdict'>"+value.judgeStatus.verdictLabel+"</td>";;
  			trBuild	 =	"<tr onclick='testCaseDetail("+value.testCaseSerialNo+")' class='submissionTr'>"+trBuild+"</tr>";
  			trBuild +=	"<tr><td colspan='6'><div class='testCaseDetailArea' id='testCaseDetailArea_"+value.testCaseSerialNo+"'></div></td></tr>";
  			$('#testCaseTable tr:last').after(trBuild);

		});
		testCaseReady=submissionInfo.testCaseReady;
	}
	else{
		$.each(submissionTestCaseInfo, function( key, value ) {
			var sl=value.testCaseSerialNo;
			$("#"+sl+"_verdict").html(value.judgeStatus.verdictLabel);
  			$("#"+sl+"_cpu").html(value.totalTime+" s");
  			$("#"+sl+"_memory").html(value.totalMemory+" KB");	
  			$("#"+sl+"_point").html(value.point);
  			//$("#"+sl+"_checkerLog").html(value.checkerLog);
  			setSubmissionDetails(value);	
		});
	}	
}

function setSubmissionDetails(data){
	if(data.verdict < 3)return;
	var sl=data.testCaseSerialNo;
	submissionDetail = '<div class="testCaseDetailBodyArea"><div class="testCaseDetailHeader">Input</div>';
	submissionDetail += '<div class="testCaseDetailBody">'+data.input+'</div></div>';
	submissionDetail += '<div class="testCaseDetailBodyArea"><div class="testCaseDetailHeader">Output</div>';
	submissionDetail += '<div class="testCaseDetailBody">'+data.output+'</div></div>';
	submissionDetail += '<div class="testCaseDetailBodyArea"><div class="testCaseDetailHeader">Answer</div>';
	submissionDetail += '<div class="testCaseDetailBody">'+data.answer+'</div></div>';
	submissionDetail += '<div class="testCaseDetailBodyArea"><div class="testCaseDetailHeader">Checker Log</div>';
	submissionDetail += '<div class="testCaseDetailBody">'+data.checkerLog+'</div></div>';
    $("#testCaseDetailArea_"+sl).html(submissionDetail);                         
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