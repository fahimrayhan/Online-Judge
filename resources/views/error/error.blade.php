@extends($layout)
@section('title', $message)
@section('content')
	<style type="text/css">
		.error{
			font-family: "Exo 2";
			text-align: center;
			margin-top: 35px;
			margin-bottom: 35px;
		}

.code{
	-webkit-text-fill-color: #2C3542;
	font-size: 15em;
}
.message{
	-webkit-text-fill-color: #2C3542;
    /* Will override color (regardless of order) */
    -webkit-text-stroke-width: 0.07em;
    -webkit-text-stroke-color: #2C3542;
	font-size: 2.7em;
	font-family: "Comic Sans MS", cursive, sans-serif;
}


	</style>
	
	<div class="error">
		<div><span class="code">{{$statusCode}}</span></div>
		<div style="margin-top: -50px"><span class="message">{{$message}}</span></div>
	</div>
@stop
