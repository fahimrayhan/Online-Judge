var problem = {
    create: function() {
        var form = new Form("create_problem");
        form.submit({
            loadingText: "creating...",
            success: {
                resetForm: true,
                callback: function() {
                    alert("ok");
                }
            }
        });
    },
    editor: function(problemData) {
        console.log(problemData);
        problemDetailsEditor.setEditor(problemData);
    },
    detailsUpadte: function(actionUrl) {
        var data = problemDetailsEditor.getEditorData();
        data['name'] = $("#problem_name").val();
        var btn = new Button("update-problem-details");
        btn.off("Updating....");
        $.post(actionUrl, app.setToken(data), function(response) {
            toast.success("Updated Details");
            btn.on();
        });
    },
    preview: function(e) {
        new Modal("custom", 750).load($(e).attr('url'), "Preview Problem", function(response) {});
    },
    copyTestCase: function(e){
        copyer(e.value);
        toast.info("The example has been copied into the clipboard");
    }
};
var testCase = {
    selectInputType: function(e) {
        var type = e.value;
        $("#testCaseInputEditorArea").hide();
        $("#testCaseInputUploadArea").hide();
        if (type == "editor") $("#testCaseInputEditorArea").show();
        if (type == "upload") $("#testCaseInputUploadArea").show();
    },
    selectOutputType: function(e) {
        var type = e.value;
        $("#testCaseOutputEditorArea").hide();
        $("#testCaseOutputUploadArea").hide();
        if (type == "editor") $("#testCaseOutputEditorArea").show();
        if (type == "upload") $("#testCaseOutputUploadArea").show();
    },
    setInputEditorLimit: function(e) {
        var editorVal = $('#testCaseInput').val();
        var maxLen = 5000;
        var txtLen = editorVal.length;
        if (txtLen >= maxLen) {
            alert("Input File Is To Large. If You Need Large Input You Try Upload Option.");
        }
    },
    setOutputEditorLimit: function(e) {
        var editorVal = $('#testCaseOutput').val();
        var maxLen = 5000;
        var txtLen = editorVal.length;
        if (txtLen >= maxLen) {
            alert("Output File Is To Large. If You Need Large Output You Try Upload Option.");
        }
    },

    updateSample: function(e){
        var sample = $(e).prop("checked") == true ? 1 : 0;
        var data = {
            'sample': sample
        };
        $.get($(e).attr('name'),data, function(response) {
            toast.success(response.message);
        });
    },
    addTestCase: function() {
        new Form("add_test_case").submit({
            loadingText: "Saving...",
            success: {
                callback: function(response) {
                    new Modal().close();
                    url.load();
                }
            }
        });
    },
    updateTestCase: function() {
        new Form("update_test_case").submit({
            loadingText: "Saving...",
            success: {
                callback: function(response) {
                    new Modal().close();
                    url.load();
                }
            }
        });
    },
    delete: function(e) {
        var ok = confirm("Are you want to delete this test case");
        if (!ok) return;
        $.get($(e).attr('url'), function(response) {
            toast.success(response.message);
            url.load();
        });
    },
    
}