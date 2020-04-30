<title>Upload - CoderOJ</title>
<script type="text/javascript" src="views/upload/js/upload.js"></script>

<style type="text/css">
	.uploadImage{
		height: 200px;
		width: 100%;
	}
	.uploadImgBox{
		margin-bottom: 15px;
		border-radius: 0px;
		background: #E7ECF1;
		border: 1px solid #d5e0ea;
	}
	.btnArea{
		text-align: center;
		margin-top: 10px;
	}
</style>
<div class="box">
	<div class="box_header"><i class="fas fa-upload"></i> Upload List <button onclick="debug()">Upload Image</button></div>
	<div class="box_body">
		<div class="row">
			<?php for($i=1; $i<20; $i++){?>
			<div class="col-md-4">
			<div class="box_body uploadImgBox">
				<a href="https://paloimages.prothom-alo.com/contents/cache/images/640x358x1/uploads/media/2020/04/07/277b115a0c69d1f89bc170ceb31e56ef-5e8bec411ad02.jpg"  target="_blank"><img class="uploadImage img-thumbnail" src="https://paloimages.prothom-alo.com/contents/cache/images/640x358x1/uploads/media/2020/04/07/277b115a0c69d1f89bc170ceb31e56ef-5e8bec411ad02.jpg"></a>
				<div class="btnArea">
					<p style="display: none" id="<?php echo $i; ?>"><?php echo $i; ?></p>
					<button  onclick="copyUrl(<?php echo $i; ?>)" class="btn-sm btn-primary"><i class='fas fa-copy'></i> Copy Url</button>
					<button class="btn-sm btn-danger"><i class="fas fa-trash"></i> Delete Image</button>
				</div>
			</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>

