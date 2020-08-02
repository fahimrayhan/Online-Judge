<?php 
	foreach ($contestSignUpForm as $key => $value) { 
?>
<div class="boxBody" style="margin-bottom: 15px;">
  <div class="formOptionTitle">
    <?php echo $value['formOptionTitle']; ?>
  </div>
  <div class="formOptionDescription">
    <div class="contestFormInputMsg"><?php echo $value['formOptionMessage']; ?></div>
  </div>
  <div class="formOption">
    <?php $FormBuilder->buildField($value['formOption']);?>
  </div>
</div>

<?php }?>
