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