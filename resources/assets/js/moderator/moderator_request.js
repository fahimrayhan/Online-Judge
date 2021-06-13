var moderator = {
    aproveRequest : function (el) {
        var aproveUrl = el.attr('data-url');
        $.post(aproveUrl, app.setToken(), function (response) {
            url.load();
            toast.success(response.message);
        });
    },
    deleteRequest : function (el) {
        var ok = confirm("Are You Want To Delete Moderator Request");
        if(!ok){
            return;
        }
        var deleteUrl = el.attr('data-url');
        $.post(deleteUrl, app.setToken(), function (response) {
            url.load();
            toast.success(response.message);
        });
    },
    deleteModerator : function (el) {
        var ok = confirm("Are You Want To Delete Moderator");
        if(!ok){
            return;
        }
        var deleteUrl = el.attr('data-url');
        $.post(deleteUrl, app.setToken(), function (response) {
            url.load();
            toast.success(response.message);
        });
    },
}