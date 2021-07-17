

@extends(isset(request()->modal) ?  "layouts.empty":"pages.administration.contest.contest")
@section('title', 'Problem')
@section(isset(request()->modal) ?  "content":'contest-sub-content')

    @include('pages.problem.layout.default',['problem' => $problem])

@stop