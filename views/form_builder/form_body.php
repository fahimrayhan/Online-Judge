<script type="text/javascript" src="views/form_builder/js/form_builder.js"></script>
<script type="text/javascript" src="views/form_builder/js/update_serial.js"></script>
<link rel="stylesheet" type="text/css" href="style/css/form_builder.css">

<link href="style/lib/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="style/lib/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

	<?php
        $formData = $Form->getFormInfo($formId);
        $formHashId = $formData['formHashId'];
        echo "<script>formHashId = '$formHashId';</script>";
    	if(isset($_GET['add'])){
        	include "views/form_builder/add_form.php";
        	return;
    	}
    	else if(isset($_GET['move'])){
        	include "views/form_builder/form_move.php";
        	return;
    	}
    	else{
    		include "views/form_builder/form_list.php";
        	return;
    	}
	?>