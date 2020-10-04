var dashboard_action_url="admin_dashboard_action.php";
var dashboard="#dashboardArea";

// page ready event ------------------------------------------

$( document ).ready(function() {
    judgeProblemList();
});


//site info---------------------------------



function siteStatus(){
	loader("dashboardArea");
	$.post(dashboard_action_url,buildData("siteStatus"),function(response){
		$(dashboard).html(response);
	});
}

function delJudgeProblemList(problemId) {
	var ok=confirm('Are You Want To Delete This Problem.');
	if(!ok)return;
	$.post(dashboard_action_url,buildData("delJudgeProblemList",problemId),function(response){
		toast.success("Successfully Deleted Problem List");
		//console.log(response);
		judgeProblemList();
	});
}

function addJudgeProblemList(listId){
	var ok=confirm('Are You Want To Add This Problem.');
	if(!ok)return;
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

function userRoleChange(userId,userRoles){
	var ok=confirm('Are You Want To Change User Roles.');
	if(!ok)return;
	var data = {
		'userId': userId,
		'userRoles': userRoles
	}
	$.post(dashboard_action_url,buildData("userRoleChange",data),function(response){
		toast.success("Successfully Change Roles");
		judgeModeratorList();
	});
}
 
function judgeModeratorList(){
	loader("dashboardArea");
	$.post(dashboard_action_url,buildData("judgeModeratorList"),function(response){
		$(dashboard).html(response);
	});
}

sendTestPostReq();
var countReq = 0;
var slugSet = new Set(); 
function sendTestPostReq(){
	
}
