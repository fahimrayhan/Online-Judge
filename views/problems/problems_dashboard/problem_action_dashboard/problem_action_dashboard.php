<?php
  
    $ok=0;
    $problemId;
    $pageActionName="";
    if(isset($_GET['id'])){
        $ok=1;
        $problemId=$_GET['id'];
    }
    if($ok==1){
        $problemRoles=$Problem->checkProblemModeratorRoles($problemId);
        if($problemRoles==-1)$ok=0;
    }

    if($ok==0){
        include "views/problems/problems_dashboard/problem_action_dashboard/problem_dashboard_list.php";
        return;
    }

    if(isset($_GET['action']))
        $pageActionName=$_GET['action'];

    echo "<script>
    var problemId=$problemId,pageActionName='$pageActionName';
    </script>";

    $path="views/problems/problems_dashboard/problem_action_dashboard/";
    include "$path/problem_dashboard_panel.php";

?>