<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML'></script>
<script type="text/javascript">
    
</script>
<style type="text/css">
    .nav-tabs {
  white-space: nowrap;
  overflow-x: auto;
  overflow-y: hidden;
}
.nav-tabs > li {
  float: none;
  display: inline-block;
}

.nav-tabs::-webkit-scrollbar {
    height: 8px;
}

.nav-tabs::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    border-radius: 2px;
}

.nav-tabs::-webkit-scrollbar-thumb {
    border-radius: 2px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}
​
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
                <li id="checker" class="problemNavTab" onclick="changeOption('checker')"><i class="fas fa-list-alt"></i> Checker</li>
                <li id="export" onclick="changeOption('export')" class="problemNavTab"><i class="fa fa-upload"></i> Export</li>
                <li id="import" onclick="changeOption('import')" class="problemNavTab"><i class="fa fa-download"></i> Import</li>

            </ul>
        </center>
        </div>
        </div>
        <div class="box" style="margin-top: -5px">
            <div class="box_body" style="background-color: #ffffff" id="option_box_body">
                
            </div>
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.0/ace.js"></script>
<script src="style/lib/ckeditor/4.13.1/ckeditor.js"></script>
<script type="text/javascript" src="views/problems/problems_dashboard/problem_action_dashboard/js/problem_dashboard.js"></script>


