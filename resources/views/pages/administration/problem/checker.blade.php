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
				<input class="form-check-input" type="radio" name="gridRadios" onchange="problem.selectDefaultChecker()" id="default_checker_select" value="default" {{$problem->checker_type == "default" ? "checked" : ""}}>
          		<label class="form-check-label" for="default_checker_select" style="margin-right: 15px;">
            		Default Checker
          		</label>
				<input class="form-check-input" type="radio" name="gridRadios" onchange="problem.selectCustomChecker()" id="custom_checker_select" value="custom"  {{$problem->checker_type == "custom" ? "checked" : ""}}>
          		<label class="form-check-label" for="custom_checker_select">
            		Custom Checker
          		</label>
			</div>
		</div>
	</div>
	<div class="details-section" id="custom_checker_area" style='display: {{$problem->checker_type == "custom" ? "block" : "none"}}'>
		<div class="row">
			<div class="col-md-3"><div class="option-name">Custom Checker Code</div></div>
			<div class="col-md-9">
				<textarea rows="10" id="checkerEditor">{{$problem->custom_checker}}</textarea>
				<small class="text-muted">You must use <b>testlib</b> checker <a href="https://codeforces.com/blog/entry/18431"><u>Read About testlib Checker</u></a></small>
				<br/>
				<button id="custom_checker_btn" onclick="problem.updateCustomChecker(this)" url="{{route('administration.problem.checker',['slug' => request()->slug])}}" class="btn btn-primary" style="margin-top: 5px;">Save Custom Checker</button>
			</div>
		</div>
	</div>
	<div class="details-section" id="default_checker_area" style='display: {{$problem->checker_type == "default" ? "block" : "none"}}'>
		<div class="row">
			<div class="col-md-3"><div class="option-name">Select Default Checker</div></div>
			<div class="col-md-9">
				<select id="default_checker" onchange="problem.selectDefaultCheckerOption()" class="form-control" style="width: 250px;">
					@foreach($checkers as $key => $checker)
						<option description="{{$checker->description}}" value="{{$checker->name}}" {{$checker->name == $problem->defaultChecker()->name ? "selected" : "" }}>{{$checker->name}} - {{$checker->short_description}}</option>
					@endforeach
				</select>
				<div style="margin-top: 5px;"></div>
				<a href="" onclick="problem.viewChecker('{{route('administration.problem.checker.view',['slug'=> request()->slug])}}')" url="" style="font-size: 12px;"><u>View source: std::<font id="checker-name-url">{{$problem->defaultChecker()->name}}</font>.cpp</u></a>
				<div style="margin-top: 7px;">	
					<small id="checker-description-area" class="form-text text-muted">{{$problem->defaultChecker()->description}}</small>
				</div>
				<button id="default_checker_btn" onclick="problem.updateDefaultChecker(this)" url="{{route('administration.problem.checker',['slug' => request()->slug])}}" class="btn btn-primary" style="margin-top: 10px;">Set Default Checker</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	problem.setCheckerCustomEditor("{!! base64_encode($problem->custom_checker) !!}");
</script>

@stop
