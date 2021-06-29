<style type="text/css">
	.mailList{
		height: 430px;
		overflow-y: scroll;
	}
	.mailBox{
		border: 1px solid #aaaaaa;
		margin-bottom: 5px;
	}
	.mailBoxHeader{
		background-color: #aaaaaa;
		color: #ffffff;
		padding: 5px;
	}
</style>

<div style="border: 0px solid #aaaaaa;border-bottom-width: 1px;padding: 5px;margin-bottom: 5px;">
<select class="form-control" id="selectMaiType" url="{{route('administration.contest.registrations.send_mail_view',['contest_id' => request()->contest_id])}}" onchange ="Contest.viewMail($(this))" style="width: 230px;float: left;margin-right: 10px;">
	@foreach($emailOption as $options)
		<option value="{{$options}}" {{$options == $mailType ? "selected" : ""}}>{{$options}}</option>
	@endforeach
</select>
<button class="btn btn-primary" id="sendConfirmEmail" url="{{route('administration.contest.registrations.send_mail',['contest_id' => request()->contest_id])}}" onclick ="Contest.sendMail($(this))">Send Email Confirm</button>
</div>
<div style="margin-bottom: 5px">
	Total Mail: {{$mailData['totalMail']}}<br/>
	Total Valid Mail: {{$mailData['totalValid']}} (Only valid email can be send)
</div>
<div class="mailList">

@foreach($mailData['data'] as $email)
	<div class="mailBox">
		<div class="mailBoxHeader" style="background-color: {{$email['is_valid'] ? "#27ae60": "#c0392b"}}">{{$email['to']}} ({!!$email['is_valid'] ? "<i class='fa fa-check'></i>": "<i class='fa fa-times'></i> Not valid address"!!})</div>
		<div class="mailBoxBody" style="padding: 5px;">
			{!!$email['body']!!}
		</div>
	</div>



@endforeach


</div>