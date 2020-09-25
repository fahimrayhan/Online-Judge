<style type="text/css">
	.downloadFilterIcon{
		font-size: 18px;
		cursor: pointer;
		background-color: #eeeeee;
		color: #000000;
		border-radius: 2px;
		padding: 2px;
		border: 1px solid #DDDDDD;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
    $(".up,.down").click(function(){
        var row = $(this).parents("tr:first");
        if ($(this).is(".up")) {
            row.insertBefore(row.prev()).hide().show('slow');
        } else if ($(this).is(".down")) {
            row.insertAfter(row.next()).hide().show('slow');
        }
    });
});
</script>


<?php
	$keyList     = $Contest->getRegistrationOptionList($contestId);
	unset($keyList['action']);
	echo "<table width='100%' class='table table-striped table-bordered dt-responsive nowrap'>";
	foreach ($keyList as $key => $value) {
		echo "
			<tr>
				<td style='width:20px'>
					<input type='checkbox' value='$key' name='registrationListOptionSelect[]' checked> 
				</td>
				<td style='text-align:left'>
					$value
				</td>
				<td style='width:60px'>
					<a href='#' class='up'>
						<i class='fa fa-angle-up downloadFilterIcon'></i>
					</a>
					<a href='#' class='down'>
						<i class='fa fa-angle-down downloadFilterIcon'></i> 
					</a>
				</td>
			</tr>
			";
	}
	echo "</table>";

?>
<div class="row">
	<div class="col-md-12">
		<div class="pull-right">
			<button class="btn" id="downlaodCsv" onclick="createRegistrationDownloadFile()"><i class='fa fa-download'></i> Downlaod CSV</button>
		</div>
	</div>
</div>