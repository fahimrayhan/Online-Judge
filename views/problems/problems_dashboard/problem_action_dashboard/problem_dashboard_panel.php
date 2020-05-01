<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML'></script>
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
                    if($pageActionName=="viewProblem")
                        include "$path/view_problem.php";
                ?>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript" src="style/lib/editarea_0_8_2/edit_area/edit_area_full.js"></script>
<script src="style/lib/ckeditor/4.13.1/ckeditor.js"></script>
<script type="text/javascript" src="views/problems/problems_dashboard/problem_action_dashboard/js/problem_dashboard.js"></script>

