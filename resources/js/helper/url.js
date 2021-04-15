var url = {
    get: function() {
        var newUrl = window.location.href;
        return (newUrl.substr(newUrl.length - 1) == "/") ? newUrl.slice(0, -1) : newUrl;
    },
    getWithoutParameter: function(){
        var newUrl = location.host + location.pathname;
        return (newUrl.substr(newUrl.length - 1) == "/") ? newUrl.slice(0, -1) : newUrl;
    },
    change: function(data, title, url) {
        if (this.get() != url) history.pushState(data, title, url);
    },
    load: function(url,callback) {
        new Div("app-body").load({
            url: url,
            loader: "top",
            changeUrl: true,
            scrapeArea: 'app-body'
        }, function(response) {
            document.title = $(response).filter('title').text();
            if ($.isFunction(callback)) callback(response);
        });
    },
};