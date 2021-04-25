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
    editor: function(problemData){
        console.log(problemData);
        problemDetailsEditor.setEditor(problemData);
    },
    detailsUpadte: function(actionUrl){
        var data = problemDetailsEditor.getEditorData();
        data['name'] = $("#problem_name").val(); 
        var btn = new Button("update-problem-details");
        btn.off("Updating....");
        $.post(actionUrl, app.setToken(data), function (response) {
            toast.success("Updated Details");
            btn.on();
        });
    },
    preview: function(e){
        new Modal("custom", 750).load($(e).attr('url'), "Preview Problem", function(response) {});
    },
};

var testCase = {
    testCaseData : {
        input : "",
        output: ""
    },

    updateField: function(e){
        if(e.id == "testCaseInput")this.testCaseData.input = e.value;
        else this.testCaseData.output = e.value;
    },
    selectType : function(e){
        var type = e.value;
        this.outputEditorType = type;
        $("#testCaseOutputEditorArea").hide();
        $("#testCaseOutputUploadArea").hide();
        $("#testCaseOutputUrlArea").hide();
        if(type == "editor")$("#testCaseOutputEditorArea").show();
        if(type == "upload")$("#testCaseOutputUploadArea").show();
        if(type == "url")$("#testCaseOutputUrlArea").show();
    },
    uploadFile: function(e){
        var reader = new FileReader();
        console.log(reader);
        reader.onload = function(){
            $.get(reader.result, function(data) {
                //uploadOutputData = data;
                console.log(data);
            }, "text");
        };
        if(e.target.files[0]){
            reader.readAsDataURL(e.target.files[0]);
        }
    },

    addTestCase: function(){
        console.log(this.testCaseData);
    }
    
}