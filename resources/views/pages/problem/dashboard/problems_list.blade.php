@extends($layout)
@section('title', 'Problems')
@section('content')

<style type="text/css">
	.table-custom{
		width: 100%;
	}
	.table-custom th{
		border: 1px solid #eeeeee;
		background-color: #f7f7f7;
		font-size: 14px;
		padding: 10px 5px 10px 5px;
		text-align: center;
	}
	.table-custom td{
		border: 1px solid #eeeeee;
		font-size: 14px;
		padding: 5px;
		text-align: center;
	}

	.submit-btn{
        background-color: #305485;
        color: #ffffff;
        
        font-weight: bold;
    }
    .submit-btn:focus{
        outline: none;
    }

    .btn:focus{
    	outline: none;
    }

</style>

<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="header">
				<span class="glyphicon glyphicon-list-alt"></span> Problems </div>
			<div class="body" style="min-height: 500px">
				
				<div class="pull-right" style="margin-bottom: 10px;">
					My Problems <input type="checkbox" style="margin-right: 15px;" name=""> 
					Pending Problems <input type="checkbox" style="margin-right: 15px" name=""> 
					<button onclick="new Modal('md',500).load('{{route('problem.create')}}','Create Problem')">Create Problem</button>
				</div>
				<table class="table-custom">
					<tr>
						<th>Slug</th>
						<th>Name</th>
						<th>Owner</th>
						<th>Role</th>
						<th>Created At</th>
						<th>Updated At</th>
						<th></th>
					</tr>
					@foreach($problems as $key=>$problem)
						<tr>
							<td>{{$problem->slug}}</td>
							<td>{{$problem->name}}</td>
							<td><a href="">Owner</a></td>
							<td><span class="label label-success">Owner</span></td>
							<td>{{$problem->created_at}}</td>
							<td>{{$problem->updated_at}}</td>
							<td>
								<a href="{{route('administration.problem.overview',['slug' => $problem->slug])}}"><button title="Edit Problem" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></button></a>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</div>
@stop
