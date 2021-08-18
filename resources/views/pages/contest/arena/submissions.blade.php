@extends('layouts.contest_layout')
@section('title', 'Submissions')
@section('content')
<style type="text/css">
    .filterBox{
		background-color: #ffffff!important;
		height: 45px;
		margin-bottom: 5px;
	}
</style>


<div class="row">
    <div class="col-md-9">
        <div class="contestBox">
            <div class="contestBoxHeader">
                Submission 
            </div>
            <div class="contestBoxBody">
                <ul class="nav nav-pills">
                    <li class="{{ Request::segment(5) == 'my' ? "active" : ""}}"><a href="{{route('contest.arena.submissions.my',['contest_slug' => request()->contest_slug])}}">My</a></li>
                    <li class="{{ Request::segment(5) != 'my' ? "active" : ""}}"><a href="{{route('contest.arena.submissions',['contest_slug' => request()->contest_slug])}}">All</a></li></ul>
            </div>
            <div class="" style="padding: 0px;">
                <div class="table-responsive">

                    <table class="table-custom">
    <tr>
        <th>#</th>
        <th>Author</th>
        <th>Problem</th>
        <th>Time</th>
        <th>Language</th>
        <th>CPU</th>
        <th>Memory</th>
        <th></th>
    </tr>
    @foreach($submissions as $key => $submission)
        <tr>
            <td><a modal='true' modal-type='lg' modal-header="Submission #{{$submission->id}}" href="{{route('contest.arena.submissions.view',['contest_slug' => request()->contest_slug,'submission_id' => $submission->id])}}"><u>{{$submission->id}}</u></a></td>
           
            <td><a href="{{route('profile',[ 'handle' => $submission->user->handle])}}">{{$submission->main_name}}</a></td>
            <td style="text-align: left;">
                <a href="{{route('contest.arena.problems.view',['contest_slug' => request()->contest_slug,'problem_no' => $submission->problem_no])}}">{{$submission->problem_no}}. {{$submission->problem->name}}</a></td>
            <td><font title="{{$submission->created_at}}">{{gmdate("H : i : s", $contest->start->diffInSeconds($submission->created_at))}}</font></td>
            <td>{{$submission->language->name}}</td>
            <td><span id="submission_{{$submission->id}}_time">{{$submission->time}} ms</span></td>
            <td><span id="submission_{{$submission->id}}_memory">{{$submission->memory}} kb</span></td>
            <td><span id="submission_{{$submission->id}}_verdict">{!!$submission->verdictStatus()!!}</span></td>
        </tr>
    @endforeach
</table>
                </div>
               <div style="text-align: center;">
    {!! $submissions->appends(request()->input())->links() !!}
</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="contestBox">
            <div class="contestBoxHeader">
                Filter
            </div>
            <div class="contestBoxBody">
                <input class="form-control filterBox" id="submission-filter-handle" name="" placeholder="User Handle" type="text" value="{{request()->handle}}">
                    <select class="form-control filterBox" id="submission-filter-problem">
                        <option value="">
                            Any Problem
                        </option>
                        @foreach($problems as $key => $problem)
                        <option value="{{$problem->problem_no}}" {{$key == request()->problem ? "selected" : ""}}>{{$problem->problem_no}} . {{$problem->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control filterBox" id="submission-filter-language">
                        <option value="">
                            Any Language
                        </option>
                        @foreach($languages as $key => $language)
                        <option value="{{$language->name}}" {{$language->name == request()->language ? "selected" : ""}}>{{$language->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control filterBox" id="submission-filter-verdict">
                        <option value="">
                            Any Verdict
                        </option>
                        @foreach($verdicts as $key => $verdict)
                            <option value="{{$verdict->name}}" {{$verdict->name == request()->verdict ? "selected" : ""}}>{{$verdict->name}}</option>
                        @endforeach
                    </select>
                    <button onclick="submission.filter('{{route('contest.arena.submissions',['contest_slug' => request()->contest_slug])}}')" class="btn btn-primary" style="margin-top: 10px; width: 100%">
                        Apply
                    </button>
                </input>
            </div>
        </div>
    </div>
</div>
@stop
