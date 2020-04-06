
var url="submission_action.php";

function loadSubmiProblemPage(){
	modalOpen("md","Submit Solution");
	loader("modal_md_body");
	$.post(url,buildData("loadSubmiProblemPage"),function(response){
		$("#modal_md_body").html(response);
		//setTimeout(function(){ setEditor(); }, 100);
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
	$.post(url,buildData("createSubmission",data),function(response){
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

function selectLanguage(){
	var languageName=$("#selectLanguage option:selected" ).text();
	var altLanguage = {
		'GCC': 'CPP',
		'Java': 'JAVA',
		'Python': 'Python'
	}
	//if (languageName.indexOf("GCC") >= 0)setEditor("CPP");
	//else if (languageName.indexOf("Java") >= 0)setEditor("Javascript");
	//else if (languageName.indexOf("Python") >= 0)setEditor("Python");
	//else setEditor("XML");
}