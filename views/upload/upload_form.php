<style type="text/css">
	.uploadForm{
		height: 400px;
		border: 2px dashed #D1D1D1;
		text-align: center;
		padding-top: 10px;
	}
	.uploadImg{
		height: 300px;
		width: 300px;
		padding: 15px;
	}
	.inputArea{
		text-align: center;
		margin-top: 5px;
	}
	.uploadFileInfo{
		margin-top: 25%;
		font-weight: bold;
		font-size: 18px;
	}
	.fileInfoCls{
		color: red;
	}
</style>

<div class="row">
	<div class="col-md-5" style="padding: 20px 10px 10px 40px;">
		<div class="uploadForm">
			<img id="uploadImg" src="https://pngimage.net/wp-content/uploads/2018/06/image-file-icon-png-4.png" class=" uploadImg">
			<div class="inputArea"><center><input type="file" name="file" id="file" onchange="loadFile(event)"  /></center></div>
		</div>
		
	</div>
	<div class="col-md-7">
		<div class="uploadFileInfo">
			File Name: <span class="fileInfoCls" id="uploadFileName"></span><br/>
			File Type: <span class="fileInfoCls" id="uploadFileType"></span><br/>
			File Size: <span class="fileInfoCls" id="uploadFileSize"></span><br/>
			<button style="width: 140px;" id="updatePhotoBtn" onclick="uploadPhoto()">Upload</button>
		</div>
	</div>
</div>