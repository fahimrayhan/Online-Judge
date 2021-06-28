@extends('layouts.contest_layout')
@section('title', 'Contests')
@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="contestBox">
            <div class="contestBoxBody">
                @include('pages.problem.layout.default',['problem' => $problem,'contest_serial' => request()->problem_no])
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="contestBox">
            <div class="contestBoxHeader">
                Submit
            </div>
            <div class="contestBoxBody">
                <button class="btn btn-primary" style="width: 100%" onclick="new Modal('lg').load('{{route('contest.arena.problems.view.submit',[
                'contest_slug' => request()->contest_slug,
                'problem_no' => request()->problem_no
            ])}}', 'Submit Your Solution')">Submit Your Solution</button>
            </div>
        </div>
    </div>
</div>

@stop
