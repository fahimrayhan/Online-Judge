

function downloadTestCase(){
	$.post("views_action/test_case/test_case.php",buildData("downloadProblem",problemId),function(response){
			//$("#debugTestCase").html(response);
			response = JSON.parse(response);
			if(response.error==0){
				window.location.href = "download.php?file="+response.file;
			}
			//window.location.href = "download.php?file=temp/myzipfile.zip";
			
	});
}


var problemTestCase = {
	problemId : -1,
	ajaxUrl : "ajax_request.php",
	inputEditorType : "editor",
	outputEditorType : "editor",
	uploadInputData : "",
	uploadOutputData : "",
	loadAddTestCasePage: function(){
		modal.md.open("Add test Case");
		loader("modal_md_body");
		$.post(this.ajaxUrl,buildData("loadAddTestCasePage"),function(response){
			$("#modal_md_body").html(response);
		});
	},

	addTestCase : function(){
		console.log("working");
	},
	setInputEditorLimit : function(){
		var editorVal = $('#testCaseInputEditor').val();
		var maxLen = 5000;
		var txtLen = editorVal.length;
		if(txtLen>=maxLen){
			alert("Input File Is To Large. If You Need Large Input You Try Upload or Url Option.");
		}
	},

	setOutputEditorLimit : function(){
		var editorVal = $('#testCaseOutputEditor').val();
		var maxLen = 5000;
		var txtLen = editorVal.length;
		if(txtLen>=maxLen){
			alert("Output File Is To Large. If You Need Large Output You Try Upload or Url Option.");
		}
	},

	loadUpdateTestCasePage : function(e){
		testCaseHash = e.value;
		modal_action("md","Edit Test Case");
		loader("modal_md_body");
		$.post(this.ajaxUrl,buildData("loadUpdateTestCasePage",testCaseHash),function(response){
			$("#modal_md_body").html(response);
		});
	},
	selectInputType : function(e){
		var type = e.value;
		this.inputEditorType = type;
		$("#testCaseInputEditorArea").hide();
		$("#testCaseInputUploadArea").hide();
		$("#testCaseInputUrlArea").hide();
		if(type == "editor")$("#testCaseInputEditorArea").show();
		if(type == "upload")$("#testCaseInputUploadArea").show();
		if(type == "url")$("#testCaseInputUrlArea").show();
	},
	selectOutputType : function(e){
		var type = e.value;
		this.outputEditorType = type;
		$("#testCaseOutputEditorArea").hide();
		$("#testCaseOutputUploadArea").hide();
		$("#testCaseOutputUrlArea").hide();
		if(type == "editor")$("#testCaseOutputEditorArea").show();
		if(type == "upload")$("#testCaseOutputUploadArea").show();
		if(type == "url")$("#testCaseOutputUrlArea").show();
	},
	uploadInputFile : function(event){
		var reader = new FileReader();
    	reader.onload = function(){
        	$.get(reader.result, function(data) {
            	uploadInputData = data;
        	}, "text");
    	};
    	if(event.target.files[0]){
      		reader.readAsDataURL(event.target.files[0]);
    	}
	},
	uploadOutputFile : function(event){
		var reader = new FileReader();
    	reader.onload = function(){
        	$.get(reader.result, function(data) {
            	uploadOutputData = data;
        	}, "text");
    	};
    	if(event.target.files[0]){
      		reader.readAsDataURL(event.target.files[0]);
    	}
	},
	filterTestCaseData : function(editorType,testCaseType){
		var error = "";
		var data = {
			'editorType': editorType
		}

		if(editorType == "upload"){
			var path = $("#testCase"+testCaseType+"Upload").val();
			if(path == "")error = "File Is Not Select";
			else data['text'] = testCaseType=="Input"?uploadInputData:uploadOutputData;
		}
		else if(editorType == "url"){
			var url = $("#testCase"+testCaseType+"Url").val();
			if(url == "")error = "Url Field Is Empty";
			else data['url'] = url;
		}
		else if(editorType == "editor"){
			var text = $("#testCase"+testCaseType+"Editor").val();
			data['text'] = text;
		}
		var filterData = {
			'error' : error,
			'data' : data
		}
		return filterData;
	},

	saveTestCase : function(){
		
		var inputFilterData = this.filterTestCaseData(this.inputEditorType,"Input");
		var outputFilterData = this.filterTestCaseData(this.outputEditorType,"Output");

		if(inputFilterData.error !=""){
			toast.danger(inputFilterData.error);
			return;
		}
		if(outputFilterData.error !=""){
			toast.danger(outputFilterData.error);
			return;
		}

		var data = {
			problemId : this.problemId,
			inputData : inputFilterData.data,
			outputData : outputFilterData.data
		}
		//console.log(filterInputData['data']);
		btn.off("addTestCase","Saving");
		
		$.post(dashboard_action_url,buildData("saveTestCase",data),function(response){
			$("#response").html(response);
			loadTestCasePage();
			modal.md.close();
			toast.success("Successfully Add Test Case");
			//btn.on("addTestCase","Add Test Case");
		});
	},
	updateTestCase : function(e){
		var inputFilterData = this.filterTestCaseData(this.inputEditorType,"Input");
		var outputFilterData = this.filterTestCaseData(this.outputEditorType,"Output");

		if(inputFilterData.error !=""){
			toast.danger(inputFilterData.error);
			return;
		}
		if(outputFilterData.error !=""){
			toast.danger(outputFilterData.error);
			return;
		}

		var data = {
			testCaseHashId : e.value,
			inputData : inputFilterData.data,
			outputData : outputFilterData.data
		}
		//console.log(filterInputData['data']);
		btn.off("updateTestCase","Saving");
		$.post(this.ajaxUrl,buildData("updateTestCase",data),function(response){
			$("#response").html(response);
			modal.md.close();
			loadTestCasePage();
			toast.success("Successfully Update Test Case");
		});
	},
	deleteTestCase : function(e){
		var ok=confirm('Are You Want To Delete This Test Case.');
		if(!ok)return;
		var hashId = e.value;
		loader("option_box_body");
		$.post(dashboard_action_url,buildData("deleteTestCase",hashId),function(response){
			loadTestCasePage();
			toast.success("Successfully Delete Test Case");
		});
	}

}

$("#loadAddTestCaseBtn").click(function(){
  	problemTestCase.loadAddTestCasePage();
});


//===========================================================