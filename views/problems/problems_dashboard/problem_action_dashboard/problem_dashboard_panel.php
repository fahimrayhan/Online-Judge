


<div class="row">
	<div class="col-md-3 sidebar">
    <div class="list-group">
        <span href="#" class="list-group-item  box_header" style="border-radius: 0px;background-color: var(--bg-color);color: #ffffff;border-color: var(--bg-color)">
            Problem Dashboard
        </span>
        <li onclick="changeOption('overview')" class="list-group-item dashboard_sidebar_li">
            <i class="fa fa-dashboard dashboard_sidebar_li_icon"></i> OverView
        </li>
        <li class="list-group-item dashboard_sidebar_li" onclick="changeOption('viewProblem')">
            <i class="fa fa-eye dashboard_sidebar_li_icon"></i> View Problem
        </li>
        <li class="list-group-item dashboard_sidebar_li" onclick="changeOption('setting')">
            <i class="fa fa-cogs dashboard_sidebar_li_icon"></i> Setting
        </li>
        <li class="list-group-item dashboard_sidebar_li" onclick="changeOption('edit')">
            <i class="fa fa-pencil dashboard_sidebar_li_icon"></i> Edit
        </li>
        <li onclick="changeOption('testCase')"  class="list-group-item dashboard_sidebar_li">
            <i class="fa fa-th-list dashboard_sidebar_li_icon"></i> Test Case
        </li>
        <li onclick="changeOption('moderators')" class="list-group-item dashboard_sidebar_li">
            <i class="fas fa-user-plus dashboard_sidebar_li_icon"></i> Moderators
        </li>
        <li onclick="changeOption('testing')" class="list-group-item dashboard_sidebar_li">
            <i class="fas fa-gavel dashboard_sidebar_li_icon"></i> Testing
        </li>
        <li class="list-group-item dashboard_sidebar_li">
            <i class="fa fa-list-alt dashboard_sidebar_li_icon"></i> Submission
        </li>
       
    </div>         
    </div>
    <div class="col-md-9">
        <div class="box">
            <div class="box_header" id="box_dashboard_header">
            	<?php echo $pageActionName; ?>
            </div>
            <div class="box_body" style="min-height: 400px;" id="option_box_body">
                <?php
                    if($pageActionName=="edit")
                    	include "$path/problem_edit.php";
                    else if($pageActionName=="viewProblem")
                        include "$path/view_problem.php";
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="style/lib/editarea_0_8_2/edit_area/edit_area_full.js"></script>

<script type="text/javascript" src="views/problems/problems_dashboard/problem_action_dashboard/js/problem_dashboard.js"></script>
