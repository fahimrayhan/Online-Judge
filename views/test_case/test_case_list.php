
<div style='text-align: right; margin-bottom: 10px;'><button id="loadAddTestCaseBtn" class="btn-success"><span class='glyphicon glyphicon-plus'></span> Add Test Case</button></div>
<div id="debugTestCase"></div>


<table width='100%'>
	<tr>
		<td class='td1'>Order</td>
		<td class='td1'>Input File</td>
		<td class='td1'>Output File</td>
		<td class='td1'>Sample</td>
		<td class='td1'>Points</td>
		<td class='td1'>Added Date</td>
		<td class='td1'>Added By</td>
		<td class='td1'></td>
	</tr>

	<?php
		$info=$TestCase->getTestCaseList($problemId);
		$c=0;
		foreach ($info as $key => $value) {
			$c++;
			$date=$value['testCaseAddedDate'];
			$handle=$value['userHandle'];
			$userId=$value['userId'];
			$inputUrl=$value['inputUrl'];
			$inputSize=$value['inputFileSize'];
			$outputUrl=$value['outputUrl'];
			$outputSize=$value['outputFileSize'];
			$hashId=$value['testCaseIdHash'];
			$point=$value['testCasePoint'];
			$sample = $value['testCaseSample'];
			$checked = $sample?"checked":"";
		?>

		<tr>
			<td class='td2'><?php echo "$c"; ?></td>
			<td class='td2'><a href='<?php echo $inputUrl; ?>' target='_blank'><?php echo "input-$c.txt ($inputSize Bytes)"; ?></a> | <a title="Download Input File" href="download.php?file=<?php echo $inputUrl; ?>"><i class="fa fa-download"></i></a></td>
			<td class='td2'><a href='<?php echo $outputUrl; ?>' target='_blank'><?php echo "output-$c.txt ($outputSize Bytes)"; ?></a> | <a title="Download Output File" href="download.php?file=<?php echo $outputUrl; ?>"><i class="fa fa-download"></i></a></td>
			<td class="td2">
				<input id="testCaseSample_<?php echo "$hashId" ?>" value="<?php echo "$hashId" ?>" type="checkbox"  onchange="changeProblemSample(this)" <?php echo "$checked"; ?>>
			</td>
			<td class='td2'><?php echo "$point"; ?></td>
			<td class='td2'><?php echo "$date"; ?></td>
			<td class='td2'><a href="profile.php?id=<?php echo $userId ?>"><?php echo "$handle"; ?></a></td>
			<td class='td2'> 
				<button value='<?php echo "$hashId"; ?>' class='btn btn-sm' onclick ='problemTestCase.loadUpdateTestCasePage(this)' id='updateTestCaseBtn'><span class='glyphicon glyphicon-pencil'></span></button>
				<button onclick='problemTestCase.deleteTestCase(this)' value='<?php echo "$hashId"; ?>' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-trash'></span></button>
			</td>
			</tr>
		<?php } ?>
</table>

<script type="text/javascript" src="views/test_case/js/test_case.js"></script>
<script type="text/javascript">
	problemTestCase.problemId = <?php echo "$problemId"; ?>
</script>