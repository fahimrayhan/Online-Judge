@extends('layouts.contest_layout')
@section('title', 'Contests')
@section('content')


<script type="text/javascript">
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

<div class="row">
	<div class="col-md-12">
    <button class="btn btn-primary pull-right" onclick="printDiv('problem-set')"><i class="fa fa-print"></i> Print Problem Set</button>
		<div id="problem-set" class="contestBoxBody">
			<style type="text/css">
header{
	display: none;
}
footer {
  font-size: 9px;
  color: #f00;
  text-align: center;
  position: running(footer);
}

@page {
  size: A4;
  margin: 0mm;
}

@media print {
  footer {
    position: fixed;
    bottom: 0;
  }

  .problem-single{
  	page-break-after: always;
  	padding: 15mm;
  }

  html, body {
    width: 210mm;
    height: 297mm;
  }
}
			</style>
			@foreach($problems as $key => $problem)
			<div class="problem-single">
				@include('pages.problem.layout.default',['problem' => $problem,'contest_serial' => $key])
			</div>
			@endforeach
		</div>
	</div>
</div>



@stop
