@extends("pages.administration.problem.problem")
@section('title', 'Problem Details')
@section('problem-sub-content')

<div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-primary" style="margin-bottom: 10px;" onclick="new Modal('lg').load('{{route('administration.problem.test_submission.create',['slug' => request()->slug])}}','Create Test Submission')">Create Test Submission</button>
            </div>
        </div>
</div>
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
					<button id="submissionFilterBtn" onclick="submission.filter('{{route('administration.problem.test_submissions',['slug' => request()->slug])}}')" style="width: 150px;" class="btn btn-info">Filter</button>
				</td>
			</tr>
		</table>
	</center>
</div>

<table class="table-custom">
	<tr>
		<th>#</th>
		<th>When</th>
		<th>Who</th>
		<th>Lang</th>
		<th>Verdict</th>
		<th>Time</th>
		<th>Memory</th>
	</tr>
	@foreach($submissions as $key => $submission)
		<tr>
			<td><a modal='true' modal-type='lg' modal-header="Submission #{{$submission->id}}" href="{{route('administration.problem.submission.view',['slug' => request()->slug,'submission_id' => $submission->id])}}"><u>{{$submission->id}}</u></a></td>
			<td>{{$submission->created_at->format('M/d/Y h:i:s')}}</td>
			<td><a href="{{route('profile',[ 'handle' => $submission->user->handle])}}">{{$submission->user->handle}}</a></td>
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

<script type="text/javascript">
	var submissionList = [];
	@foreach($submissions as $key => $submission)
		@if($submission->verdict_id < 3)
			submissionList.push({{$submission->id}});
		@endif
	@endforeach
	//submission.submissionListForSocket = submissionList;
</script>

@stop
