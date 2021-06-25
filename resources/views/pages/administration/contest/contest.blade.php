@extends($layout)
@section('content')

@php
  $titleSub = "Settings";
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
</style>
<div class="row">
	<div class="col-md-3">
		@include('pages.administration.contest.sidebar')
	</div>
	<div class="col-md-9">
		<div class="box">
			<div class="header">
				@yield('title','')
			</div>
			<div class="body" style="min-height: 300px;">
			 @yield('contest-sub-content',view('pages.administration.contest.overview.overview'))
      </div>
		</div>
	</div>
</div>

@stop
