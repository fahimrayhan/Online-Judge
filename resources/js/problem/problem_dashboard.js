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
        problemDetailsEditor.setEditor(problemData);
    }
};