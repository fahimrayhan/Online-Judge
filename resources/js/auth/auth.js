var auth = {
    loginPage: function(e) {
        new Modal("custom",450).load($(e).attr('url'), "Login", function(response) {});
    },
    login: function() {
        var form = new Form("login");

        form.submit("Login...", function(response) {
            new Modal().close();
            toast.success("Ok. Load Success");
        });
        //console.log(form.data(), form.action());
    },
    registrationPage: function(e) {
        new Modal("custom",500).load($(e).attr('url'), "Registration", function(response) {});
    },
    registration: function() {}
};
