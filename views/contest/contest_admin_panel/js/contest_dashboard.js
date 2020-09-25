var contestDashboardUrl = "contest_dashboard_action.php";
var registrationPage = 1;
var generateUserList;
var registrationTable;

function buildContestData(key, val) {
    val = !val ? "" : val;
    var data = {};
    data[key] = val;
    data['contestId'] = contestId;
    return data;
}
$(".up,.down").click(function() {
    var row = $(this).parents("tr:first");
    if ($(this).is(".up")) {
        row.insertBefore(row.prev());
    } else {
        row.insertAfter(row.next());
    }
});
$("#updateContestForm").submit(function(event) {
    for (instance in CKEDITOR.instances) {
        //ckeditor double click problem
        CKEDITOR.instances[instance].updateElement();
    }
    event.preventDefault(); //prevent default action 
    var postUrl = $(this).attr("action"); //get form action url
    var formData = $(this).serialize();
    btn.off("saveContestDataBtn", "Saving...");
    $.post(contestDashboardUrl, buildContestData("updateContestInfo", formData), function(response) {
        //console.log(response);
        response = JSON.parse(response);
        if (response.error == 1) toast.danger("response.error_msg");
        else toast.success(response.error_msg);
        btn.on("saveContestDataBtn", "Save Changes");
    });
});

function contestBannerImgPreview(e) {
    $('#contestBannerPreview').attr('src', e.value)
}

function selectContestVisibility(e) {
    $("#contestPassword").hide();
    $("#contestRegistraionFormInputArea").hide();
    if (e.value == "Public") {
        $("#contestRegistraionFormInputArea").show();
    } else if (e.value == "Protected") {
        $("#contestPassword").show();
        $("#contestRegistraionFormInputArea").show();
    } else if (e.value == "Private") {
        $("#contestRegistraionFormInputArea").hide();
    }
}


//contest problem start

function addProblemDilog() {
    var problemId = prompt("Please Enter Problem Id:", "");
    problemId = !problemId ? "" : problemId;
    if (problemId != "") {
        $.post(contestDashboardUrl, buildContestData("addProblem", problemId), function(response) {
            response = JSON.parse(response);
            if(response.error == 1){
                toast.danger(response.errorMsg);
            }
            else {
                toast.success(response.errorMsg);
                loadProblemsPage();
            }
        });
    }
}

function deleteProblem(e){
    var ok = confirm("Are you want to delete this problem");
    if(!ok)return;
    $.post(contestDashboardUrl, buildContestData("deleteProblem",e.value), function(response) {
        console.log(response);
        response = JSON.parse(response);
        if(response.error == 1){
            toast.danger(response.errorMsg);
        }
        else {
            toast.success(response.errorMsg);
            loadProblemsPage();
        }
    });
}

function viewContestProblem(problemNumber){
    modal.lg.open("Problem "+problemNumber);
    loader(modal.lg.body);
    $.post(contestDashboardUrl, buildContestData("viewContestProblem",problemNumber), function(response) {
        modal.lg.setBody(response);
        if(typeof MathJax !== 'undefined') {MathJax.Hub.Queue(["Typeset",MathJax.Hub]);}
    });
}

function loadProblemsPage(){
    $.post(contestDashboardUrl, buildContestData("loadProblemsPage"), function(response) {
        $("#dashboardBody").html(response);
    });
}

//start registration area

function refreshTable() {
    registrationTable.draw( false );
}

function loadRegistrationDataTable(){
    registrationTable.ajax.reload();
}

function downloadRegistrationList(){
    modal.sm.open("Download Registration List");
    loader(modal.sm.body);
    $.post(contestDashboardUrl, buildContestData("downloadRegistrationList"), function(response) {
        modal.sm.setBody(response);
    });
}

function createRegistrationDownloadFile(){
    
    btn.off("downlaodCsv","Downloading...");

    var keyList = {};

    $("input[name='registrationListOptionSelect[]']:checked").each(function (index, obj) {
        keyList[obj.value] = 1;
    });

    $.post(contestDashboardUrl, buildContestData("createRegistrationDownloadFile",keyList), function(response) {
       console.log(response);
        response = JSON.parse(response);
        if(response.error == 0){
            toast.success("Downlaoding Registration File");
            document.location.href = "download.php?delete&file="+response.downloadFileName;
        }
        else toast.danger("Downlaod Error");
        btn.on("downlaodCsv","<i class='fa fa-download'></i> Download CSV");
    });
}

function updateParticipantRegistration(registrationStatus){
    
    var ok = confirm("Are you want to "+registrationStatus+" those registration id");
    if(!ok)return;

    var registrationList = [];
    $("input[name='contestRegistrationList[]']:checked").each(function (index, obj) {
        registrationList.push(obj.value);
    });

    if(registrationList.length == 0){
        toast.danger("You can not select any row");
        return;
    }

    var data = {
        'registrationList': registrationList,
        'registrationStatus': registrationStatus
    }

    $.post(contestDashboardUrl, buildContestData("updateParticipantRegistration",data), function(response) {
        //console.log(response);
        response = JSON.parse(response);
        if(response.error == 1)toast.danger(response.errorMsg);
        else {
            if(registrationStatus == "Accepted")toast.success(response.errorMsg);
            else toast.warning(response.errorMsg);
            
            loadRegistrationDataTable();
        }
    });
}

function deleteParticipantRegistration(){
    var ok = confirm("Are you want to delete those registration id");
    if(!ok)return;

    var registrationList = [];
    $("input[name='contestRegistrationList[]']:checked").each(function (index, obj) {
        registrationList.push(obj.value);
    });

    if(registrationList.length == 0){
        toast.danger("You can not select any row");
        return;
    }

    $.post(contestDashboardUrl, buildContestData("deleteParticipantRegistration",registrationList), function(response) {
        //console.log(response);
        response = JSON.parse(response);
        if(response.error == 1)toast.danger(response.errorMsg);
        else {
            toast.success("Successfully Delete Request");
            refreshTable();
        }
    });
}


function viewFileManager() {
    modal.lg.open("File Manager");
    loader(modal.lg.body);
    $.post(contestDashboardUrl, buildContestData("viewFileManager"), function(response) {
        modal.lg.setBody(response);
    });
}

function checkContestFreeze(e) {
    if (document.getElementById('contestFreezeArea').style.display == 'none') $('#contestFreezeArea').show(300);
    else $('#contestFreezeArea').hide(300);
}

function generateUser(){
    var userPrefix = $("#userPrefix").val();
    var passwordLength = $("#userPasswordLength").val();

    var data = {
        'userPrefix': userPrefix,
        'passwordLength': passwordLength,
        'generateUserList': generateUserList
    };

    $.post(contestDashboardUrl, buildContestData("generateUser",data), function(response) {
        response = JSON.parse(response);
        if(response.error == 0){
            toast.success(response.errorMsg);
        }
        else 
            toast.danger(response.errorMsg);
        $("#genResponse").html(response);
    });
}