@extends("pages.administration.problem.problem")
@section('title', 'Problem Overview')
@section('problem-sub-content')
<style type="text/css">
	
	.table-custom td{
		padding: 5px;
	}
</style>
	<div style='text-align: right; margin-bottom: 10px;'><button class="btn btn-success" onclick="new Modal('md').load('{{route('administration.problem.test_case.add',['slug' => request()->slug])}}')"><span class='glyphicon glyphicon-plus'></span> Add Test Case</button></div>
	<table width='100%' class="table-custom">
		<tr>
			<th>Order</th>
			<th>Input File</th>
			<th>Output File</th>
			<th>Sample</th>
			<th>Points</th>
			<th>Added Date</th>
			<th>Added By</th>
			<th></th>
		</tr>
		@php 
			$testCases = $problem->testCases()->get();
			$cnt = 0;
		@endphp
		@foreach ($testCases as $key => $testCase)
		<tr>
			<td>{{++$cnt}}</td>
			<td><a href="{{asset($testCase->input_file)}}" target="_blank">input-{{$cnt}}.txt (2 Bytes)</a> </td>
			<td><a href="{{asset($testCase->output_file)}}" target="_blank">output-{{$cnt}}.txt (2 Bytes)</a></td>
			<td><input type="checkbox" name=""></td>
			<td>{{$testCase->point}}</td>
			<td>{{$testCase->created_at}}</td>
			<td><a href="">fgad</a></td>
			<td>
				<button value='' class='btn btn-sm btn-default' onclick ='' id='updateTestCaseBtn'><span class='glyphicon glyphicon-pencil'></span></button>
				<button value='' class='btn btn-sm btn-danger' onclick ='' id='updateTestCaseBtn'><span class='glyphicon glyphicon-trash'></span></button>
			</td>
		</tr>
		@endforeach
	</table>
@stop
