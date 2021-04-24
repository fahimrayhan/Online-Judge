var profile = {

    changePassword: function() {
        new Form("change_password").submit({
            loadingText: "Changing Password...",
            success: {
                callback: function(response) {
                    url.load();
                    toast.success("Password Changed");
                }
            }
        });
        //console.log(form.data(), form.action());
    },
};