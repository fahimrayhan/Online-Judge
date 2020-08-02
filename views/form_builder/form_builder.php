<script type="text/javascript" src="views/form_builder/js/form_builder.js"></script>
<script type="text/javascript" src="views/form_builder/js/update_serial.js"></script>
<link rel="stylesheet" type="text/css" href="style/css/form_builder.css">

<?php $contestSignUpForm = $Contest->getContestSignUpFormList(3); ?>

<div class="formBuilder">
<div class="row">
    <div class="col-md-3">
        <?php include "views/form_builder/form_option_menu.php"; ?>
    </div>
    <div class="col-md-9">
        <?php include "views/form_builder/form_body.php"; ?>
    </div>
</div>
</div>


<style type="text/css">
 input:invalid {
  border-color: #D93025!important;
  border-width: 1px!important;
}


.source {
    width: 500px;
    height: 10px;
    margin: auto;
}
.boxes div {
    float: left;
    width: 60px;
    height: 50px;
    background-color: #bbe;
    background-image: -moz-linear-gradient(-45deg, #eef, #88d);
    background-image: -o-linear-gradient(-45deg, #eef, #88d);
    background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0, #eef), color-stop(1, #88d));
    font-size: 24pt;
    font-weight: bold;
    text-align: center;
    padding-top: 10px;
    -moz-user-select: none;
    -webkit-user-select: none;
}
.source div {
    cursor: pointer;
}
div.whileDragging {
    background-image: none;
    background-color: black;
    color: white;
}
div.not {
    background-image: none;
    background-color: #eef;
    cursor: inherit;
}
div.pendingDrop {
    opacity: 0.5;
}
.drop {
    width: 360px;
    height: 120px;
    overflow: auto;
    margin: auto;
    margin-top: 25px;
    margin-bottom: 25px;
    background-color: #888;
    border: solid 1px #333;
    box-shadow: 2px 2px 2px #666;
    -webkit-box-shadow: 2px 2px 2px #666;
    text-align: center;
    font-size: 24pt;
    font-weight: bold;
}
.highlight {
    background-color: #dd8;
}
ul#list {
    padding: 0px;
}
ul#list li {
    list-style-type: none;
    margin-bottom: 0px;
    background-color: #ffffff;
    border-bottom: 1px solid #88d;
    padding: 5px;
    font-weight: bold;
    cursor: pointer;
}
</style>