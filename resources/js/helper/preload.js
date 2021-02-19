var Preload = function() {
    var self = this;
    this.preLoadData = [{
        url: "/modal",
        div: "modal-area"
    }, {
        url: url.get(),
        div: "body"
    }, ];
    this.isComplete = false;
    this.state = 0;

    this.start = function(state){
        if (state == this.preLoadData.length) {
            this.complete();
            return;
        }
        console.log(this.preLoadData[state].div);
        new Div(this.preLoadData[state].div).load({
            url: this.preLoadData[state].url
        }, function() {
            self.setLoadingText(state + 1);
            self.start(state + 1);
        })
    }

    this.setLoadingText = function(complete) {
        txt = Math.ceil((100 * complete) / this.preLoadData.length);
        $("#loadingTxt").html("Loading " + txt + "%");
    }

    this.complete = function() {
        $('#pre-loader').html("");
        $('#body-area').show();
    }

}

$(document).ready(function() {
    setTimeout(function() {
        //new Preload().start(0);
    }, 300);
});


//single page load
$(document).ready(function() {
    $('body').on('click', 'a', function(e) {
        var self = $(this);
        var link = $(this).attr("href");
        if (link.indexOf(document.domain) >= 0) {
            if ($(this).attr("logout-btn")) return;
            e.preventDefault();
            url.load(link,function(response){
                // function we want to run
                console.log(self.attr("callback"))
                if(self.link != url.get())$(window).scrollTop(0);
                
                if (self.attr("callback")){
                    //eval(self.attr("callback"));
                }
            });
        } else {
            e.preventDefault();
            window.open(link, '_blank');
        }
    });
    $(window).on('popstate', function(event) {
        url.load(url.get(),function(response){
           //var box = document.getElementById('body');
          // box.scrollTop = box.scrollHeight;
           console.log("hey");
        });
    });
});