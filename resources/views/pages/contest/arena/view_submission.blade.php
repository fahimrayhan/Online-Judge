
@extends(isset(request()->modal) ?  "layouts.empty":"layouts.contest_layout")
@section('title', 'Submission '.$submission->id)
@section('content')

@include('pages.contest.arena.view_submission_ui',['submission' => $submission])

@stop


