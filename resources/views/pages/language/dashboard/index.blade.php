@extends($layout)
@section('title', 'Languages')
@section('content')

<style type="text/css">
	

</style>

<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="header">
				<span class="glyphicon glyphicon-list-alt"></span> Languages </div>
			<div class="body" style="min-height: 500px">
				
				<div class="pull-right" style="margin-bottom: 10px;">
					{{-- My Problems <input type="checkbox" style="margin-right: 15px;" name=""> 
					Pending Problems <input type="checkbox" style="margin-right: 15px" name="">  --}}
					<button onclick="new Modal('md',600).load('{{route('languages.create')}}','Create Language')">Create Language</button>
				</div>
				<table class="table-custom">
					<tr>
						<th>Language Name</th>
						<th>Language Short Code</th>
						<th>Is Archive</th>
						<th>Created At</th>
						<th>Updated At</th>
						<th></th>
					</tr>
					@foreach($languages as $key=>$language)
						<tr>
							<td>{{$language->name}}</td>
							<td>{{$language->code}}</td>
							<td>
								@if ($language->is_archive)
									Not visible
								@else
									Visible
								@endif
							<td>{{$language->created_at}}</td>
							<td>{{$language->updated_at}}</td>
							<td>
								<a href=""><button title="Edit Problem" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></button></a>
							</td>
						</tr>
					@endforeach
					
				</table>
			</div>
		</div>
	</div>
</div>
@stop
