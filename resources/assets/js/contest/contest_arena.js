var ContestArena = {
    announcementAlert: function(data) {
    	data = JSON.parse(data.message);
    	if($('meta[name="contest-key"]').attr('content') == data.contest_key){
        	alert("Announcement\n-------------\n" + data.announcement);
    	}
    },
    connectWebsocket: function() {
        Websocket.event("contest-arena", "announcement", function(response) {
            ContestArena.announcementAlert(response);
        });
    }
};
ContestArena.connectWebsocket();