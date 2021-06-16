@extends("pages.administration.problem.problem")
@section('title', 'Problem Settings')
@section('problem-sub-content')
	
  <div class='' style="border: 1px solid #eeeeee;padding: 10px;">
       @if($problem->judgeProblem)
        @if($problem->judgeProblem->is_accepted)
            <div style="color: green">
              This Problem Is Added To Judge Problem
            </div>
        @else
            This Problem Is Waiting For Acceptance For Judge Problem By Admin!!
        @endif
       @else
       <button class="btn btn-sm btn-primary" style="" onclick="problem.requestForJudgeProblem($(this))" data-url="{{ route('administration.problem.settings.request_judge_problem',['slug' => request()->slug]) }}">Request For Judge Problem</button>
       @endif
    </div>
@stop
