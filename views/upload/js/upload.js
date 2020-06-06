var uploadUrl="upload_action.php";
var uploadPhotoInfo = {name: null,type: null,size: null};

$(document).ready(function() {

    $(document).on('change', '#file', function() {
        setUploadPhotoInfo();
        setFileInfoField();
    });
    loadUploadPhotoArea();

});


var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('uploadImg');
        output.src = reader.result;
        
    };
    if(event.target.files[0]){
      reader.readAsDataURL(event.target.files[0]);
    }
    
};

function copyFilePath(filePath) {
  var copyText = document.getElementById(filePath);
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  toast.info("Copied File Path");
}


function setUploadPhotoInfo(){
    fileInfo = document.getElementById("file").files[0];
    uploadPhotoInfo.name = fileInfo.name;
    uploadPhotoInfo.type = fileInfo.name.split('.').pop().toLowerCase();
    uploadPhotoInfo.size =  fileInfo.size || fileInfo.fileSize;
    console.log(uploadPhotoInfo);

}

function setFileInfoField(){
    
    $("#uploadFileName").html(uploadPhotoInfo.name);
    $("#uploadFileType").html(uploadPhotoInfo.type);
    $("#uploadFileSize").html((uploadPhotoInfo.size/1000).toFixed(1)+" KB");
}


function uploadPhoto(){

    if (uploadPhotoInfo.size == null) {
        toast.danger("Please Select Photo")
        return;
    }

    if (jQuery.inArray(uploadPhotoInfo.type, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        toast.danger("Invalid Image File");
        return;
    }

    if (uploadPhotoInfo.size > 2000000) {
        toast.danger("Image File Size is very big");
        return;
    }

    var formData = new FormData();
    formData.append("file", document.getElementById('file').files[0]);
    

    $.ajax({
        url: uploadUrl,
        method: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,

        beforeSend: function() {
            btnOff("updatePhotoBtn","Uploading...");
        },

        success: function(data) {
           //console.log(data);

           toast.success("Successfully Uploaded New File");
           loadImageList();

        }

    });

}


function loadUploadPhotoArea(){
    loader("uploadPhotoArea");
    $.post(uploadUrl,buildData("loadUploadPhotoArea"),function(response){
        $("#uploadPhotoArea").html(response);
    });
}

function deleteUploadPhoto(filePath){
    var ok=confirm('Are You Want To Delete This File.');
    if(!ok)return;
    loader("uploadPhotoArea");
    $.post(uploadUrl,buildData("deleteUploadPhoto",filePath),function(response){
        toast.success("Photo Delete Successfully");
        loadImageList();
    });
}

function loadImageList(){
    loader("uploadPhotoArea");
    $.post(uploadUrl,buildData("loadImageList"),function(response){
        $("#uploadPhotoArea").html(response);
    });
}

function debug(){
	$.getScript( "views/upload/js/test_fun.js", function( data, textStatus, jqxhr ) {
        console.log( data ); // Data returned
        console.log( textStatus ); // Success
        console.log( jqxhr.status ); // 200
        console.log( "Load was performed." );
        testFun();
        toast.success("Working");
    });
}

