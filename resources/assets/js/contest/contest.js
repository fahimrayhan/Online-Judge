var Contest = {
    create: function() {
        var form = new Form("create_contest");
        form.submit({
            loadingText: "Creating...",
            success: {
                resetForm: true,
                callback: function(response) {
                    url.load(response.url);
                    new Modal().close();
                }
            }
        });
    },
    update: function() {
        var form = new Form("updateContestForm");
        form.submit({
            loadingText: "Updating...",
            success: {
                resetForm: false,
                callback: function(response) {
                    // url.load();
                    // new Modal().close();
                }
            }
        });
    },
    loadFileBanner: function(event) {
        var output = document.getElementById('contestBannerPreview');
        if (!event.target.files[0]) {
            // output.src = $('#img-preview-default').attr('src');
        } else output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    },
    addProblem: function(e) {
        var problemSlug = prompt("Enter problem Slug");
        if (problemSlug == null) return;
        var addUrl = e.attr("url");
        var data = {
            'slug': problemSlug
        };
        $.post(addUrl, app.setToken(data), function(response) {
            url.load();
            toast.success(response.message);
        }).fail(function(error) {
            toast.danger("Problem Added Error");
        });
        // console.log(problemSlug);
    },
    removeProblem: function(e) {
        var ok = confirm("Are you want to remove problem");
        if (!ok) return;
        var removeUrl = e.attr("url");
        $.post(removeUrl, app.setToken(), function(response) {
            url.load();
            toast.success(response.message);
        });
        // console.log(problemSlug);
    },
    generateTempUser: function(e) {
        var form = new Form("generateTempUser");
        form.submit({
            loadingText: "Creating...",
            success: {
                resetForm: true,
                callback: function(response) {
                    url.load();
                    //new Modal().close();
                }
            }
        });
    },
    checkAllRegistrationList(e) {
        $("input[name='registrations[]']").attr('checked', e.checked);
    },
    updateParticipantRegistration: function(e) {
        var registrationList = [];
        $("input[name='registrations[]']:checked").each(function(index, obj) {
            registrationList.push(obj.value);
        });
        if (registrationList.length == 0) {
            alert("You can not select any row");
            return;
        }
        var ok = confirm("Are You Want " + e.attr('status') + " Registration");
        if (!ok) return;
        var data = {
            'user_list': registrationList,
            'status': e.attr('status')
        };
        $.post(e.attr("url"), app.setToken(data), function(response) {
            if (e.attr('status') == "Pending") toast.warning(response.message);
            else if (e.attr('status') == "Accepted") toast.success(response.message);
            else toast.danger(response.message);
            $("#checkAllRegistrationList").prop("checked", false);
            registrationDataTable.ajax.reload(null, false);
        });
    },
    contestTimer: 0,
    contestStatus: 0,
    setTimer: function(timer, status) {
        this.contestTimer = timer;
        this.contestStatus = status;
    },
    processTimer: function() {
        var start = $("#startcontesttimer").val();
        if(!start)return;
        if(this.contestTimer == 0)return;

        var timeDiffrent = this.contestTimer;
        timeDiffrent = timeDiffrent <= 0 ? 0 : timeDiffrent;
        hour = Math.floor(timeDiffrent / 3600);
        timeDiffrent -= hour * 3600;
        minute = Math.floor(timeDiffrent / 60);
        timeDiffrent -= minute * 60;
        second = timeDiffrent;
        if (hour < 10) hour = "0" + hour;
        if (minute < 10) minute = "0" + minute;
        if (second < 10) second = "0" + second;
        this.contestTimer --;
        $("#timerArea").html(hour + " : " + minute + " : " + second);
        if(this.contestTimer == 0){
            if(this.contestStatus == "running")alert("Contest Is End");
            else if(this.contestStatus == "upcomming")alert("Contest Is Start");
        }
    }
};


setInterval(function(){ Contest.processTimer(); }, 1000);
