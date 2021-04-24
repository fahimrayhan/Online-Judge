
<style type="text/css">
	.problem-top-area{
		margin-bottom: 30px;
	}
	.problem-top-area .name{
		font-size: 25px;
		font-weight: bold;
		margin-bottom: 15px;
	}
	.problem-top-area .limit{
		margin-bottom: 15px;
	}
	.problem-statement-block{
		margin-bottom: 20px;
	}
	.problem-statement-block .title{
		font-size: 17px;
		font-weight: bold;
		margin-top: 30px;
		margin-bottom: 5px;
		color: #222222;
	}
</style>

<div class="problem-top-area">
 	<div class="name">{{$problem->name}}</div>
 	<div class="limit">
 		Time: {{$problem->time_limit/1000}} s<br>
		Memory: 12.5 MB
	</div>
</div>

<div class="problem-statement-block">
	{!!$problem->problem_description!!}
</div>
<div class="problem-statement-block">
	<div class="title">Input</div>
	{!!$problem->input_description!!}
</div>
<div class="problem-statement-block">
	<div class="title">Constraint</div>
	{!!$problem->constraint_description!!}
</div>
<div class="problem-statement-block">
	<div class="title">Output</div>
	{!!$problem->output_description!!}
</div>
@if(trim($problem->notes != ""))
	<div class="problem-statement-block">
		<div class="title">Notes</div>
		{!!$problem->notes!!}
	</div>
@endif


<script type="text/javascript">
	if(typeof MathJax !== 'undefined') {MathJax.Hub.Queue(["Typeset",MathJax.Hub]);}
</script>