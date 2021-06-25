var Contest = {
    create: function () {
        var form = new Form("create_contest");
        form.submit({
            loadingText: "Creating...",
            success: {
                resetForm: true,
                callback: function (response) {
                    url.load(response.url);
                    new Modal().close();
                }
            }
        });
    },
    update: function () {
        var form = new Form("updateContestForm");
        form.submit({
            loadingText: "updating...",
            success: {
                resetForm: true,
                callback: function (response) {
                    url.load();
                    // new Modal().close();
                }
            }
        });
    },
    loadFileBanner: function (event) {
        var output = document.getElementById('contestBannerPreview');
        if (!event.target.files[0]) {
            // output.src = $('#img-preview-default').attr('src');
        } else output.src = URL.createObjectURL(event.target.files[0]);

        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
    },

};
