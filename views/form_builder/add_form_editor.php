
<style type="text/css">
	input{
		background-color: #ffffff!important;
	}
	option{
		padding: 10px!important;
	}

 	.formBuilder .ftd1{
		width: 40%;
		color: #74747D;
	}
	.formBuilder .ftd2{
		color: #74747D;
	}
	.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 10px; margin-top: 8px}
  	.toggle.ios .toggle-handle { border-radius: 10px; margin-top: 8px}

optgroup
{
	color: #ffffff;
	background-color: #ffffff;
}


</style>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<div class="boxHeader">Option Select</div>
<div class="boxBody" style="margin-bottom: 20px;">

<input type="text" placeholder="Title" onkeyup="changeOptionGlobal(this)" name="title" id="formOptionTitle" autocomplete="off">
<textarea placeholder="Description" onkeyup="changeOptionGlobal(this)" name="description" id="formOptionMessage"></textarea>

<select name="type" id="formType" onchange="selectInputType(this)">
	<option value="">Select Input Type</option>
	<optgroup ></optgroup>
		<option value="text">Text</option>
		<option value="number">Number</option>
		<option value="range">Range</option>
		<option value="month">Month</option>
	
	<optgroup ></optgroup>
	<option value="select">Select</option>
	<option value="textarea">Textarea</option>
	<option value="checkbox">Checkbox</option>
	
</select>

</div>
<div class="boxHeader">Preview Option</div>
<div class="boxBody">
	
	<form action="" method="post" id="testFormOption">
		<div id="previewFullArea">
			<div id="previewTitle" class="formOptionTitle"></div>
			<div id="previewDescription" class="formOptionDescription"></div>
			<div id="previewArea">
		
			</div>
			<button type="submit" style="margin-top: 15px;width: 100%">Test Option</button>
		</div>
	</form>
			
</div>
<div class="boxBody" style="margin-top: 15px;">
	<div id="previewJson">
				
	</div>
</div>


<script type="text/javascript">
	
	$(document).ready(function(){
  		$("#testFormOption").submit(function(event){
    		event.preventDefault(); //prevent default action 
    		var post_url = $(this).attr("action"); //get form action url
    		var formData = $(this).serializeArray();
    		alert("OK");
  		});

  		$("#addForm").submit(function(event){
    	event.preventDefault(); //prevent default action 
    	var post_url = $(this).attr("action"); //get form action url
    	var formData = $(this).serializeArray(); //Encode form elements for submission
    	var printFormData = {};
    	$.each(formData, function( key, value ) {
    		console.log(value);
  			printFormData[value.name] = value.value;
  			
		});

		//console.log(printFormData);

    	var jsonData = JSON.stringify(printFormData);
    	console.log(jsonData);
    	//$("#previewJson").html(jsonData);
    	var data = {
    		'contestId': 3,
    		'optionName': $("#optionName").val(),
    		'formType': $("#formType").val(),
    		'formOptionTitle': $("#formOptionTitle").val(),
    		'formOptionMessage': $("#formOptionMessage").val(),
    		'registrationData': formData
    	}
    	console.log(data);

    		$.post( "contest_arena_action.php", {'addFormField':data}, function( response ) {
      			alert(response);
    		});
  		});
	});
	
	
</script>