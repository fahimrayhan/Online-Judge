
var url="submission_action.php";

function loadSubmiProblemPage(){
	modalOpen("lg","Submit Solution");
	loader("modal_lg_body");
	$.post(url,buildData("loadSubmiProblemPage"),function(response){
		$("#modal_lg_body").html(response);
		//setTimeout(function(){ setEditor(); }, 100);
	});
}

function viewSubmissionById(submissionId){
    modal_action("lg","View Submission");
    loader("modal_lg_body");
    $.post("submission_action.php",buildData("viewSubmission",submissionId),function(response){
        $("#modal_lg_body").html(response);
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
		'problemId': problemId,
		'languageName': $("#selectLanguage option:selected" ).text()
	}
	//console.log(data);
	$.post(url,buildData("createSubmission",data),function(response){
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

function setEditor(language="CPP"){
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