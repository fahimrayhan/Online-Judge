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
    setTestCase: function(value) {
        $("#submission_test_case_verdict_" + value.id).html(value.verdict_status);
        $("#submission_test_case_time_" + value.id).html(value.time + " ms");
        $("#submission_test_case_memory_" + value.id).html(value.memory + " kb");
        $("#submission_test_case_point_" + value.id).html(value.passed_point);
        if (value.verdict_id >= 3 && value.verdict_id != 16) {
            $("#view_test_case_btn_area_" + value.id).show();
        }
    },
    updateSubmissionData: function(data) {
        data = JSON.parse(data.message);
        submissionData = data.submission;
        $("#submission_" + submissionData.id + "_time").html(submissionData.time + " ms");
        $("#submission_" + submissionData.id + "_memory").html(submissionData.memory + " kb");
        $("#submission_" + submissionData.id + "_verdict").html(submissionData.verdict_label);
        $("#submission_view_" + submissionData.id + "_time").html(submissionData.time + " ms");
        $("#submission_view_" + submissionData.id + "_memory").html(submissionData.memory + " kb");
        $("#submission_view_" + submissionData.id + "_verdict").html(submissionData.verdict_label);
        $.each(data.testcases, function(key, testcase) {
            submission.setTestCase(testcase);
        });
    },
    
};

Websocket.event("submission-channel", "submission-event", function(data) {
    submission.updateSubmissionData(data);
});
