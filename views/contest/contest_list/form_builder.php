<?php 
	
	$form = $FormBuilder;

	$form->addInput(array(
		'autofocus' =>true
	));
	$form->addInput(array(
		'type' => "number",
		'name' => "Enter Age",
		'required' => false,
		'placeholder' => 'Enter Your Age',
		'required' => true
	));

	$info = array(
		'type' => "select",
		'maxlength' => 10,
		'size' => 4,
		'value' => 'Hamza',
		'required' => true,
		'options' => array(
			'' => 'Select Semister',
			'Spring 17' => 'Spring 17',
			'Fall 18' => 'Fall 18'
		),
		'selectedOptions' => array(
			'Spring 17'
		),
	);
	$info = json_encode($info);
	echo "$info";

	$form->addInput(array(
		'type' => "textarea",
		'name' => "about",
		'maxlength' => 10,
		'size' => 4,
		'value' => 'Hamza',
		'required' => true,
		'placeholder' => 'Tele'
	));
	$form->addInput(array(
		'type' => "select",
		'name' => "semister",
		'maxlength' => 10,
		'size' => 4,
		'value' => 'Hamza',
		'required' => true,
		'options' => array(
			'' => 'Select Semister',
			'Spring 17' => 'Spring 17',
			'Fall 18' => 'Fall 18'
		),
		'selectedOptions' => array(
			'Spring 17'
		),
	));

	$form->addInput(array(
		'type' => "checkbox",
		'name' => "selectSemister",
		'maxlength' => 10,
		'size' => 4,
		'value' => 'Hamza',
		'required' => true,
		'options' => array(
			'' => 'Select Semister',
			'Spring17' => 'Spring 17',
			'Fall18' => 'Fall 18'
		),
		'selectedOptions' => array(
			'Spring17','Fall18'
		),
		'placeholder' => 'Tele',
	));

	$form->addInput(array(
		'type' => "radio",
		'name' => "selectRadioSemister",
		'maxlength' => 10,
		'size' => 4,
		'value' => 'Hamza',
		'required' => true,
		'options' => array(
			'' => 'Select Semister',
			'Spring 17' => 'Spring 17',
			'Fall 18' => 'Fall 18'
		),
		'selectedOptions' => array(
			
		),
		'placeholder' => 'Tele',
	));

?>
<input type="text" id="username" name="username" maxlength="10">

<form action="path/to/server/script" method="post" id="contestSignUpForm">
	<?php $form->buildInputList(); ?>
	<button type="submit">Save</button>
</form>
<div id="server-results"></div>

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