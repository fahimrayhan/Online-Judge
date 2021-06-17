
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

