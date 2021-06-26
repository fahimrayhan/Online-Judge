<form action="{{route('administration.contest.participant',['contest_id' => request()->contest_id])}}" method="post"  enctype="multipart/form-data">
	@csrf
	<input type="text" name="handle_prefix" placeholder="handle_prefix"><br/>
	<input type="number" name="password_length" placeholder="Password Length"><br/>
	<input type="file" name="data_file"><br/>
	<input type="submit" name=""><br/>
	
</form>