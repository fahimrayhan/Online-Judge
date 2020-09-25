<?php 

	
    if(isset($_GET['file'])){
    	$fileUrl = $_GET['file'];
    	header('Content-Type: application/octet-stream');
    	header("Content-Transfer-Encoding: Binary"); 
    	header("Content-disposition: attachment; filename=\"" . basename($fileUrl) . "\""); 
    	readfile($fileUrl);
    	if(isset($_GET['delete']))unlink($fileUrl);
    }
    else if($_GET['contestRegistrationList']){
        $contestId = $_GET['contestRegistrationList'];
        include "script.php";
        include "views/contest/contest_admin_panel/page/registration_download.php";
    }
    else{
    	echo "Request Is Not Good.";
    }

    
?>