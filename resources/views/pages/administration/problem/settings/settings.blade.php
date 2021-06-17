@extends("pages.administration.problem.problem")
@section('title', 'Problem Settings')
@section('problem-sub-content')
	<style type="text/css">
   .setting-area{
      border: 1px solid #eeeeee;
      padding: 10px;
      margin-bottom: 10px;
   } 
  </style>
  <div class="setting-area">
    @include("pages.administration.problem.settings.basic",['problem' => $problem])
  </div>
  <div class="setting-area">
    @include("pages.administration.problem.settings.request_judge_problem",['problem' => $problem])
  </div>
  
@stop
