


<?php

    $submissionId=isset($_GET['id'])?$_GET['id']:-1;
    if($submissionId==-1)include "404.php";
    else include "views/submission/submission_page_ui.php";

?>

