var userActionUrl="user_action.php";
var profilePhotoInfo = -1;

$(document).ready(function() {

    $(document).on('change', '#file', function() {
        profilePhotoInfo = document.getElementById("file").files[0].name;
    });


});


var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('add_profile_pic');
            output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};

function uploadProfilePhoto(){

	if (profilePhotoInfo == -1) {
        toast.danger("Please Select Photo")
        return;
    }

    var name = profilePhotoInfo;
    var formData = new FormData();
    var ext = name.split('.').pop().toLowerCase();

    if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        toast.danger("Invalid Image File");
        return;
    }

    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("file").files[0]);
    var f = document.getElementById("file").files[0];
    var fsize = f.size || f.fileSize;

    if (fsize > 2000000) {
        toast.danger("Image File Size is very big");
        return;
    }

    formData.append("file", document.getElementById('file').files[0]);
    

    $.ajax({
        url: userActionUrl,
        method: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,

        beforeSend: function() {
            btnOff("updateProfilePhotoBtn","Uploading...");
        },

        success: function(data) {
           //console.log(data);
           toast.success("Successfully Update Profile Picture");
           window.location.href = "";

        }

    });

}


function updateProfilePhotoForm(){
	modal_action("sm","Update Profile Photo");
	loader("modal_sm_body");
	$.post(userActionUrl,buildData("updateProfilePhotoForm"),function(response){
		$("#modal_sm_body").html(response);
	});
}

function updateProfileInfoForm(){
	modal_action("sm","Update Profile Info");
	loader("modal_sm_body");
	$.post(userActionUrl,buildData("updateProfileInfoForm"),function(response){
		$("#modal_sm_body").html(response);
	});
}



function updateProfileInfo(){
    var userFullName=$("#userFullName").val();
    if(userFullName==""){
        toast.danger("Please Enter Your Full Name");
        return;
    }
	var data={
        'userFullName': userFullName,
        'instituteName': $("#instituteName").val()
    }
    btnOff("updatePassBtn","Saving");
    $.post(userActionUrl,buildData("updateProfileInfo",data),function(response){
        //$("#modal_sm_body").html(response);
        toast.success("Profile Successfully Update.");
        window.location.href = "";
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
	
	$.post(userActionUrl,buildData("UpdatePassword",data),function(response){
		
		//$("#errorLog").html(response);
		//console.log(response);
		response=JSON.parse(response); 
		if(response.error==1){
			
            toast.danger(response.msg);
			btnOn("updatePassBtn","Update Password");
		}
		else{
            toast.success(response.msg);
			btnOn("updatePassBtn","Update Password");
		}
			
	});
}