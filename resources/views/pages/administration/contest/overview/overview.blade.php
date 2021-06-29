@extends("pages.administration.contest.contest")
@section('title', 'Contest Overview')
@section('contest-sub-content')

@php
    $totalProblems = $contest->problems()->count();

@endphp

<div class="row">
    <div class="col-md-4">
        <div class="card-counter custom">
            <i class="fa fa-code-fork">
            </i>
            <span class="count-numbers">
                {{$totalProblems}}
            </span>
            <span class="count-name">
                Problems
            </span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-counter custom">
            <i class="fa fa-code-fork">
            </i>
            <span class="count-numbers">
                {{$contest->moderator()->count()}}
            </span>
            <span class="count-name">
                Total Moderator
            </span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-counter custom">
            <i class="fa fa-users">
            </i>
            <span class="count-numbers">
                -
            </span>
            <span class="count-name">
                Announcement
            </span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-counter custom">
            <i class="fa fa-users">
            </i>
            <span class="count-numbers">
                -
            </span>
            <span class="count-name">
                Clearification
            </span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-counter custom">
            <i class="fa fa-users">
            </i>
            <span class="count-numbers">
                {{$contest->registrations()->count()}}
            </span>
            <span class="count-name">
                Participants
            </span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-counter custom">
            <i class="fa fa-users">
            </i>
            <span class="count-numbers">
                {{$contest->submissions()->count()}}
            </span>
            <span class="count-name">
                Total Submissions
            </span>
        </div>
    </div>
</div>


<a href="{{route('contests.info',['contest_slug' => $contest->slug])}}">
    <button class="btn btn-primary">Go Info Page</button>
</a>

<a href="{{route('contest.arena.standings',['contest_slug' => $contest->slug])}}">
    <button class="btn btn-primary">Go Rank List</button>
</a>
@stop
