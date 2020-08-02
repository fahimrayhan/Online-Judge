<div class="boxBody">
	<?php
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
</div>