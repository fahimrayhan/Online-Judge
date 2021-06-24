@extends($layout)
@section('title', 'Problems')
@section('content')

<style type="text/css">
	.problem-list{

	}
	.problem-list .problem{
		display: block;
        background: #fff;
        padding: 10px 12px 10px 12px;
        position: relative;
        border: 1px solid #eeeeee;
        margin-bottom: 3px;
        cursor: pointer;
	}
	.problem-list .problem:hover{
		background-color: #f7f7f7;
	}
	.problem-list a{

	}
	.problem-list a:hover,.problem-list a:focus{
		text-decoration: none;
	}

	.problem-list .problem .problem-title{
		font-size: 16px;
		font-weight: bold;
		color: #23528F;
	}
	.problem-list .problem .problem-title i{
		font-size: 10px;

		color: #918a8b;
	}
	.problem-list .problem .problem-sub{
		font-size: 10px;
		color: #636161;
		margin-top: 15px;
		font-family: system-ui;;

	}

	.problem-list .problem .problem-sub span{
		margin-right: 10px;
		border: 1px solid #eeeeee;
		padding: 5px;
	}
	
</style>

<div class="row">
	<div class="col-md-9">
		<div class="box">
			<div class="header">
				<span class="glyphicon glyphicon-list-alt"></span> Problems </div>
			<div class="body" style="min-height: 500px">
				<div class="problem-list">
					@foreach($JudgeProblems as $key => $JudgeProblem)
					<a href="{{route('problem.view',['slug' => $JudgeProblem->problem->slug])}}">
					<div class="problem">
						<div class="problem-title">{{$JudgeProblem->problem->name}}</div>
						<div class="problem-sub">
							<!-- <span>ATTEMPTED BY: <b>{{rand()%1000}}</b></span>  -->
							<!-- <span>SUCCESS RATE: <b>88%</b> </span> -->
							<span>LEVEL: <b>Easy</b></div></span>
					</div>
					</a>
					@endforeach
				</div>
				<div style="text-align: center;">
					{{$JudgeProblems->links()}}
				</div>
			</div>
		</div>
	</div>
	

</div>
@stop
