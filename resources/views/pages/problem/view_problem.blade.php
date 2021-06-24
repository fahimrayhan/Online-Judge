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
				@if(auth()->check())
				<button class="btn btn-primary" style="width: 100%" onclick="new Modal('lg').load('{{route('problem.submit',['slug' => request()->slug])}}', 'Submit Your Solution')">Submit</button>
				@else
					You need to <b>Login</b> or <b>Registration</b> for submit your solution
				@endif
			</div>
		</div>
		@if(count($lastSubmissionList) != 0)
		<div class="box">
			<div class="body">
				<table style="width: 100%;font-size: 14px;" >
					@foreach($lastSubmissionList as $key => $submission)
					<tr style="border: 1px solid #E7ECF1; border-width: 0px 0px 1px 0px;">
						<td style="padding: 10px 0px 10px 0px;"><a modal='true' modal-type='lg' modal-header="Submission #{{$submission->id}}" title="{{$submission->created_at}}" href="{{route('submissions.view',['submission_id' => $submission->id])}}">{{$submission->created_at->diffForHumans()}}</a></td>
						<td style="padding: 7px 0px 7px 0px;text-align: right;" id="submissionGlobalVerdictStatus_2960"><span id="submission_{{$submission->id}}_verdict">{!!$submission->verdictStatus()!!}</span></td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
		@endif
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
			{ y: {{$problem->statistics->ac}},  label: "WA" },
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