var moderator = {
    aproveRequest : function (el) {
        var userId = el.attr('data-userId');
        var aproveUrl = el.attr('data-url');
        var data = {
            'userId' : userId
        };
        $.post(aproveUrl, app.setToken(data), function (response) {
            url.load();
            toast.success(response.message);
        });
    },
    deleteRequest : function (el) {
        var ok = confirm("Are You Want To Delete Moderator Request");
        if(!ok){
            return;
        }
        var userId = el.attr('data-userId');
        var deleteUrl = el.attr('data-url');
        var data = {
            'userId' : userId
        };
        $.post(deleteUrl, app.setToken(data), function (response) {
            url.load();
            toast.success(response.message);
        });
    },
    deleteModerator : function (el) {
        var ok = confirm("Are You Want To Delete Moderator");
        if(!ok){
            return;
        }
        var userId = el.attr('data-userId');
        var deleteUrl = el.attr('data-url');
        var data = {
            'userId' : userId
        };
        $.post(deleteUrl, app.setToken(data), function (response) {
            url.load();
            toast.success(response.message);
        });
    },
}