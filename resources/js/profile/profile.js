var profile = {

    changePassword: function() {
        new Form("change_password").submit({
            loadingText: "Changing Password...",
            success: {
                resetForm: true,
            }
        });
        //console.log(form.data(), form.action());
    },
    changeName: function() {
        new Form("change_name").submit({
            loadingText: "Changing Name...",
            success: {
                resetForm: false,
            }

        });
        //console.log(form.data(), form.action());
    },
};