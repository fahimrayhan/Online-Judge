@extends($layout)

@section('content')
<style type="text/css">
	.pendingTxt,.notPermit{
		font-size: 14px;
	}

	.pendingTxt{
		color: #27ae60;
	}
	.notPermit{
		color: #c0392b;
	}

	.request-icon{
		font-size: 8em;
	}

	.notPermiti{
		font-size: 14px;
		color: #e74c3c;
	}
</style>

<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
	<div class="box">
	<div class="header">Moderator Request</div>
	<div class="body">
		
		<div class="row">
			<div class="col-md-3">
				<center><i class="fas fa-shield-alt request-icon"></i></center>
			</div>
			<div class="col-md-9">
				<b>If you are a moderator you can use those feature:</b><br/>
				<ul style="margin-top: 5px;">
				<li>You can moderate problems</li>
					<li>You can arrange contest</li>
				</ul>
				<div style="border-top: 1px solid #eeeeee; padding-top: 10px;">
					@if(auth()->user()->moderatorRequest)
					<b style="color: #27ae60"><i class="fa fa-clock-o "></i> Your Request is Pending. Please Waiting for Admin Response.</b>
 					@else
 					<b>Why you want to be a moderator?</b><br/>
 					<textarea rows="3" cols="25"></textarea><br/>
 					<button class="btn btn-success btn-sm" style="margin-top: 10px;" id="sendReqBtn" onclick='problem.requestForModerator($(this))' data-url = "{{ route('request_for_moderator') }}"><i class="fa fa-paper-plane" aria-hidden="true"></i>
 Send Moderator Request</button>
 					@endif
				</div>
			</div>
		</div>

	
	</div>
	</div>
</div>
<div class="col-md-2"></div>
</div>


@stop