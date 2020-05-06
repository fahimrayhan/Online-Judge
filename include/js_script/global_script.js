// submission page show

function viewSubmissionById(submissionId){
    modal_action("lg","Submission");
    loader("modal_lg_body");
    $.post("submission_action.php",buildData("viewSubmission",submissionId),function(response){
        $("#modal_lg_body").html(response);
    });
}

function updateSubmissionVerdictAllPage(){
	$.post("submission_action.php",buildData("updateSubmissionVerdictAllPage"),function(response){
        response=JSON.parse(response);
        response.map(function(item){
        	$("#submissionGlobalVerdictStatus_"+item.submissionId).html(item.judgeStatus);
        	$("#submissionGlobalVerdictTime_"+item.submissionId).html(item.maxTimeLimit+ " s");
        	$("#submissionGlobalVerdictMemory_"+item.submissionId).html(item.maxMemoryLimit+" kb");
        });
    });
}

setInterval(function(){ updateSubmissionVerdictAllPage(); }, 3000);


function updateSiteStatus(url,setPageViewData=0){
  var data = {
    'url': url,
    'insertPageViewData': setPageViewData
  }
  $.post('site_action.php',buildData("updateSiteStatus",data),function(response){
      //console.log(response);
  });
}

