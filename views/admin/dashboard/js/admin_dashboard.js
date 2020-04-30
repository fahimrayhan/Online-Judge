var dashboard_action_url="admin_dashboard_action.php";
var dashboard="#dashboardArea";

// page ready event ------------------------------------------

$( document ).ready(function() {
    judgeProblemList();
});


//site info---------------------------------





function delJudgeProblemList(problemId) {
	$.post(dashboard_action_url,buildData("delJudgeProblemList",problemId),function(response){
		toast.success("Successfully Deleted Problem List");
		//console.log(response);
		judgeProblemList();
	});
}

function addJudgeProblemList(listId){
	$.post(dashboard_action_url,buildData("addJudgeProblemList",listId),function(response){
		toast.success("Successfully Added Problem List");
		//console.log(response);
		judgeProblemList();
	});
}

function judgeProblemList(){
	loader("dashboardArea");
	$.post(dashboard_action_url,buildData("judgeProblemList",-1),function(response){
		$(dashboard).html(response);
	});
}

function pendingJudgeProblemList(){
	loader("dashboardArea");
	$.post(dashboard_action_url,buildData("judgeProblemList",0),function(response){
		$(dashboard).html(response);
	});
}

function moderatorList(){
	loader("dashboardArea");
	$.post(dashboard_action_url,buildData("moderatorList"),function(response){
		$(dashboard).html(response);
	});
}

function pendingModeratorList(){
	loader("dashboardArea");
	$.post(dashboard_action_url,buildData("pendingModeratorList"),function(response){
		$(dashboard).html(response);
	});
}
