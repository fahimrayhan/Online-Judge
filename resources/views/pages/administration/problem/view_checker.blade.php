@php
	$sourceCode = $checker->code;
 	$geshi = new GeSHi($sourceCode, "c++");
    $geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS,2);
    $geshi->set_line_style('background: #ffffff;', 'background: #ffffff;',true);
    $geshi->set_overall_style('background-color: #ffffff; border-radius: 0px;border: 1px solid #eeeeee;', true);
@endphp

<style type="text/css">
	
</style>

<div style="border: 1px solid #eeeeee;padding: 10px;margin-top: -10px;margin-bottom: 5px;">
	<b>{{$checker->name}} - {{$checker->short_description}}</b><br/>
	<small id="emailHelp" class="form-text text-muted">{{$checker->description}}</small>
</div>

{!!$geshi->parse_code()!!}