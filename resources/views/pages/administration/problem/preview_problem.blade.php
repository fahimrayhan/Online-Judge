@extends("pages.administration.problem.problem")
@section('title', 'Problem Details')
@section('problem-sub-content')

@include("pages.problem.layout.default",['problem' => $problem])

@stop
