
<button onclick="loadAddQuestionPage()">Add Question</button>
<style type="text/css">

.footerSave{
    background-color: transparent;
    height: 15px;
    width: 100%;
    border: 0px solid #C2C7D0;
    border-width: 0px 0px 0px 0px;
    padding: 5px 10px 45px 55px;
    text-align: right;
}

.formBoxBody{
  background-color: #f9f9f9;
  border: 1px solid #eeeeee;
  padding: 15px;
  border-radius: 5px;
  margin-top: 15px;
  margin-bottom: 15px;
}

.formBoxBody:hover{
  box-shadow: 1px 1px 10px 1px #aaaaaa;
}


.formOptionTitle{
  padding-bottom: 8px;
  margin-bottom: 10px;
  border: 1px solid #f1f1f1;
  border-width: 0px 0px 1px 0px;
  font-size: 15px;
}

.formOptionDescription{
  padding-bottom: 10px;
  font-size: 13px;
}

.formBuilderListBtn{
  background-color: #ffffff;
  border: 1px solid #e3e3e3;
  color: #000000;
}
.formBuilderListBtn:hover{
  background-color: #f5f5f5;
  border: 1px solid #aaaaaa;
  color: #000000;
}

.FormBuilderList input{
  padding: 8px 6px 8px 6px;
  border-radius: 5px;
  font-size: 14px;
  width: 250px;
  border: 1px solid #aaaaaa;
  background-color: #ffffff;
}
.FormBuilderList select{
  padding: 8px 6px 8px 6px!important;
  border-radius: 5px!important;
  font-size: 14px!important;
  width: 250px!important;
  border: 1px solid #aaaaaa!important;
  background-color: #ffffff!important;
}
.FormBuilderList textarea{
  padding: 8px 6px 8px 6px;
  border-radius: 5px;
  height: 80px;
  width: 250px;
  font-size: 14px;
  border: 1px solid #aaaaaa;
  background-color: #ffffff;
}
.FormBuilderList input:focus {
    outline: none;
}


.formBuilderButtonArea{
  margin-top: -6px;
  display: none;
}


</style>

<div class="FormBuilderList">
<?php 
  $questionList = $Form->formQuestionList(array(
    'formId'=>$formId
  ));

	foreach ($questionList as $key => $value) { 
    $requried = $value['formQuestionRequired'] == 'true'?"<font title='Field is required' color='red'><b>*</b></font>":"";
?>
  <div class="boxBody formBoxBody" style="margin-bottom: 15px;">
    <div class="formOptionTitle">
      <?php echo $value['formQuestionTitle']." ".$requried; ?>
      <div class="pull-right formBuilderButtonArea">
        <button class="btn btn-sm formBuilderListBtn" onclick="deleteFormQuestion('<?php echo $value['formQuestionHashId']; ?>')">
          <i class="fas fa-trash-alt"></i>
        </button>
        <button class="btn btn-sm formBuilderListBtn">
          <i class="fa fa-pencil"></i>
        </button>
      </div>
     
    </div>
    <div class="formOptionDescription">
      <div class="contestFormInputMsg"><?php echo $value['formQuestionDescription']; ?></div>
    </div>
    <div class="formOption">
      <?php 
        $formQuestionInputData = $value['formQuestionInputData'];
        $formQuestionInputData = json_decode($formQuestionInputData,true);
        
        $FormBuilder->buildField($formQuestionInputData); 
      ?>
    </div>
    <small class="form-text text-muted"><?php echo $value['formQuestionHint']; ?></small>
  </div>
<?php }?>
</div>


<script type="text/javascript">
  $(document).ready(function () {
    $(document).on('mouseenter', '.formBoxBody', function () {
        $(this).find(".formBuilderButtonArea").show(200);
    }).on('mouseleave', '.formBoxBody', function () {
        $(this).find(".formBuilderButtonArea").hide(200);
      });
    });
</script>
