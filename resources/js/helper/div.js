function formPrevent() {
    $('form').on('submit', function(e) {
        e.preventDefault();
    });
}

function Div(div) {
    var self = this;
    this.div = (div instanceof jQuery) ? div : $("#" + div);
    this.defaultLoad = function() {
        formPrevent();
    };
    this.load = function(data, callback) {
        if ($.isPlainObject(data)) {
            this.url = data.url;
            this.loader = data.loader;
            this.changeUrl = data.changeUrl;
            this.data = data.data;
        }
        this.url = !this.url ? "" : this.url;
        this.loader = !this.loader ? "div" : this.loader;
        this.changeUrl = !this.changeUrl ? false : this.changeUrl;
        
        if (this.loader == "div") loader.div(this.div);
        else loader.top.start();

        if(this.changeUrl){
            url.change("","",this.url);
        }

        var requestData = $.isPlainObject(this.data) ? this.data : {};
        requestData['ajax_layout_load'] = app.layoutkey;

        $.get(this.url, requestData , function(response) {
            if(this.changeUrl)document.title = $(response).filter('title').text();
            self.div.html(response);
            self.defaultLoad();
            if ($.isFunction(callback)) callback(response);
        }).fail(function(error) {
            if (error.status == 500) {
                alert("Error Found\n");
                location.reload();
            } else {
                self.div.html(error.responseText);
                toast.danger(error.status + " Error Found");
            }
        });
    }
}
