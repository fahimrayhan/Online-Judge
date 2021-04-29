@extends("pages.administration.problem.problem")
@section('title', 'Problem Overview')
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
</style>

<div id="problem-details-editor-body" style="">
	<div class="details-section">
		<div class="row">
			<div class="col-md-3"><div class="option-name">Checker Type</div></div>
			<div class="col-md-9">
				<input class="form-check-input" type="radio" name="gridRadios" id="default_checker" value="option1" checked>
          		<label class="form-check-label" for="default_checker" style="margin-right: 15px;">
            		Default Checker
          		</label>
				<input class="form-check-input" type="radio" name="gridRadios" id="custom_checker" value="option1" checked>
          		<label class="form-check-label" for="custom_checker">
            		Custom Checker
          		</label>
			</div>
		</div>
	</div>
</div>

@stop
