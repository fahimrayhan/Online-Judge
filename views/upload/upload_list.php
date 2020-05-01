<style type="text/css">
	.uploadTd1{
		padding: 0px;
		width: 100px;
	}
</style>


<div class="boxx">
	
	<div class="box_bodyy">
		<div class="row">
		<?php 
			$info=$File->getUserFileList();
			$imgCnt=0;
			foreach ($info as $key => $value) {
			$imgCnt++;
			$path=$value['filePath'];
			$fsize=round($value['fileSize']/1000,1);
		?>
			<div class="col-md-4">
			<div class="box_body uploadImgBox">
				<a href="<?php echo $path; ?>"  target="_blank"><img class="uploadImage img-thumbnail" src="<?php echo $path; ?>"></a>
				<div class="uploadBtnArea">
					<p style="display: none" id="<?php echo $path; ?>"><?php echo $path; ?></p>
					<div style="margin-bottom: 0px;">
						<table width="100%">
							<tr><td class="td1 uploadTd1">File Size</td><td class="td2"><?php echo $fsize; ?> KB</td></tr>
							<tr><td class="td1 uploadTd1">File Type</td><td class="td2"><?php echo $value['fileType']; ?></td></tr>
							<tr><td class="td1 uploadTd1">Added Date</td><td class="td2"><?php echo $DB->dateToString($value['addedDate']); ?></td></tr>
						</table>
					</div>
					<input type="text" value="<?php echo $path ?>" id="cpyPath_<?php echo $imgCnt ?>">
					<button  onclick="copyFilePath('cpyPath_<?php echo $imgCnt ?>')" class="btn-sm btn-primary"><i class='fas fa-copy'></i> Copy Url</button>
					<button onclick="deleteUploadPhoto('<?php echo $path; ?>')" class="btn-sm btn-danger"><i class="fas fa-trash"></i> Delete Image</button>
				</div>
			</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>

