@extends($layout)
@section('content')
@section('title', 'Administraion')

@php
  $titleSub = "Administration";
@endphp

<style type="text/css">
	.panel-sidebar-btn{
  	border: 1px solid #dddddd;
    background-color: #f9f9f9;
  	color: #606060;
  	font-weight: bold;
  	margin-bottom: 5px;
  	font-size: 13px;
  	padding: 12px;
  	border-radius: 5px;
  }
  .panel-sidebar-btn:hover{
  	background-color: #eeeeee;
    border: 1px solid #aaaaaa;
  	color: #000000;
  }
  .panel-sidebar-btn:focus{
  	outline: none;
  }
  .sidebar-btn{
    width: 100%;
    text-align: left;
  }
  .sidebar-btn-active{
  	background-color: #eeeeee;
    border: 1px solid #aaaaaa;
  	color: #000000;
  	font-size: 15px;
  }

  .administration-icon{
    font-size: 7em;
    color: #34495e;
  }
  .administration-card .button-area{
    border-top: 1px solid #eeeeee;
    margin-top: 10px;
    padding-top: 10px;
  }
  .administration-card .button-area button{
    width: 100%;
  }
</style>

@php

$options = [
    'settings' => [
        'icon' => 'fa fa-cog',
        'name' => 'Settings',
        'url' => route('administration.settings'),
    ],
    'problems' => [
        'icon' => 'fa fa-list',
        'name' => 'Problems',
        'url' => route('administration.problems'),
    ],
    
];

@endphp

<div class="row">
  @foreach ($options as $key => $option)
	<div class="col-md-3">
		<div class="box">
      <div class="header">{{$option['name']}}</div>
      <div class="body administration-card" style="min-height: 120px;text-align: center;">
        <i class="{{$option['icon']}} administration-icon" aria-hidden="true"></i><br/>
        <div class="button-area">
          <a href="{{$option['url']}}">
            <button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View {{$option['name']}}</button>
          </a>
        </div>
      </div>
    </div>
	</div>
	@endforeach
</div>

@stop

