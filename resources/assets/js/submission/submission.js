var submission = {
    loadSubmissionPageId: -1,
    submissionPageSocketStart: 0,
    submissionPageSocketBusy: 0,
    openToggleSourceCode: false,
    submissionListForSocket: {},
    submissionListSocketBusy: false,
    setSubmissionPage: function(submissionId) {
        this.loadSubmissionPageId = submissionId;
        this.submissionPageSocketStart = 1;
        this.openToggleSourceCode = false;
    },
    loadSubmissionData: function() {
        if (this.submissionPageSocketStart == 0) return;
        this.submissionPageSocketBusy = 1;
        submissionId = this.loadSubmissionPageId;
        $.get('/api/submission_verdict/' + submissionId, function(response) {
            $("#submission_time_" + response.id).html(response.time + " ms");
            $("#submission_memory_" + response.id).html(response.memory + " kb");
            $("#submission_verdict_" + response.id).html(response.verdict_status);
            $.each(response.test_cases, function(key, value) {
                $("#submission_test_case_verdict_" + value.id).html(value.verdict_status);
                $("#submission_test_case_time_" + value.id).html(value.time + " ms");
                $("#submission_test_case_memory_" + value.id).html(value.memory + " kb");
                $("#submission_test_case_point_" + value.id).html(value.passed_point);
                $("#submission_test_case_input_" + value.id).html(value.input);
                $("#submission_test_case_output_" + value.id).html(value.output);
                $("#submission_test_case_expected_output_" + value.id).html(value.expected_output);
                $("#submission_test_case_checker_log_" + value.id).html(value.checker_log);
                $("#submission_test_case_compiler_log_" + value.id).html(value.compiler_log);
                if (value.verdict_id <= 2) return false;
                if (value.verdict_id == 6 || value.verdict_id == 7) {
                    $("#submission_test_case_checker_log_area_" + value.id).hide();
                } else {
                    $("#submission_test_case_compiler_log_area_" + value.id).hide();
                }
                if (value.verdict_id >= 3 && value.verdict_id != 16) {
                    $("#view_test_case_btn_area_" + value.id).show();
                }
            });
            submissionPageSocketBusy = 0;
            if (response.verdict_id >= 3) submission.submissionPageSocketStart = 0;
        }).fail(function(error) {
            submissionPageSocketBusy = 0;
        });
    },
    viewTestCaseDetail: function(e) {
        serial = $(e).attr("serial");
        var testCaseDiv = $("#submission_test_case_detail_area_" + serial);
        if (testCaseDiv.css('display') == 'none') {
            testCaseDiv.show(50);
            $("#view_test_case_btn_" + serial).removeClass('fa fa-angle-double-down');
            $("#view_test_case_btn_" + serial).addClass('fa fa-angle-double-up');
            if (testCaseDiv.html() == "") {
                (new Div(testCaseDiv)).load({
                    url: $(e).attr("url"),
                    loader: 'div',
                    data: {
                        test_case_id: serial
                    }
                });
            }
        } else {
            testCaseDiv.hide();
            $("#view_test_case_btn_" + serial).removeClass('fa fa-angle-double-up');
            $("#view_test_case_btn_" + serial).addClass('fa fa-angle-double-down');
        }
    },
    copySourceCode: function() {
        this.openToggleSourceCode = false;
        this.toggleSourceCode();
        var copyText = document.getElementById("sourceCodeTextArea");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
        toast.info("Copied Source Code");
    },
    toggleSourceCode: function() {
        var openToggleDiv = this.openToggleSourceCode ? "sourceCodeText" : "sourceCodeTextArea";
        var closeToggleDiv = this.openToggleSourceCode ? "sourceCodeTextArea" : "sourceCodeText";
        $("#" + openToggleDiv).show();
        $("#" + closeToggleDiv).hide();
        this.openToggleSourceCode ^= 1;
    },
    filter: function(base) {
        var data = {};
        var verdict = $("#submission-filter-verdict").val();
        if (verdict) data['verdict'] = verdict;
        var language = $("#submission-filter-language").val();
        if (language) data['language'] = language;
        var handle = $("#submission-filter-handle").val();
        if (handle) data['handle'] = handle;

        var problem = $("#submission-filter-problem").val();
        if (problem) data['problem'] = problem;


        base = base.replace(/\?.*$/, "") + "?" + jQuery.param(data);
        url.load(base);
    },
    updateSubmissionListSocket: function() {
        if (this.submissionListForSocket.length == 0) return;
        if (this.submissionListSocketBusy == true) return;
        this.submissionListSocketBusy = true;
        var data = {
            'submission_list': JSON.stringify(this.submissionListForSocket)
        };
        console.log("soket start");
        $.post("/api/submission_verdict", app.setToken(data), function(response) {
            console.log(response);
            $.each(response, function(key, submissionValue) {
                $("#submission_" + submissionValue.id + "_time").html(submissionValue.time + " ms");
                $("#submission_" + submissionValue.id + "_memory").html(submissionValue.memory + " kb");
                $("#submission_" + submissionValue.id + "_verdict").html(submissionValue.verdict_label);
                if (submissionValue.verdict_id >= 3) {
                    const index = submission.submissionListForSocket.indexOf(submissionValue.id);
                    if (index > -1) submission.submissionListForSocket.splice(index, 1);
                }
            });
            submission.submissionListSocketBusy = false;
        }).fail(function(error) {
            submission.submissionListSocketBusy = false;
        });
    }
};

var pusherAppKey = atob($('meta[name="PAK"]').attr('content'));
var pusher = new Pusher(pusherAppKey, {
    cluster: 'mt1'
});

var channel = pusher.subscribe('submission-channel');
channel.bind("submission-event", function(data) {
    //    data = JSON.parse(data);
    data = JSON.parse(data.message);
    submissionData = data.submission;
    $("#submission_" + submissionData.id + "_time").html(submissionData.time + " ms");
    $("#submission_" + submissionData.id + "_memory").html(submissionData.memory + " kb");
    $("#submission_" + submissionData.id + "_verdict").html(submissionData.verdict_label);
    $("#submission_view_" + submissionData.id + "_time").html(submissionData.time + " ms");
    $("#submission_view_" + submissionData.id + "_memory").html(submissionData.memory + " kb");
    $("#submission_view_" + submissionData.id + "_verdict").html(submissionData.verdict_label);
    $.each(data.testcases, function(key, testcase) {
        setTestCase(testcase);
    });
});

function setTestCase(value) {
    $("#submission_test_case_verdict_" + value.id).html(value.verdict_status);
    $("#submission_test_case_time_" + value.id).html(value.time + " ms");
    $("#submission_test_case_memory_" + value.id).html(value.memory + " kb");
    $("#submission_test_case_point_" + value.id).html(value.passed_point);
    if (value.verdict_id >= 3 && value.verdict_id != 16) {
        $("#view_test_case_btn_area_" + value.id).show();
    }
}