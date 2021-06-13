@extends($layout)
@section('title', $problem->name)
@section('content')

<style type="text/css">
	.problem_info_td,.problem_info_td1{
		border: 1px solid #eeeeee;
		font-size: 13px;
		padding: 5px;
	}
	.problem_info_td{
		width: 45%;
	}
</style>

<div class="row">
	<div class="col-md-9">
		<div class="box">
			<div class="body">
				@include('pages.problem.layout.default',['problem' => $problem])
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="box">
			<div class="header">Problem Info</div>
			<div class="body">
				<table width="100%">
					<tr>
						<td class="problem_info_td"><i class="fa fa-info-circle"></i> Problem ID</td>
						<td class="problem_info_td1">{{$problem->id}}</td>
					</tr>
					<tr>
						<td class="problem_info_td"><span class="glyphicon glyphicon-time"></span> Time Limit</td>
						<td class="problem_info_td1">{{$problem->time_limit}} ms</td>
					</tr>
					<tr>
						<td class="problem_info_td"><span class="glyphicon glyphicon-inbox"></span> Memory Limit</td>
						<td class="problem_info_td1"> {{$problem->memory_limit}} KB</td>
					</tr>
					<tr>
						<td class="problem_info_td"><i class="fa fa-user"></i> Moderators</td>
						<td class="problem_info_td1">
							@php
							$moderators = $problem->moderator;
							@endphp
							@foreach($moderators as $key => $moderator)
							<a href="{{route('profile',['handle' => $moderator->handle])}}">{{$moderator->handle}}</a>
							@if(count($moderators)-1 != $key)
								,
							@endif
							@endforeach
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="box">
			<div class="header">Statistics</div>
			<div class="body">
				<div id="chartContainer" style="height: 150px; width: 100%;"></div>
			</div>
		</div>
		<div class="box">
			<div class="header">Submit</div>
			<div class="body">
				<button class="btn btn-info">Submit</button>
			</div>
		</div>
	</div>
</div>
	

<script>
	var problemId=1;

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: ""
	},
	axisY: {
		title: ""
	},
	data: [{        
		type: "column",  
		showInLegend: false, 
		legendMarkerColor: "grey",
		legendText: "AC = Accepted",
		dataPoints: [      
			{ y: {{rand()%100}}, label: "AC" },
			{ y: 114,  label: "WA" },
			{ y: 8,  label: "TLE" },
			{ y: 0,  label: "MLE" },
			{ y: 5,  label: "RTE" },
			{ y: 21, label: "CE" }
		]
	}]
});
chart.render();

</script>

@stop