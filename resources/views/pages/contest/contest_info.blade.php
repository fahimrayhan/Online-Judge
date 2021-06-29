@extends($layout)
@section('title', $contest->name)
@section('content')
<style type="text/css">

	
	.bannerImg{
		width: 100%;
	}

  .contestInfoBox{
  	background-color: #ffffff;
  	border: 1px solid #eeeeee;
  	box-shadow: 1px 1px 3px #DADADA;
  }

  .contestInfoBody{
  	padding: 15px;
  }

  .contestTitle{
  	font-size: 20px;
  	font-weight: bold;
  }
  .contestInfoList{

  }


  .contest_list_li{
	padding: 10px;
	font-size: 15px;
	font-weight: bold;
	cursor: pointer;
	font-family: "Times New Roman", Times, serif;
	padding: 0px;

  }
  .listIcon{
	color: #7A8E96;
	padding: 10px 10px 10px 10px;
	border-radius: 0px;
	font-size: 25px;
	margin-bottom: 0px;
	text-align: center;
	margin-right: 5px;
  }
  .listLabel{
  	color: #767E96;
  	font-size: 14px;
  }
  .listTitle{
  	font-size: 15px;
  }
  .contestInfoTd{
  	padding-bottom: 10px;
  }
  .contestLabel{
  	padding: 5px;
  	border-radius: 5px;
  }
  .contestInfoBox a:hover{
  	outline: none;
  }
</style>

<script type="text/javascript">
	Contest.setTimer({{$contest->timer()}},"{{$contest->status}}")
</script>

<div class="row">
	
	<div class="col-md-4">
		<div class="box contestInfoBox">
			<img class="bannerImg" src="{{ $contest->banner }}">
			<div style="padding: 10px;">
				<h3 style="font-size: 18px;margin: 10px 0px 10px 0px;">{{$contest->name}}</h3>
				
				<hr style="margin: 10px 0px 10px 0px;">
				<table>
					<tr>
						<td class="contestInfoTd"><i class="fas fa-hourglass listIcon"></i></td>
						<td class="contestInfoTd">
                            <div class="listTitle" id="timerArea">{{gmdate("H : i : s", $contest->timer())}}</div> 
                            <div class="listLabel" id="contestStatusTxt">
                            @if($contest->status == "running")
                            Contest Is Runnning
                            @elseif($contest->status == "upcomming")
                            Contest Is Not Start
                            @else
                            Contest Is End
                            @endif

                        	</div>       
                        </td>
					</tr>
					<tr>
						<td class="contestInfoTd"><i class="fas fa-calendar-alt	listIcon"></i></td>
						<td class="contestInfoTd">
                            <div class="listTitle">{{ $contest->start->format(' M d Y, g:i A') }}</div> 
                            <div class="listLabel">Begin Time</div>       
                        </td>
					</tr>
					<tr>
						<td class="contestInfoTd"><i class="fas fa-clock listIcon"></i></td>
						<td class="contestInfoTd">
                            <div class="listTitle">{{ $contest->duration }} minutes</div> 
                            <div class="listLabel">Length</div>       
                        </td>
					</tr>
					<tr>
						<td class="contestInfoTd"><i class="fas fa-dice-d20	listIcon"></i></td>
						<td class="contestInfoTd">
                            <div class="listTitle">{{ $contest->problems->count() }}</div> 
                            <div class="listLabel">Problems</div>       
                        </td>
					</tr>
					<tr>
						<td class="contestInfoTd"><i class="fas fa-trophy listIcon"></i></td>
						<td class="contestInfoTd">
                            <div class="listTitle">{{ strtoupper($contest->format) }}</div> 
                            <div class="listLabel">Format</div>       
                        </td>
					</tr>
					<tr>
						<td class="contestInfoTd"><i class="fas fa-lock listIcon"></i></td>
						<td class="contestInfoTd">
                            <div class="listTitle">{{ ucfirst($contest->visibility) }}</div> 
                            <div class="listLabel">Visibility</div>       
                        </td>
					</tr>
				</table>

			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="contestInfoBox" style="padding: 10px;">
			<h3>{{$contest->name}}</h3>
			<hr>
			<p>{!!$contest->description!!}</p>
			<hr>
			<div style="padding-bottom: 5px">
				@if($contest->isParticipant() && $contest->status != "upcomming")
				<a href="{{route("contest.arena.problems",['contest_slug' => $contest->slug])}}">
					<button class="btn btn-primary" style="width: 100px;margin-bottom: 3px">Enter Arena</button>
				</a>
				@endif
				@if($contest->status != "upcomming")
				<a href="{{route("contest.arena.standings",['contest_slug' => $contest->slug])}}">
					<button class="btn btn-info" style="width: 100px;margin-bottom: 3px">Standings</button>
				</a>
				@endif
				<hr>
				@if($contest->isParticipant())
					<b><font color="green"><i class="fa fa-flag" aria-hidden="true"></i> You can participate this contest.</font></b>
				@elseif($contest->visibility == "private")
					<b><font color="red"><i class="fa fa-flag" aria-hidden="true"></i> Only invited user can participate.</font></b>
				@endif

					
			</div>
		</div>
	</div>

</div>

<input type="text" id="startcontesttimer" value="start" name="" hidden="">

<script type="text/javascript">
	if(typeof MathJax !== 'undefined') {MathJax.Hub.Queue(["Typeset",MathJax.Hub]);}
</script>

@stop
