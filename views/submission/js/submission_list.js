function loadSubmissionListTable(pageNo=1){
	
	userId = $("#filterUserId").val();
	problemId = $("#filterProblemId").val();
	languageId = $("#filterLanguageId").val();
	verdict = $("#filterVerdict").val();

	btnOff("submissionFilterBtn","Filtering...");
	var filterData={};
	if(userId!="")filterData['userId']=userId;
	if(problemId!="")filterData['problemId']=problemId;
	if(languageId!=-1)filterData['languageId']=languageId;
	if(verdict!=-1)filterData['verdict']=verdict;
	filterData['pageNo']=pageNo;
	$.post("submission_action.php",buildData("submissionListFilter",filterData),function(response){
		$("#submissionListTable").html(response);
		btnOn("submissionFilterBtn","Filter");
	});
}