@extends("pages.administration.problem.problem")
@section('title', 'Problem Statement')
@section('problem-sub-content')

<style type="text/css">
	.details-section{
		margin-bottom: 10px;
		border: 1px solid #f5f5f5;
		border-width: 0px 0px 1px 0px;
		padding-bottom: 10px;
	}
	.option-name{
		font-weight: bold;
		font-size: 13px;
		margin-top: 6px;
	}
	.cke_chrome{
    	border-radius: 5px;
    	border-width: 1px;
    	padding: 1px;
           
	}

	.cke_top{
		background-color: #f9f9f9;
		border-radius: 0px;
		border-width: 0px 0px 1px 0px;
	}
	.cke_top a{
		color: 
	}

	.footer-save{
    	background-color: #f7f7f7;
    	height: 15px;
    	width: 100%;
    	border: 1px solid #C2C7D0;
    	border-width: 1px 0px 0px 0px;
    	padding: 5px 10px 45px 55px;
    	text-align: right;
	}

	.cke_contents{}
</style>

<div id="problem-details-editor-loader" style="text-align: center;">
	<img src="http://coderoj.com/file/site_metarial/loader2.gif"><br>
		<b>Editor Loading...</b>
</div>

<div id="problem-details-editor-body" style="display: none;">
	<div class="details-section">
		<div class="row">
			<div class="col-md-3"><div class="option-name">Problem Name</div></div>
			<div class="col-md-9"><input type="text" id="problem_name" class="form-control" style="width: 520px;" name="" value="{{$problem->name}}"></div>
		</div>
	</div>
	<div class="details-section">
		<div class="row">
			<div class="col-md-3"><div class="option-name">Problem Statement</div></div>
			<div class="col-md-9"><textarea id="descriptionEditor"></textarea></div>
		</div>
	</div>
	<div class="details-section">
		<div class="row">
			<div class="col-md-3"><div class="option-name">Input Statement</div></div>
			<div class="col-md-9"><textarea id="inputEditor"></textarea></div>
		</div>
	</div>
	<div class="details-section">
		<div class="row">
			<div class="col-md-3"><div class="option-name">Output Statement</div></div>
			<div class="col-md-9"><textarea id="outputEditor"></textarea></div>
		</div>
	</div>
	<div class="details-section">
		<div class="row">
			<div class="col-md-3"><div class="option-name">Constraints</div></div>
			<div class="col-md-9"><textarea id="constraintsEditor"></textarea></div>
		</div>
	</div>
	<div class="details-section">
		<div class="row">
			<div class="col-md-3"><div class="option-name">Note</div></div>
			<div class="col-md-9"><textarea id="noteEditor"></textarea></div>
		</div>
	</div>
	<div class="footer navbar-fixed-bottom footer-save">
		<button id="update-problem-preview" type="submit" class="btn btn-primary" url="{{route('administration.problem.preview_problem',['slug' => request()->slug])}}" onclick="problem.preview(this)">Preview</button>
        <button id="update-problem-details" type="submit" class="btn btn-primary" onclick="problem.detailsUpadte('{{route('administration.problem.statement',['slug' => request()->slug])}}')">Update Details</button>
    </div>
</div>

@php
	$editorData = [
		'problem_description' => base64_encode($problem->problem_description),
		'input_description' => base64_encode($problem->input_description),
		'output_description' => base64_encode($problem->output_description),
		'constraint_description' => base64_encode($problem->constraint_description),
		'notes' => base64_encode($problem->notes),
	];
@endphp

<script type="text/javascript">
	problem.editor('{!! json_encode($editorData) !!}');
	setTimeout(function(){ 
    	$("#problem-details-editor-loader").hide();
    	$("#problem-details-editor-body").show();
  	}, 1000);
</script>

@stop
