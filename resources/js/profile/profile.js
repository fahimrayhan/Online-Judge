var profile = {

    changePassword: function() {
        new Form("change_password").submit({
            loadingText: "Changing Password...",
            success: {
                callback: function(response) {
                    if(!response['error']){
                        toast.success(response['message']);
                    }
                    else{
                        toast.danger(response['message']);
                    }
                    
                }
            }
        });
        //console.log(form.data(), form.action());
    },
};