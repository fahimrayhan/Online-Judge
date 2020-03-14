var dashboard_action_url="problem_dashboard_action.php";
var moderatorsList;

// page ready event ------------------------------------------

$( document ).ready(function() {
    displayPage();
});


//site info---------------------------------

function displayPage(){
	if(pageActionName!="edit" && pageActionName!="viewProblem" )
		changeOption(pageActionName);
}

function changeUrl(actionName,pageName=""){
	url = "problems_dashboard.php?id="+problemId+"&action="+actionName;
	var obj = { Title: pageName, Url: url };
    history.pushState(obj, obj.Title, obj.Url);
}

function setHeaderName(headerName){
	$("#box_dashboard_header").html(headerName);
}

function loadPage(pageName,divName="option_box_body"){
	loader(divName);
	$.post(dashboard_action_url,buildData(pageName,problemId),function(response){
		$("#"+divName).html(response);
	});
}

function changeOption(optionName){
	if(optionName=="testCase"){
		changeUrl(optionName);
		setHeaderName("Test Case");
		loadPage("loadTestCasePage");
	}
	else if(optionName=='edit'){
		changeUrl(optionName);
		location.reload();
	}
	else if(optionName=='moderators'){
		changeUrl(optionName);
		setHeaderName("Moderators");
		loadModeratorsPage();
	}
	else if(optionName=='testing'){
		changeUrl(optionName);
		setHeaderName('Testing Problem');
		loadTestingPage();
	}
	else if(optionName=='setting'){
		changeUrl(optionName);
		setHeaderName('Setting');
		loadSettingPage();
	}
	else if(optionName=='viewProblem'){
		changeUrl(optionName);
		location.reload();
	}
	else{
		changeUrl("overview");
		setHeaderName("Problem Overview");
		loadPage("loadOverviewPage");
	}

}

//=======================================================

//start setting page 

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
	modalOpen("md","Create Submission");
	loader("modal_md_body");
	$.post(dashboard_action_url,buildData("loadCreateSubmissionPage",problemId),function(response){
		$("#modal_md_body").html(response);
		setTimeout(function(){ setEditor(); }, 100);
	});
}

function createSubmission(){
	btnOff("btnCreateSubmit", "Processing");
	$("#submission_error").hide();
	var data = {
		'languageId': $("#selectLanguage").val(),
		'sourceCode': btoa(editAreaLoader.getValue("sourceCodeEditor")),
		'problemId': problemId,
		'languageName': $("#selectLanguage option:selected" ).text()
	}
	//console.log(data);
	$.post(dashboard_action_url,buildData("createSubmission",data),function(response){
		response=JSON.parse(response);
		console.log(response);
		if(response.error==1){
			$("#submission_error").show();
			$("#submission_error").html(response.msg);
			btnOn("btnCreateSubmit","Submit");
		}
		else{
			msg=JSON.parse(response.msg);
		 	window.open("submission.php?id="+msg.insert_id, '_self');
		}

		//$("#modal_md_body").html(response);
		//modal_action("md","Add Test Case","close");
		//loadTestingPage();
	});
}

function setEditor(language="CPP"){
	editAreaLoader.init({
        id: "sourceCodeEditor",  
        start_highlight: true,
        allow_resize: "both",
        allow_toggle: false,
        word_wrap: true,
        language: "en",
        syntax: language  
    });
}

//start test case function

function loadTestCasePage(){
	loader("option_box_body");

	$.post(dashboard_action_url,buildData("loadTestCasePage",problemId),function(response){
		$("#option_box_body").html(response);
	});
}

function loadAddTestCasePage(){
	modal_action("md","Add Test Case");
	loader("modal_md_body");
	$.post(dashboard_action_url,buildData("loadAddTestCasePage"),function(response){
		$("#modal_md_body").html(response);
	});
}



function addTestCase(){
	var data = {
		'input': $('#inputValue').val(),
		'output': $('#outputValue').val(),
		'problemId': problemId
	}

	loader("modal_md_body");
	$.post(dashboard_action_url,buildData("addTestCase",data),function(response){
		//$("#modal_md_body").html(response);
		loadPage("loadTestCasePage");
		modal_action("md","Add Test Case","close");
	});
}



function loadEditTestCasePage(btn_sl){
	modal_action("md","Edit Test Case");
	var hashId=$("#btn_edit_"+btn_sl).val();
	loader("modal_md_body");
	$.post(dashboard_action_url,buildData("loadEditTestCasePage",hashId),function(response){
		$("#modal_md_body").html(response);
	});
}

function updateTestCase(){
	var data = {
		'input': $('#inputValue').val(),
		'output': $('#outputValue').val(),
		'hashId': $("#btnUpdate").val()
	}
	
	loader("modal_md_body");
	$.post(dashboard_action_url,buildData("updateTestCase",data),function(response){
		//$("#modal_md_body").html(response);
		loadTestCasePage();
		modal_action("md","Add Test Case","close");
	});
}


function deleteTestCase(btn_sl){
	var ok=confirm('Are You Want To Delete This Test Case.');
	if(!ok)return;
	var hashId=$("#btn_del_"+btn_sl).val();
	loader("option_box_body");
	$.post(dashboard_action_url,buildData("deleteTestCase",hashId),function(response){
		loadTestCasePage();
	});
}

//===========================================================