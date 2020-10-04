var contestAnnouncementList;
var contestArenaUrl = "contest_arena_action.php";
var contestFinishStatus = 0;
storeAnnouncementList();
getContestAnnouncement();


function storeAnnouncementList(){
	$.post(contestArenaUrl,buildData("getContestAnnouncement",contestId),function(response){
		response = JSON.parse(response);
		contestAnnouncementList = response;
	});
}

function fiterSubmission(){
	user = $("#filterUser").val();
	language = $("#filterLanguage").val();
	verdict = $("#filterVerdict").val();
	problem = $("#filterProblem").val();
	getUrl = "contest_arena.php?id="+contestId+"&submissions";
	if(user != "")getUrl += "&user="+user;
	if(language != -1)getUrl += "&language="+language;
	if(verdict != -1)getUrl += "&verdict="+verdict;
	if(problem != -1)getUrl += "&problem="+problem;
	window.location.href = getUrl;
}


function getContestAnnouncement(){
	$.post(contestArenaUrl,buildData("getContestAnnouncement",contestId),function(response){
		//response = JSON.parse(response);
		//response.forEach(processAnnouncementList);
	});
}

function processAnnouncementList(item){
	//console.log(item.commentDetail);

}

function timeConvert(timeDiffrent){
  timeDiffrent = timeDiffrent<=0?0:timeDiffrent;
  hour = Math.floor(timeDiffrent/3600);
  timeDiffrent -= hour*3600;
  minute = Math.floor(timeDiffrent/60);
  timeDiffrent -=minute*60;
  second = timeDiffrent;

  if(hour<10)hour="0"+hour;
  if(minute<10)minute="0"+minute;
  if(second<10)second="0"+second;

  var data = {
  	'hour' : hour,
  	'minute' : minute,
  	'second' : second
  }

  return data;
}

function setContestTimer(){
	if(contestFinishStatus == 1)return;
	var data = timeConvert(contestTimerTime);
	$("#contestTimer").html(data.hour+" : "+data.minute+" : "+data.second);
	if(contestTimerTime<=0 && contestFinishStatus==0){
		$("#contestTimer").hide();
		$("#contestStatusTxt").html("Contest Is Finish");
		alert("Contest Is Finish");
		contestFinishStatus = 1;
	}
}

function loadSubmitProblem(){
	modal.lg.open("Submit Your Solution");
	loader(modal.lg.body);
	$.post(contestArenaUrl,buildData("loadSubmitProblem"),function(response){
		modal.lg.setBody(response);
	});
}

function createSubmission(){
	sourceCode = sourceCodeEditor.getValue("sourceCodeEditor");
	if(sourceCode.length>=20000){
		toast.danger("Source Code Length Is Very Large "+sourceCode.length);
		return;
	}

	btnOff("btnCreateSubmit", "Processing");
	//$("#submission_error").hide();
	var data = {
		'languageId': $("#selectLanguage").val(),
		'sourceCode': btoa(sourceCode),
		'problemNumber': problemNumber,
		'contestId' : contestId,
		'languageName': $("#selectLanguage option:selected" ).text()
	}
	//console.log(data);
	$.post(contestArenaUrl,buildData("createContestSubmission",data),function(response){
		console.log(response);
		response=JSON.parse(response);

		if(response.error == 0){
			
			$.post("submission_action.php",buildData("viewSubmission",response.submissionId),function(response){
        		$("#modal_lg_body").html(response);
        		toast.success("Successfully Submission");
    		});
    		btnOn("btnCreateSubmit","Submit");
			
		}
		else{
		 	toast.danger(response.errorMsg);
			btnOn("btnCreateSubmit","Submit");
		}
	});
}

setInterval(function(){ 
	setContestTimer();
	contestTimerTime -= 1;
}, 1000);