<?php 
	$problemData=$Problem->getProblemInfo($problemId);

?>

<textarea id="checkerEditor"><?php echo $problemData['checker']; ?></textarea>
<button id="btnSaveChecker" onclick="saveChecker()">Save Checker</button>
<script type="text/javascript">
	checkerEditor = ace.edit("checkerEditor");
    checkerEditor.setShowPrintMargin(false);
    checkerEditor.setOption("maxLines", 27);                    
    checkerEditor.setOption("minLines", 27);                    
    checkerEditor.setReadOnly(false);
    checkerEditor.setFontSize("14px");
    checkerEditor.getSession().setMode("ace/mode/c_cpp");
</script>