@extends($layout)
@section('title', $problem->name)
@section('content')

<div class="row">
	<div class="col-md-9">
		<div class="box">
			<div class="body">
				@include("pages.problem.layout.default",['problem' => $problem])
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="box">
			<div class="header">Action</div>
			<div class="body">
				<a href="{{route('administration.problem.overview', ['slug' => request()->slug])}}">
					<button class="btn btn-primary">Edit</button>
				</a>
			</div>
		</div>
	</div>
</div>

@stop