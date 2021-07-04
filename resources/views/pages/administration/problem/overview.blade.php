@extends("pages.administration.problem.problem")
@section('title', 'Problem Overview')
@section('problem-sub-content')
	<div class='row'>
    			<div class='col-md-4'>
      				<div class='card-counter custom'>
        				<i class='fa fa-code-fork'></i>
        				<span class='count-numbers'>{{$problem->testcases()->count()}}</span>
        				<span class='count-name'>Total Test Case</span>
      				</div>
      			</div>
      			<div class='col-md-4'>
      				<div class='card-counter custom'>
        				<i class='fa fa-users'></i>
        				<span class='count-numbers'>{{$problem->moderator()->count()}}</span>
        				<span class='count-name'>Total Moderator</span>
      				</div>
      			</div>
      			<div class='col-md-4'>
      				<div class='card-counter custom'>
        				<i class='fa fa-code'></i>
        				<span class='count-numbers'>{{count($problem->languageList())}}</span>
        				<span class='count-name'>Total Language</span>
      				</div>
      			</div>
      			<div class='col-md-4'>
      				<div class='card-counter custom'>
        				<i class='fa fa-list'></i>
        				<span class='count-numbers'>{{$problem->submissions()->count()}}</span>
        				<span class='count-name'>Total Submission</span>
      				</div>
      			</div>
      			<div class='col-md-4'>
      				<div class='card-counter custom'>
        				<i class='fa fa-list'></i>
        				<span class='count-numbers'>{{$problem->submissions()->where(['type' => 1])->count()}}</span>
        				<span class='count-name'>Total Test</span>
      				</div>
      			</div>
      			<div class='col-md-4'>
      				<div class='card-counter custom'>
        				<i class='fa fa-list'></i>
        				<span class='count-numbers'>{{$problem->submissions()->where(['type' => 2])->count()}}</span>
        				<span class='count-name'>Total Practice</span>
      				</div>
      			</div>
    		</div>

@stop
