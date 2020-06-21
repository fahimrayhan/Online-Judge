<?php 

	
    if(isset($_GET['file'])){
    	$fileUrl = $_GET['file'];
    	header('Content-Type: application/octet-stream');
    	header("Content-Transfer-Encoding: Binary"); 
    	header("Content-disposition: attachment; filename=\"" . basename($fileUrl) . "\""); 
    	readfile($fileUrl);
    	if(isset($_GET['delete']))unlink($fileUrl);
    }
    else{
    	echo "Request Is Not Good.";
    }

    
?>