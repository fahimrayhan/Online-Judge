var formId = 1;
var formHashId;

function buildFormData(key, val) {
    val = !val ? "" : val;
    var data = {};
    data[key] = val;
    data['formHashId'] = formHashId;

    console.log(data);
    return data;
}

function loadFormSerial(){
	//modal.md.open("Update Form Seiral");
	loader("update_serial");
	$.post("contest_arena_action.php", { 'loadFormSerial': 1}, function(response) {
       // modal.md.setBody(response);
    	$("#update_serial").html(response);
    });
}

function loadAddQuestionPage(){
    modal.lg.open("Add Question");
    loader(modal.lg.body);
    $.post("form_action.php", buildFormData("loadAddQuestionPage"), function(response) {
        modal.lg.setBody(response);
    });
}

function formQuestionList(){
    $.post("form_action.php", buildFormData("formQuestionList"), function(response) {
        $("#formBuilder").html(response);
    });
}

function deleteFormQuestion(questionHashId){
    var ok = confirm("Are you want to delete this question");
    if(!ok)return;
    $.post("form_action.php", buildFormData("deleteFormQuestion",questionHashId), function(response) {
        console.log(response);
        response = JSON.parse(response);
        if(response.error == 1){
            toast.danger(response.errorMsg);
        }
        else {
            toast.success(response.errorMsg);
            formQuestionList();
        }
    });
}