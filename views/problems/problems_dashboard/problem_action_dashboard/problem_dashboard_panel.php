
<style type="text/css">
    
    .problemPanel{

    }

    .problemPanelHeader{

    }

    .problemNavStyle{
        background-color: #000000;
        border-radius: 4px;
        padding: 10px;
    }
    .problemNavTab{
        padding: 15px;
        border: 1px solid #D4D5D8;
        border-width: 0px 1px 0px 0px;
        text-align: center;
        cursor: pointer;
        border-radius: 0px;

    }
    .problemNavTab:hover{
        border-bottom-width: 3px;
        border-bottom-color: #F0943D;
        border-top-width: 3px;
        border-top-color: #F0943D;
        color: #FFA14C; 
    }
    .problemNavTabActive{
        border-bottom-width: 3px;
        border-bottom-color: #FFA14C;
        border-top-width: 3px;
        border-top-color: #FFA14C;
        font-weight: bold;
        margin-bottom: -15px;
        color: #FFA14C;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="box" style="border-radius: 0px;border-width: 1px;">
        <div class="box_body" style="padding: 0px;margin-bottom: 20px;background-color: #F5F6F7;text-align: center;"><center>
            <ul class="nav nav-tabs userNavStyle" style="border-bottom:0px; ">
                <li id="overview" class="problemNavTab" onclick="changeOption('overview')"><i class="fa fa-dashboard"></i> OverView</li>
                <li id="viewProblem" onclick="changeOption('viewProblem')" class="problemNavTab"><i class="fas fa-eye"></i> View Problem</li>
                <li id="setting" class="problemNavTab" onclick="changeOption('setting')"><i class="fas fa-cogs"></i> Setting</li>
                <li id="edit" class="problemNavTab" onclick="changeOption('edit')"><i class="fa fa-pencil"></i> Edit Problem</li>
                <li id="testCase" onclick="changeOption('testCase')" class="problemNavTab"><i class="fas fa-th-list"></i> Test Case</li>
                <li id="moderators" onclick="changeOption('moderators')" class="problemNavTab"><i class="fas fa-user-plus"></i> Moderators</li>
                <li id="testing" onclick="changeOption('testing')" class="problemNavTab"><i class="fas fa-gavel"></i> Testing</li>
                <li id="" class="problemNavTab"><i class="fas fa-list-alt"></i> Submission</li>
            </ul>
        </center>
        </div>
        </div>
        <div class="box" style="margin-top: -5px">
            <div class="box_body" style="background-color: #ffffff" id="option_box_body">
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
