var userActionUrl="user_action.php";

function updateProfileInfoForm(){
	modal_action("md","Add Test Case");
	loader("modal_md_body");
	$.post(userActionUrl,buildData("updateProfileInfoForm",userId),function(response){
		$("#modal_md_body").html(response);
	});

}

function updatePasswordForm(){
	modal_action("sm","Update Password");
	loader("modal_sm_body");
	$.post(userActionUrl,buildData("updatePasswordForm",userId),function(response){
		$("#modal_sm_body").html(response);
	});
}

function updatePassword(){
	var data={
		'oldPass': $("#oldPass").val(),
		'newPass': $("#newPass").val()
	}
	btnOff("updatePassBtn","Saving");
	$("#errorLog").hide();
	$.post(userActionUrl,buildData("UpdatePassword",data),function(response){
		$("#errorLog").show();
		//$("#errorLog").html(response);
		//console.log(response);
		response=JSON.parse(response); 
		if(response.error==1){
			$('#errorLog').removeClass('label-success').addClass('label-danger');
			$("#errorLog").show();
			$("#errorLog").html(response.msg);
			btnOn("updatePassBtn","Update Password");
		}
		else{
			$('#errorLog').removeClass('label-danger').addClass('label-success');
			$("#errorLog").show();
			$("#errorLog").html(response.msg);
			btnOn("updatePassBtn","Update Password");
		}
			
	});
}