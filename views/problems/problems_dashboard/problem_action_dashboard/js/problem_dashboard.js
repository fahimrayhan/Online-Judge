var dashboard_action_url="problem_dashboard_action.php";
var moderatorsList;
var previousActive;
var checkerEditor;
// page ready event ------------------------------------------

$( document ).ready(function() {
    displayPage();
    if (window.history && window.history.pushState) {
    	window.history.pushState('forward', null, window.location.search);
    	$(window).on('popstate', function() {
      		backPageUrl();
    	});
  	}
});

function backPageUrl(){
	var queryString = window.location.search;
    var backPageAction=getAllUrlParams(queryString).action;
    changeOption(backPageAction,1);
}


//site info---------------------------------

function displayPage(){
	changeOption(pageActionName);
}

function changeUrl(actionName,pageName=""){
	url = "problems_dashboard.php?id="+problemId+"&action="+actionName;
	var obj = { Title: pageName, Url: url };
    history.pushState(obj, obj.Title, obj.Url);
}

function setHeaderName(headerName){
	//$("#box_dashboard_header").html(headerName);
}

function setOptionActive(optionName){
	if(previousActive!=""){
		$('#'+previousActive).removeClass("problemNavTab problemNavTabActive");
		$('#'+previousActive).addClass("problemNavTab");
	}
	$('#'+optionName).addClass("problemNavTab problemNavTabActive");
	
	previousActive=optionName;
}

function loadPage(pageName,divName="option_box_body"){
	loader(divName);
	$.post(dashboard_action_url,buildData(pageName,problemId),function(response){
		$("#"+divName).html(response);
	});
}

function changeOption(optionName,fromBack=0){
	
	if(fromBack==0)
		changeUrl(optionName);
	setOptionActive(optionName);

	if(optionName=="testCase"){
		setHeaderName("Test Case");
		loadPage("loadTestCasePage");
	}
	else if(optionName=='edit'){
		loadPage("loadEditPage");
		//location.reload();
	}
	else if(optionName=='moderators'){
		setHeaderName("Moderators");
		loadModeratorsPage();
	}
	else if(optionName=='testing'){
		setHeaderName('Testing Problem');
		loadTestingPage();
	}
	else if(optionName=='setting'){
		setHeaderName('Setting');
		loadSettingPage();
	}
	else if(optionName=='viewProblem'){
		setHeaderName('viewProblem');
		loadViewProblem();
	}
	else if(optionName=='checker'){
		setHeaderName('checker');
		loadCheckerPage();
	}
	else{
		setHeaderName("Problem Overview");
		loadPage("loadOverviewPage");
	}

}

//=======================================================

//start setting page 


function loadViewProblem(){
	loader("option_box_body");
	$.post(dashboard_action_url,buildData("loadViewProblem",problemId),function(response){
		$("#option_box_body").html(response);
		if(typeof MathJax !== 'undefined') {MathJax.Hub.Queue(["Typeset",MathJax.Hub]);}
	});
}

function loadSettingPage(){
	loader("option_box_body");
	$.post(dashboard_action_url,buildData("loadSettingPage",problemId),function(response){
		$("#option_box_body").html(response);
	});
}

function updateProblemSetting(){
	var data={
		'problemId': problemId,
		"problemName": $("#problemName").val(),
		'cpuTimeLimit': $("#problemTimeLimit").val(),
		'memoryLimit' : $("#problemMemoryLimit").val()
	}
	//console.log(data);
	btnOff("updateProblem","Saving");
	$("#error_area").hide();
	$.post(dashboard_action_url,buildData("updateProblemSetting",data),function(response){
		console.log(response);
		response=JSON.parse(response); 
		if(response.error==1){
			$("#error_area").show();
			$("#error_area").html(response.error_msg);
			btnOn("updateProblem","Update Problem");
		}
		else
			loadSettingPage();
	});
}

function reqJudgeProblemList(){
	btnOff("reqArc","Sending..");
	$.post(dashboard_action_url,buildData("reqJudgeProblemList",problemId),function(response){
		loadSettingPage();
	});
}


//===========================================================

//start moderator page


function loadModeratorsPage(){
	loader("option_box_body");
	$.post(dashboard_action_url,buildData("loadModeratorsPage",problemId),function(response){
		$("#option_box_body").html(response);
		getModeratorsList();
	});
}

function getModeratorsList(){
	$.post(dashboard_action_url,buildData("getModeratorsList",problemId),function(response){
		moderatorsList=JSON.parse(response);
	});
}

function addProblemModerator(userId){
	var data = {
		'userId': userId,
		'problemId': problemId
	}
	$.post(dashboard_action_url,buildData("addProblemModerator",data),function(response){
		loadModeratorsPage();
		toast.success("Successfully Add Moderator");
	});
}

function deleteProblemModerator(userId){
	var ok=confirm('Are You Want To Delete Moderator.');
	if(!ok)return;
	var data = {
		'userId': userId,
		'problemId': problemId
	}
	$.post(dashboard_action_url,buildData("deleteProblemModerator",data),function(response){
		//console.log(response);
		loadModeratorsPage();
		toast.success("Successfully Delete Moderator");
	});
}

function search_moderators(){
	
	$('#suggestion_box').html("");
	var search_val=$("#search_moderators").val();
	var co=0;
	$.each(moderatorsList, function() {
		if (this.userHandle.toLowerCase().includes(search_val.toLowerCase())==true && search_val.length>=1){
			co=co+1;
			if(co>5)return;
			$('#suggestion_box').append(
        		"<li class='list-group-item moderators_suggestion_li' onclick='addProblemModerator("+this.userId+")'>"+
        		"<img class='img-thumbnail moderators_suggestion_li_img' src='"+this.userPhoto+"'><b> "
        		+this.userHandle+
        		"</b></li>"
    		);
		}
    	
	});
}

//===========================================================

// start submission page 

function loadTestingPage(){

	loader("option_box_body");
	$.post(dashboard_action_url,buildData("loadTestingPage",problemId),function(response){
		$("#option_box_body").html(response);
	});
}

setInterval(function(){ 
		//loadTestingPage();
}, 1000);

function loadCreateSubmissionPage(){
	modalOpen("lg","Create Submission");
	loader("modal_lg_body");
	$.post(dashboard_action_url,buildData("loadCreateSubmissionPage",problemId),function(response){
		$("#modal_lg_body").html(response);
		//setTimeout(function(){ setEditor(); }, 100);
	});
}

function setEditor(language = "CPP") {
    var editor = ace.edit("sourceCodeEditor");
    editor.setOption("maxLines", "Infinity");
    editor.setOption("minLines", 20);
    editor.setReadOnly(false);
    var lang = "cpp";
    if (lang.startsWith("cpp")) {
        editor.getSession().setMode("ace/mode/c_cpp");
    }
    if (lang.startsWith("java")) {
        editor.getSession().setMode("ace/mode/java");
    }
    if (lang.startsWith("pypy3")) {
        editor.getSession().setMode("ace/mode/python");
    }
    if (lang.startsWith("rust")) {
        editor.getSession().setMode("ace/mode/rust");
    }
    if (lang.startsWith("d")) {
        editor.getSession().setMode("ace/mode/d");
    }
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
		'problemId': problemId,
		'languageName': $("#selectLanguage option:selected" ).text()
	}
	//console.log(data);
	$.post(dashboard_action_url,buildData("createSubmission",data),function(response){
		response=JSON.parse(response);
		console.log(response);
		if(response.error==1){
			//$("#submission_error").show();
			//$("#submission_error").html(response.msg);
			toast.danger(response.msg);
			btnOn("btnCreateSubmit","Submit");
		}
		else{
			msg=JSON.parse(response.msg);
		 	//modal_action("md","","close");
		 	toast.success("Successfully Submission");
    		$.post("submission_action.php",buildData("viewSubmission",msg.insert_id),function(response){
        		$("#modal_lg_body").html(response);
    		});
		 	//setTimeout(function(){ viewSubmissionById(msg.insert_id); }, 500);
		 	//window.open("submission.php?id="+msg.insert_id, '_self');
		 	
		}

		//$("#modal_md_body").html(response);
		//modal_action("md","Add Test Case","close");
		//loadTestingPage();
	});
}



//start test case function

function loadTestCasePage(){
	loader("option_box_body");

	$.post(dashboard_action_url,buildData("loadTestCasePage",problemId),function(response){
		$("#option_box_body").html(response);
		
	});
}

function loadCheckerPage(){
	loader("option_box_body");
	$.post(dashboard_action_url,buildData("loadCheckerPage",problemId),function(response){
		$("#option_box_body").html(response);
		//setCheckerEditor();
	});
}

function setCheckerEditor() {
    checkerEditor = ace.edit("checkerEditor");
    checkerEditor.setOption("maxLines", 30);
    checkerEditor.setOption("minLines", 30);
    checkerEditor.setReadOnly(false);
    checkerEditor.getSession().setMode("ace/mode/c_cpp");
}

function saveChecker(){
	checkerCode = checkerEditor.getValue("checkerEditor");
	var data = {
		'problemId': problemId,
		'checker': btoa(checkerCode)
	}
	btnOff("btnSaveChecker", "Saving");
	$.post(dashboard_action_url,buildData("saveChecker",data),function(response){
		toast.success("Successfully Update Checker");
		btnOn("btnSaveChecker", "Save Checker");
	});
}