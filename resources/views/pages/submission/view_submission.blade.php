@extends(isset(request()->modal) ?  "layouts.empty": "layouts.default")
@section('title', 'Problem Details')
@section(isset(request()->modal) ?  "content":'content')

@include('pages.submission.submission_ui',['submission' => $submission,'testCaseDetailsRoute' => $testCaseDetailsRoute])

@stop

