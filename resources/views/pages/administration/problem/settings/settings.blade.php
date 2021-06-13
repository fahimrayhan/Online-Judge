@extends("pages.administration.problem.problem")
@section('title', 'Problem Settings')
@section('problem-sub-content')
	<div class=''>
       @if($problem->judgeProblem)
        @if($problem->judgeProblem->is_accepted)
            <div>
                <h3>This Problem Is Added To Judge Problme</h3>
            </div>
        @else
             <div>
                <h3>This Problem Is Waiting For Acceptance For Judge Problem By Admin!!</h3>
            </div>
        @endif
       @else
       <button class="btn btn-sm btn-info" style="" onclick="problem.requestForJudgeProblem($(this))" data-url="{{ route('administration.problem.settings.request_judge_problem',['slug' => request()->slug]) }}">Request For Judge Problem</button>
       @endif
    </div>
@stop
