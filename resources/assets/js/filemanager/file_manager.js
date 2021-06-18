var fileManager = {
    uploadPhotoInfo: {
        name: null,
        type: null,
        size: null
    },
    ckeditor: "",
    selectImg: function(editor) {
        this.ckeditor = editor;
        new Modal('lg').load('/administration/filemanager/galery','File Manager')
    },
    loadDiv: function(targetUrl) {
        new Div("uploadPhotoArea").load({
            url: targetUrl,
            loader: "div",
            changeUrl: false,
            scrapeArea: 'uploadPhotoArea'
        });
    },
    loadUploadPhotoArea: function(e) {
        this.loadDiv($(e).attr('url'));
    },
    setFileInfoField: function() {
        $("#uploadFileName").html(this.uploadPhotoInfo.name);
        $("#uploadFileType").html(this.uploadPhotoInfo.type);
        $("#uploadFileSize").html((this.uploadPhotoInfo.size / 1000).toFixed(1) + " KB");
    },
    setUploadPhotoInfo: function setUploadPhotoInfo() {
        fileInfo = document.getElementById("file").files[0];
        this.uploadPhotoInfo.name = fileInfo.name;
        this.uploadPhotoInfo.type = fileInfo.name.split('.').pop().toLowerCase();
        this.uploadPhotoInfo.size = fileInfo.size || fileInfo.fileSize;
        this.setFileInfoField();
        // console.log(this.ploadPhotoInfo);
    },
    loadFile: function(event) {
        this.upload();
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('uploadImg');
            output.src = reader.result;
        };
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
        this.setUploadPhotoInfo();
        // console.log(this.uploadPhotoInfo);
    },
    upload: function() {
        // var uploadUrl = e.attr('url');
        var formData = new FormData();
        new Form("upload_image").submit({
            loadingText: "uploading..",
            success: {
                resetForm: true,
                callback: function(response) {
                    new Div("uploadPhotoArea").load({
                        url: response.url,
                        loader: "div",
                        changeUrl: false,
                        scrapeArea: 'uploadPhotoArea'
                    });
                }
            }
        });
    },
    loadGalleryArea: function(e) {
        this.loadDiv($(e).attr('url'));
    },
    copyFilePath: function(filePath) {
        var copyText = document.getElementById(filePath);
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
        toast.info("Copied File Path");
        var fileName = $("#filePath").val();
        console.log(fileName);
        return;
        
    },
    selectEditor: function(fileName){
        console.log(fileName);
        this.ckeditor.insertHtml('<img alt="" height="568" src="'+fileName+'" width="1283" />');
        new Modal("md").close();
    },
    delete: function(e) {
        console.log("Hello");
        var deleteUrl = e.attr('url');
        $.post(deleteUrl, app.setToken(), function(response) {
            toast.success(response.message);
            new Div("uploadPhotoArea").load({
                url: response.url,
                loader: "div",
                changeUrl: false,
                scrapeArea: 'uploadPhotoArea'
            });
        });
    }
}