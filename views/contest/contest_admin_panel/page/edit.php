<style type="text/css">
    .contstFormBlock{
        font-size: 15px;
        font-weight: bold;
    }

fieldset {
  background-color: #f9f9f9;
  border: 1px solid #eeeeee;
  padding: 5px;
  border-radius: 5px;
  margin-top: 15px;
}

legend {
  background-color: gray;
  color: white;
  width: 180px;
  font-size: 15px;
  padding: 2px;
  margin-left: 15px;
  border-radius: 5px;
  font-weight: bold;
}

.labelHint{
    font-size: 12px;
    color: #aaaaaa;
    margin-top: 2px;
}

.footerSave{
    background-color: transparent;
    height: 15px;
    width: 100%;
    border: 0px solid #C2C7D0;
    border-width: 0px 0px 0px 0px;
    padding: 5px 10px 45px 55px;
    text-align: right;
}

</style>
<script src="style/lib/ckeditor/4.13.1/ckeditor.js"></script>
<link href="style/lib/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="style/lib/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<?php include "views/contest/contest_admin_panel/page/edit_form.php"; ?>
<div class="form-horizontal">
    <form action="" method="post" id="updateContestForm">
        <?php 
            buildForm(array("contestInfo","contestDescription"));?>
        <fieldset>
            <legend>
                <center>Contest Frozen</center>
            </legend>
            <?php echo addFormField($form['contestFreeze']);?>
            <?php $contestFreezeArea = $contestInfo['contestFreeze']=="true"?"block":"none"; ?>
            <div id="contestFreezeArea" style="display: <?php echo $contestFreezeArea; ?>">
                <?php 
                    echo addFormField($form['contestFreezePeriod']);
                    echo addFormField($form['contestUnFreeze']);
                ?>
            </div>
        </fieldset>
        <fieldset>
           <legend>
                <center>Contest Privacy</center>
            </legend>
            <?php echo addFormField($form['contestVisibility']); ?>

            <?php 
                $visibility = $contestInfo['contestVisibility'];
                $registraionFormArea = $visibility == "Public"|| $visibility =="Protected"? "block":"none"; 
                $contestPasswordArea = $visibility == "Protected"?"block":"none";
            ?>
            
            <div id="contestRegistraionFormInputArea" style="display: <?php echo $registraionFormArea; ?>">
                <div id="contestPassword" style="display: <?php echo $contestPasswordArea; ?>">
                    <?php echo addFormField($form['contestPassword']); ?>
                </div>
                <?php echo addFormField($form['registrationClose']); ?>
                <?php echo addFormField($form['registrationAutoAccept']); ?>
            </div>
            
            
            
        </fieldset>

        <div class="footer navbar-fixed-bottom footerSave">
            <button type="submit" id="saveContestDataBtn">Save Changes</button>
        </div>
    </form>
</div>



<script type="text/javascript">
    CKEDITOR.replace('contestDescription');
</script>