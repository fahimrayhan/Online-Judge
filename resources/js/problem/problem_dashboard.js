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
    }
};