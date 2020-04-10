function copyUrl(containerid){
	var elt = document.getElementById(containerid);
    if (document.selection) { // IE

        if(elt.nodeName.toLowerCase() === "input"){
            document.getElementById(containerid).select();
            document.execCommand("copy");
        }else{
            var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById(containerid));
            range.select();
            document.execCommand("copy");
        } 

    } else if (window.getSelection) {
        
        if(elt.nodeName.toLowerCase() === "input"){
            document.getElementById(containerid).select();
            document.execCommand("copy");
        }else{
            debug("hello");
            var range_ = document.createRange();
            debug(range_);
            range_.selectNode(document.getElementById(containerid));
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range_);
            document.execCommand("copy");
    }
    }
    return;
    var btnTxt="#btnCopy_"+containerid;
    $(btnTxt).toggleClass('btn-primary btn-success');
    $(btnTxt).html("<i class='fas fa-clipboard-check'></i> Copied");
    setTimeout(function(){ 
    	$(btnTxt).html("<i class='fas fa-copy'></i> Copy Url");
    	$(btnTxt).toggleClass('btn-success btn-primary');
     }, 700);
   

}

function debug(txt){
	console.log(txt);
}