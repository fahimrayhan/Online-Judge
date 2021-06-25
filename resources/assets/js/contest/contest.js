var Contest = {
	create: function() {
        var form = new Form("create_contest");
        form.submit({
            loadingText: "Creating...",
            success: {
                resetForm: true,
                callback: function(response) {
                    url.load(response.url);
                    new Modal().close();
                }
            }
        });
    },
};
