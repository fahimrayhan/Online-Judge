@extends('layouts.contest_layout')
@section('title', 'Contests')
@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="contestBox">
            <div class="contestBoxHeader">
                Problems
            </div>
            <div class="">
                <style type="text/css">
                    .labelAc{
		background-color: #5CB85C;
		color: #ffffff;
		padding: 3px 5px 3px 5px;
		border-radius: 4px;
		font-size: 12px!important;
	}
	.labelWa{
		background-color: #E35B5A;
		color: #ffffff;
		padding: 3px 5px 3px 5px;
		border-radius: 4px;
		font-size: 12px!important;
	}
	.labelNormal{
		background-color: #eeeeee;
		color: #000000;
		padding: 3px 5px 3px 5px;
		border-radius: 4px;
		font-size: 12px!important;
	}
</style>
@php

	$problems = $contest->problems()->get();
@endphp
	@foreach($problems as $key => $problem)
	<a class="list-group-item problemListBox" href="contest_arena.php?id=3&problem=A" style="position: relative;">
                    <div class="pull-right labelNormal" style="margin-top: 9px;">
                        <i class="fa fa-user">
                        </i>
                        × 0
                    </div>
                    <div class="pull-left problemNo">
                        {{chr($key + 65)}}
                    </div>
                    <h4 class="list-group-item-heading" style="margin: 5px 0 4px; line-height: 30px;">
                        {{$problem->name}}
                    </h4>
                </a>

	@endforeach

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="contestBox">
            <div class="contestBoxHeader">
                Resources
            </div>
            <div class="problemLdistBox">
            </div>
        </div>
        <div class="contestBox">
            <div class="contestBoxHeader">
                Announcement
            </div>
        </div>
    </div>
</div>
@stop
