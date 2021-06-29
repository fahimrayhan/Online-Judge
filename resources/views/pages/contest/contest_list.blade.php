@extends($layout)
@section('title', 'Contests')
@section('content')

<style type="text/css">
	.problem-list{

	}
	.problem-list .problem{
		display: block;
        background: #fff;
        padding: 15px 12px 15px 12px;
        position: relative;
        border: 1px solid #eeeeee;
        margin-bottom: 3px;
        cursor: pointer;
	}
	.problem-list .problem:hover{
		background-color: #f7f7f7;
	}
	.problem-list a{

	}
	.problem-list a:hover,.problem-list a:focus{
		text-decoration: none;
	}

	.problem-list .problem .problem-title{
		font-size: 18px;
		font-weight: bold;
		color: #23528F;
	}
	.problem-list .problem .problem-title i{
		font-size: 10px;

		color: #918a8b;
	}
	.problem-list .problem .problem-sub{
		font-size: 10px;
		color: #636161;
		margin-top: 10px;
		font-family: system-ui;;

	}

	.problem-list .problem .problem-sub span{
		margin-right: 10px;
		border: 1px solid #eeeeee;
		font-size: 12px;
		padding: 5px;
	}

	.label{
		font-size: 12px;
		padding-top: 4px
	}

	
</style>

<div class="row">
	<div class="col-md-9">
		<div class="box">
			<div class="header">
				<span class="glyphicon glyphicon-list-alt"></span> Contests </div>
			<div class="body" style="min-height: 500px">
				<div class="problem-list">
					@foreach($contests as $key => $contest)
					<a href="{{route('contests.info',['contest_slug' => $contest->slug])}}">
					<div class="problem">
						<div class="pull-right" style="margin-top: 20px;font-size: 14px;">
							@if($contest->status == "running")
								<span class="label label-success"><i class="fas fa-hourglass"></i> Running</span>
							@endif

							@if($contest->status == "past")
								<span class="label label-warning"><i class="fa fa-clock-o" aria-hidden="true"></i> Finished</span>
							@endif

							@if($contest->status == "upcomming")
								<span class="label label-primary"><i class="fa fa-clock-o" aria-hidden="true"></i> Upcomming</span>
							@endif
							
							
							
						</div>
						<div class="problem-title">{{$contest->name}}</div>
						<div class="problem-sub">
							<span>Start: <b>{{$contest->start->format('M d Y, g:i A')}}</b></span>
							<span>Duration: <b>{{$contest->duration_in_hours}} hours</b></span>
							<span title="{{$contest->isParticipant() ? 'You can participate this contest' : 'You can not participate this contest'}}"><b style="color: {{$contest->isParticipant() ? 'green' : 'red'}}"><i class="fa fa-flag" aria-hidden="true"></i></b></span>
						</div>

					</div>
					</a>
					@endforeach
				</div>
				<div style="text-align: center;">
					
				</div>
			</div>
		</div>
	</div>
	

</div>
@stop
