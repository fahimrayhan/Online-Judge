var Form = function(form) {
    var self = this;
    this.form = (form instanceof jQuery) ? form : $("#" + form);
    this.submitButton = new Button($("button[type=submit]", this.form));
    this.data = function() {
        return this.form.serialize();
    };
    this.action = function() {
        return this.form.attr('action');
    };
    this.submit = function(btnText, callback) {
        this.submitButton.off("<i class='fa fa-refresh fa-spin fa-1x fa-fw'></i>" + btnText);
        console.log(this.action());
        $.post(this.action(),this.data(), function(response) {
            console.log(response);
           // var data = "hey";
           if ($.isFunction(callback)) callback(response);
           self.submitButton.on();
        });
    }
}