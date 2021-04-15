@extends($layout)
@section('content')

@php
  $titleSub = "Settings";
@endphp

<style type="text/css">
	.contestDashboardBtn{
  	border: 1px solid #dddddd;
    background-color: #f9f9f9;
  	color: #606060;
  	font-weight: bold;
  	margin-bottom: 5px;
  	font-size: 13px;
  	padding: 12px;
  	border-radius: 5px;
  }
  .contestDashboardBtn:hover{
  	background-color: #eeeeee;
    border: 1px solid #aaaaaa;
  	color: #000000;
  }
  .contestDashboardBtn:focus{
  	outline: none;
  }
  .sidebarBtn{
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
		<div class="box">
			<div class="header">Settings</div>
			<div class="body" style="min-height: 300px;">
				<button class="contestDashboardBtn sidebarBtn">
              		<i class="fa fa-trophy"></i> Standing
            	</button>
            	<button class="contestDashboardBtn sidebarBtn sidebar-btn-active">
              		<i class="fa fa-trophy"></i> Standing
            	</button>
				@for($i=1; $i<=10; $i++)
				<button class="contestDashboardBtn sidebarBtn">
              		<i class="fa fa-trophy"></i> Standing
            	</button>
            	@endfor
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="box">
			<div class="header">
				@yield('title','Ok')
			</div>
			<div class="body" style="min-height: 300px;">
				@yield('setting-sub-content',view('pages.settings.info'))
			</div>
		</div>
	</div>
</div>

@stop
