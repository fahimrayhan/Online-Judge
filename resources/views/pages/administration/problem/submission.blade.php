
@extends(isset(request()->modal) ?  "layouts.empty":"pages.administration.problem.problem")
@section('title', 'Problem Details')
@section(isset(request()->modal) ?  "content":'problem-sub-content')

@include('pages.submission.submission_ui',['submission' => $submission,'testCaseDetailsRoute' => $testCaseDetailsRoute])

@stop

