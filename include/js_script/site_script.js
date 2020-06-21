
function buildData(keyName,val){
  val=!val?0:val;
  var data={};
  data[keyName]=val;
  return data;
}

function btnOff(btnId,txt){
  txt = !txt?"":txt;
	$("#"+btnId).attr("disabled", true);
	$("#"+btnId).html("<i class='fa fa-refresh fa-spin fa-1x fa-fw'></i> "+txt);
}

function btnOn(btnId,txt){
  txt = !txt?"":txt;
	$("#"+btnId).removeAttr("disabled");
	if(txt!="")
		$("#"+btnId).html(txt);
}

function loader(divId,size=130){
	imgSize="";
  	if(size!=0)imgSize="height: "+size+"px; width:"+size+"px";
  	imgUrl="src='file/site_metarial/loader.gif'";
  	imgStyle="style='margin-top:35px"+imgSize+"'";
  	img="<center><img "+imgStyle+imgUrl+" /></center>";
  	$("#"+divId).html(img);
}

function loader1(divId,size=300){
  imgSize="";
  if(size!=0)imgSize="height: "+size+"px; width:"+size+"px";
    imgUrl="src='file/site_metarial/loader2.gif'";
    imgStyle="style='margin-top:35px"+imgSize+"'";
    img="<center><img "+imgStyle+imgUrl+" /></center>";
    $("#"+divId).html(img);
}


// ===================================================

//start button

var btn = {
  off : function(btnId,txt){
    txt = !txt?"":txt;
    $("#"+btnId).attr("disabled", true);
    $("#"+btnId).html("<i class='fa fa-refresh fa-spin fa-1x fa-fw'></i> "+txt);
  },
  on : function(btnId,txt){
    $("#"+btnId).attr("disabled",false);
    if(txt)$("#"+btnId).html(txt);
  }
};

// ===================================================

// Start Modal Script

var modal = {
  lg : {
    open    : function(msg){modalOpen("lg",msg)},
    close   : function(){modalClose("lg")},
    body    : "modal_lg_body",
    setBody : function(txt){$("#"+this.body).html(txt)}
  },
  md : {
    open    : function(msg){modalOpen("md",msg)},
    close   : function(){modalClose("md")},
    body    : "modal_md_body",
    setBody : function(txt){$("#"+this.body).html(txt)}
  },
  sm : {
    open    : function(msg){modalOpen("sm",msg)},
    close   : function(){modalClose("sm")},
    body    : "modal_sm_body",
    setBody : function(txt){$("#"+this.body).html(txt)}
  }
};


function modalOpen(type,header){
  $("#modal_"+type).modal("show");
  $("#modal_"+type+"_header").html(header);
}

function modalClose(type){
  modal_action(type,"","close");
}

function modal_action(type,header="Header",permission="open"){
  if(type=="sm")modal_sm(permission,header);
  else if(type=="md")modal_md(permission,header);
  else if(type=="lg")modal_lg(permission,header);  
  error_div="modal_"+type+"_error";
  msg_div="modal_"+type+"_msg";
  document.getElementById(error_div).style.display="none";
  document.getElementById(msg_div).style.display="none";
}


function modal_sm(permission,header){
  modal_ob=$("#modal_sm");
  set_data("modal_sm_header",header);
  if(permission=="open")modal_ob.modal("show");
  else modal_ob.modal("hide");
}
function modal_md(permission,header){
  modal_ob=$("#modal_md");
  set_data("modal_md_header",header);
  if(permission=="open")modal_ob.modal("show");
  else modal_ob.modal("hide");
}

function modal_lg(permission,header){
  modal_ob=$("#modal_lg");
  set_data("modal_lg_header",header);
  if(permission=="open")modal_ob.modal("show");
  else modal_ob.modal("hide");
}

function set_data(div,data){
  document.getElementById(div).innerHTML=data;
}

// start toast script

var toast = {
  success : function(msg){makeToast("success",msg)},
  danger  : function(msg){makeToast("danger",msg)},
  info    : function(msg){makeToast("info",msg)},
  warning : function(msg){makeToast("warning",msg)}
};


function makeToast(toastType,toastMsg=""){
  var toastIconList={};
  toastIconList['success'] = 'check-circle';
  toastIconList['danger'] = 'times-circle';
  toastIconList['warning'] = 'exclamation-circle';
  toastIconList['info'] = 'info-circle';
  var toastIcon=toastIconList[toastType];

  var dom = '<div class="top-alert"><div class="alert alert-'+ toastType +'-alt alert-dismissable fade in " role="alert"><i class="fas fa-'+ toastIcon +' toast-icon"></i>'+ toastMsg +'<button type="button" class="toast-close" data-dismiss="alert" aria-label="Close">×</button></div></div>';
  var jdom = $(dom);
  jdom.hide();
  $("body").append(jdom);
  jdom.fadeIn();
  setTimeout(function() {
    jdom.fadeOut(function() {
      jdom.remove();
    });
  }, 2000);
}

// end toast script