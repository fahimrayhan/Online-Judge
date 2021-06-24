@extends($layout)
@section('title', 'Submissions')

@section('content')

<div class="box">
	<div class="header">Submissions</div>

<div class="body" style="min-height: 500px">
<style type="text/css">
	.submissionFilter{
		text-align: center;
		padding-bottom: 10px;
	}
	.filter_td1{
		background-color: #eeeeee;
		padding: 6px 10px 6px 10px;
		border: 1px solid #ffffff;
		text-align: center;
	}
	.filter_td2{
		padding: 6px 10px 6px 10px;
		border: 1px solid #f5f5f5;
		text-align: center;
	}
	.handle-filter-suggestion{
		position: absolute;
		background-color: #ffffff;
		width: 210px;
		margin-top: 5px;
		border: 1px solid #dddddd;
		border-radius: 5px;
		text-align: left;
		padding: 1px;
	}
	.table-submission td{
	}

</style>

<div class="submissionFilter">
	<center>
		<table style="">

			<tr>
				<td class="filter_td2">
					<input style="width: 210px;" id="submission-filter-handle" class="form-control" type="text" placeholder="User Handle" value="{{request()->handle}}">
				</td>
				<td class="filter_td2">
					<select id="submission-filter-language" class="form-control">
						<option value="">Any Language</option>
						@foreach($languages as $key => $language)
						<option value="{{$language->name}}" {{$language->name == request()->language ? "selected" : ""}}>{{$language->name}}</option>
						@endforeach
					</select>
				</td>
				<td class="filter_td2">
					<select id="submission-filter-verdict" class="form-control">
						<option value="">Any Verdict</option>
						@foreach($verdicts as $key => $verdict)
							<option value="{{$verdict->name}}" {{$verdict->name == request()->verdict ? "selected" : ""}}>{{$verdict->name}}</option>
						@endforeach
					</select>
				</td>
				<td class="filter_td2">
					
				</td>
			</tr>
		</table>
	</center>
</div>

<table class="table-custom table-submission">
	<tr>
		<th>#</th>
		<th>Time</th>
		<th>Who</th>
		<th>Problem</th>
		<th>Lang</th>
		<th>Verdict</th>
		<th>CPU</th>
		<th>Memory</th>
	</tr>
	@foreach($submissions as $key => $submission)
		<tr>
			<td style="padding: 8px 0px 8px 0px"><a modal='true' modal-type='lg' modal-header="Submission #{{$submission->id}}" href="{{route('submissions.view',['submission_id' => $submission->id])}}"><u>{{$submission->id}}</u></a></td>
			<td>{{$submission->created_at->diffForHumans()}}</td>
			<td><a href="{{route('profile',[ 'handle' => $submission->user->handle])}}">{{$submission->user->handle}}</a></td>
			<td><a href="{{route('problem.view',[ 'slug' => $submission->problem->slug])}}">{{$submission->problem->name}}</a></td>
			<td>{{$submission->language->name}}</td>
			<td><span id="submission_{{$submission->id}}_verdict">{!!$submission->verdictStatus()!!}</span></td>
			<td><span id="submission_{{$submission->id}}_time">{{$submission->time}} ms</span></td>
			<td><span id="submission_{{$submission->id}}_memory">{{$submission->memory}} kb</span></td>
		</tr>
	@endforeach
</table>

<div style="text-align: center;">
    {!! $submissions->appends(request()->input())->links() !!}
</div>
</div>

@stop