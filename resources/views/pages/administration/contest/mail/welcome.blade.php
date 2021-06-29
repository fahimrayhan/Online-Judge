
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		 th, td {
  border: 1px solid #aaaaaa;
}
	td{
		
		padding: 5px;
	}
</style>
</head>
<body>
Dear {{$user->name}},<br/><br/>
Thank you for registering for <b>{{$contest->name}}</b>. The contest will take place at https://coderoj.com <br/><br/>
<b>Start Time:</b> {{$contest->start->format('M d Y, g:i A')}}.<br/>
<b>Duration:</b> {{$contest->durationInHours}} hours.<br/>
<b>Contest Link:</b> {{route('contests.info',['contest_slug' => $contest->slug])}}<br/><br/>
@if($user->is_temp_user)
<table width="400px">
	<tr>
		<td colspan="2" style="background-color: #eeeeee;">Login Credientials</td>
	</tr>
	<tr>
		<td style="width: 130px;background-color: #f5f5f5;">Handle</td>
		<td>{{$user->handle}}</td>
	</tr>
	<tr>
		<td style="width: 130px;background-color: #f5f5f5;">Password</td>
		<td>{{$user->temp_user_password}}</td>
	</tr>
</table><br/>
@endif
Hope you have a nice contest!<br/><br/>
Wish You Best of Luck,<br/>
CoderOJ Team
</body>
</html>


