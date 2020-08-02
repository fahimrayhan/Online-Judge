<?php $contestSignUpForm = $Contest->getContestSignUpFormList($contestId);

  //print_r($contestSignUpForm); ?>

<style type="text/css">
.inputLogin {
    padding: 12px 10px 12px 10px!important;
    width: 100%!important;
    border-radius: 5px!important;
    font-size: 14px!important;
    border: 1px solid #aaaaaa!important;
    margin-bottom: 7px!important;
    background-color: #ffffff!important;

}
.loginInputTitleTxt{
    font-weight: bold;
    padding-top: 15px;
}

.inputLogin:focus {
    outline: none;
}

.inputArea {
    margin-top: 10px;
}


.verificationAlert{
    text-align: center;
    margin-bottom: 15px;
    font-size: 18px;
}

.registrationStep{
    text-align: center;
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 10px;
}
.noticeAddProblemArea{
  margin-top: 15px;
}
.contestSignUpFormArea{
  font-family: "Exo 2";
}

.signUpFormTxt{
  font-weight: bold;
  padding-top: 0px;
}

.contestSignUpFormArea input,select{
  padding: 12px 10px 12px 10px!important;
  border-radius: 5px!important;
  font-size: 14px!important;
  border: 1px solid #aaaaaa!important;
  background-color: #ffffff!important;
  margin-bottom: 0px!important;
}

.contestSignUpFormArea option{
  padding: 12px 10px 12px 10px!important;
  border-radius: 5px!important;
  font-size: 14px!important;
}

.contestSignUpFormArea input[type=checkbox],input[type=radio]{
  width: auto!important;
}


.contestSignUpFormArea input[type='checkbox']:after{
    
    display: inline-block;
    width: 18px;
    height: 18px;
    margin-top: -1px;
    margin-left: -4px;
    border: 2px solid #5F616A;
    border-radius: 2px;
    background: #ffffff;
}

 .contestSignUpFormArea input[type='checkbox']:checked:after {
    width: 18px;
    height: 18px;
    border: 3px solid #00ff00;
    background-color: #000000;
}

.contestSignUpFormArea label{
  margin-left: 10px;
}
.contestSignUpFormArea input,select:focus{
  outline: none;
}

.contestFormInputMsg{
   margin-bottom: 10px;
}

.contestFormHeader{
  border: 1px solid #E5E7E8;
  text-align: center;
  font-size: 17px;
  font-weight: bold;
  border-width: 0px 0px 2px 0px;
  padding-bottom: 10px;
  margin-bottom: 20px;
}
.contestFormFooter{
  margin-top: 15px;
}
.contestFormSubmitBtn{
  width: 100%;
}
.formOptionTitle{
  font-size: 15px;
  font-weight: bold;
}
</style>

<div class="contestSignUpFormArea">
<form action="path/to/server/script" method="post" id="contestSignUpForm">
<div class="contestFormHeader">
  Please fill this form before starting this contest
</div>
<?php 
    foreach ($contestSignUpForm as $key => $value) {
     // print_r($value['formOption']);
  ?>
<div class="boxBody" style="margin-bottom: 15px;">
  <div class="formOptionTitle">
    <?php echo $value['formOptionTitle']; ?>
  </div>
  <div class="formOptionDescription">
    <div class="contestFormInputMsg"><?php echo $value['formOptionMessage']; ?></div>
  </div>
  <div class="formOption">
    <?php $FormBuilder->buildField($value['formOption']); ?>
  </div>
</div>
<?php } ?>
<div id="server-results"></div>
<div class="contestFormFooter">
  <button type="submit" class="contestFormSubmitBtn">Submit Form</button>
</div>

</form>
</div>
<input type="" autocomplete='off' name="">

<script type="text/javascript">
  var contestId = <?php echo $contestId; ?>;
  $("#contestSignUpForm").submit(function(event){
    event.preventDefault(); //prevent default action 
    var post_url = $(this).attr("action"); //get form action url
    var form_data = $(this).serialize(); //Encode form elements for submission
    var data = {
      'contestId': contestId,
      'registrationData':form_data
    }
    $.post( "contest_arena_action.php", {'saveData':data}, function( response ) {
      $("#server-results").html( response );
    });
  });
</script>
