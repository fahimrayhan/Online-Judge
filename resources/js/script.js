    
$(document).ready(function() {
    formPrevent();
});

function isFunction(possibleFunction) {
    return typeof(possibleFunction) === typeof(Function);
}


var loader = {
    top : {
        start: function(){
            $("#top-loader").show();
        },
        stop: function(){
            $("#top-loader").hide();
        }
    },
    div: function(div){
        div = (div instanceof jQuery) ? div : $("#" + div);
        div.html('<div style="text-align: center;"><img style="top: 30%;height: 100px; width: 100px;" src="https://retchhh.files.wordpress.com/2015/03/loading4.gif"></div>');
    }
}

function formPrevent() {
    $('form').on('submit', function(e) {
        // validation code here
        e.preventDefault();
    });
}
var app = {
    'name': $('meta[name="app-name"]').attr('content'),
    'token': $('meta[name="csrf-token"]').attr('content'),
    'layoutkey': $('meta[name="layout-key"]').attr('content'),
    setToken: function(data) {
        data = !data ? {} : data;
        data['_token'] = this.token;
        return data;
    }
};

