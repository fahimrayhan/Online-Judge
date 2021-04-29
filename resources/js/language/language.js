var language = {
    create: function() {
        var form = new Form("create_language");
        form.submit({
            loadingText: "creating...",
            success: {
                resetForm: true,
            }
        });
    },
};
