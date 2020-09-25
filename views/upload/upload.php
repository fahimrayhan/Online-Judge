
<?php 
	if($DB->userRole>30){
		include "404.php";
		return;
	}

?>

<script type="text/javascript" src="views/upload/js/upload.js"></script>

<style type="text/css">
	.uploadImage{
		height: 200px;
		width: 100%;
	}
	.uploadImgBox{
		margin-bottom: 15px;
		border-radius: 0px;
		background: #ffffff;
		border: 1px solid #d5e0ea;
	}
	.uploadBtnArea{
		text-align: center;
		margin-top: 10px;
	}

	.uploadPanelTab{
        background-color: #ffffff;
        border: 1px solid #E7ECF1;
        min-width: 120px;
        padding: 12px;
        font-weight: bold;
        text-align: center; 
        margin-right: 2px;
    }
    .uploadPanelTab:hover{
    	cursor: pointer;
        background: #f5f5f5;
    }
    .welcomeInfo{
        font-family: New Century Schoolbook, serif;
    }

</style>

<div class="row">
	<div class="col-md-12">
        <div class="welcomeInfo">
        <ul class="nav nav-tabs">
            <li class="nav-item uploadPanelTab" onclick="loadUploadPhotoArea()">
                   Upload Photo
            </li>
            <li class="nav-item uploadPanelTab" onclick="loadImageList()">
                Photo Gallery
            </li>
        </ul>
        <div id="uploadPhotoArea" class="boxx box_body" style="min-height: 480px;border-radius: 0px">
        </div>
        </div>
    </div>
</div>


