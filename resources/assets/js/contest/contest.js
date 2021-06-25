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
            loadingText: "Updating...",
            success: {
                resetForm: false,
                callback: function (response) {
                   // url.load();
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
    addProblem: function (e) {
        var problemSlug = prompt("Enter problem Slug");
        if (problemSlug == null) return;
        var addUrl = e.attr("url");
        var data = {
            'slug': problemSlug
        };
        $.post(addUrl, app.setToken(data), function (response) {
            url.load();
            toast.success(response.message);
        }).fail(function(error) {
            toast.danger("Problem Added Error");
        });
        // console.log(problemSlug);
    },
    removeProblem: function (e) {
        var ok = confirm("Are you want to remove problem");
        if (!ok) return;
        var removeUrl = e.attr("url");
        $.post(removeUrl, app.setToken(), function (response) {
            url.load();
            toast.success(response.message);
        });
        // console.log(problemSlug);
    },
};
