
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


<div class="boxHeader">Option Select</div>
<div class="boxBody" style="margin-bottom: 20px;">

<input type="text"  placeholder="Title" onkeyup="changeOptionGlobal(this)" name="title" id="formOptionTitle" autocomplete="off">
<textarea placeholder="Description" onkeyup="changeOptionGlobal(this)" name="description" id="formOptionMessage"></textarea>
<input type="text"  placeholder="Question Hint" onkeyup="changeOptionGlobal(this)"  name="hint" id="questionHint" autocomplete="off">
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
			<small class="form-text text-muted" id="formQuestionHint"></small>
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


			formType = $("#formType").val();

			var formData = Object.assign({}, formData);

			if(formType == "select"){
				formData.options = optionList;
			}

    		var data1 = {
    			'formType': $("#formType").val(),
    			'formQuestionTitle': $("#formOptionTitle").val(),
    			'formQuestionDescription': $("#formOptionMessage").val(),
    			'formQuestionHint': $("#questionHint").val(),
    			'formQuestionInputData': formData
    		}
    		var data = {
    			'formId': 1,
    			'addQuestion': data1
    		}

    		console.log(data);

    		$.post( "form_action.php", data , function( response ) {
      			//alert(response);
      			$("#previewJson").html(response);
    		});
  		});
	});


</script>
