@extends($layout)
@section('title', 'Problems')
@section('content')

<div class="row">
	<div class="col-md-9">
		<div class="box">
			<div class="header">
				<span class="glyphicon glyphicon-list-alt"></span> Problems </div>
			<div class="body" style="height: 500px">
				<table>
					<tr>
						<th>id</th>
						<th>id</th>
						<th>id</th>
						<th>id</th>
						
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="box">
			<div class="header">
				<span class="glyphicon glyphicon-list-alt"></span> Difficaulty </div>
			<div class="body">
				
				<span class="label label-success">Easy</span>
				<span class="label label-warning">Medium</span>
				<span class="label label-danger">Hard</span>
			</div>
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="header">
						<span class="glyphicon glyphicon-list-alt"></span> Tags 
					</div>
					<div class="body">
						@for($i=1; $i<=15; $i++)
							<span class="label label-default">Segment Tree</span>
						@endfor
					</div>
				</div>
			</div>
		</div>

	</div>

</div>
@stop
