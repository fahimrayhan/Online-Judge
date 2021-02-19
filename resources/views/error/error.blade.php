@extends($layout)
@section('title', 'Page Not Found')
@section('content')
	<style type="text/css">
		.error{
			text-align: center;
			margin-top: 30px;
		}
		.error-img{
			height: 150px;
			width: 160px;
		}
		.error-code{
			font-size: 12em;
			font-weight: bold;
			margin-top: -50px;
		}
		.error-details{
			font-size: 2em;
			font-weight: bold;
			margin-top: -50px;
		}
	</style>
	<div class="error">
		<img class="error-img" src="https://www.pngkey.com/png/full/54-543791_clipart-smiley-emoji-face-and-big-image-black.png">
		<div class="error-code">404</div>
		<div class="error-details">Page Not Found</div>
	</div>
@stop
