@extends('layouts.contest_layout')
@section('title', 'Standings')
@section('content')

<style type="text/css">
    .table-standings thead tr th:nth-child(1),.table-standings tbody tr td:nth-child(1){
    width:48px;
    text-align:center
}
.table-standings thead tr th:nth-child(n+4),.table-standings tbody tr td:nth-child(n+4){
    width:64px;
    text-align:center
}
.table-standings tbody tr td .label{
    display:block
}
.table-standings tbody tr td .label:first-child{
    border-radius:.25em .25em 0 0
}
.table-standings tbody tr td .label:last-child{
    border-radius:0 0 .25em .25em
}
.table-standings td:nth-child(n+3) a{
    text-decoration:none
}
.table tbody tr td{
    vertical-align:middle
}
.label{
    min-width: 50px;
}


.label-success{
    background: #41C281;

}
.label-default{
    background: #2c3e50;
}

.label-info{
    background: #2980b9;
}

.label-warning{
    background: #E87F35;
}

.rankList{
    padding: 5px;
}

tr{
    border-color: #3742fa!important;
}

th{
    background: #ffffff;
}

.teamName{
    color: #297FB9!important;
    font-family: "Exo 2";
    font-weight: bold;
    font-size: 14px;
}

.teamNameSub{
    font-size: 13px;
    color: #706788;
    margin-top: -2px;
}

.contestStandingTable th{
    border-width: 0px!important;
    border-color: #eeeeee!important;
}

.contestStandingTable td{
    border-width: 1px!important;
    border-color: #F3F5F8!important;
}

.acLabel{
    background-color: #41C281!important;
}
.waLabel{
    background-color: #E35B5A!important;
}
</style>


<div class="row">
    <div class="col-md-12">
        <div class="contestBox">
        <div class="contestBoxHeader">Rank List</div>
        <div class="contestBoxBody contestStandingTable" style="padding: 0px">
            <div class="table-responsive">
                <table data-reload="no" class="table table-standings">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align: middle;">#</th>
                            <th rowspan="2" style="vertical-align: middle;">Name</th>
                            <th rowspan="2" style="width: 64px;"></th>
                            <th rowspan="2" style="width: 24px;"></th>

                            @foreach($problems as $key => $problem)
                            <th style="width: 64px;"><a href="{{route('contest.arena.problems.view',['contest_slug' => request()->contest_slug,'problem_no' => $problem['no']])}}">{{$problem['no']}}</a></th>
                            @endforeach
                        </tr>
                        <tr>
                        @foreach($problems as $key => $problem)
                            <th class="text-center">{{$problem['solved']}}/{{$problem['attempted']}}</th>
                        @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $rank = 0;

                        foreach($rankList as $key => $value) {
                        $rank ++;
                        $totalSolved = $value['total_solved'];
                        $totalPanalty = $value['total_panalty'];
                        $displayName = $value['main_name'];
                        $displaySubName = $value['sub_name'];
                        ?>
                        <tr data-id="">
                            <td><?php echo "$rank"; ?></td>
                            <td style="min-width: 250px;">
                                <a href="{{route('profile',['handle' => $value['handle']])}}">
                                    <div class="teamName"><?php echo $displayName; ?></div>
                                </a>
                                <div class="teamNameSub"><?php echo $displaySubName; ?></div> 
                            </td>
                            <td>
                                <a  href="{{route('contest.arena.submissions',['contest_slug' => request()->contest_slug,'handle' => $value['handle']])}}">
                                    <div class="label label-info"><?php echo $totalSolved; ?></div>
                                    <div class="label label-default"><?php echo $totalPanalty; ?></div>
                                </a>
                                <td style="width: 26px;"></td>
                            </td>
                           @php
                            foreach($problems as $key => $problem) { 
                            $problemId = $key;

                                    if(!isset($value['problems'][$problemId])){
                                        echo "<td></td>";
                                        continue;
                                    }
                                    $verdict = $value['problems'][$problemId]['verdict'];
                                    $labelClass = "";
                                    if($verdict == 3){
                                        $labelClass = "acLabel";
                                        $iconLabel = "fa fa-check";
                                    }
                                    else {
                                        $labelClass = "waLabel";
                                        $iconLabel = "fa fa-times";
                                    }
                                    $attempted = $value['problems'][$problemId]['attempted'];
                                    $panalty = $value['problems'][$problemId]['panalty'];
                                    $point = $attempted.(($verdict == 3)?" ($panalty)":"");

                           @endphp
                            <td>
                                
                                <a href="{{route('contest.arena.submissions',['contest_slug' => request()->contest_slug,'handle' => $value['handle'],'problem' => $problem['no']])}}">
                                    <div class="label {{$labelClass}}">
                                        <div class="{{$iconLabel}}"></div>
                                    </div>
                                    <div class="label label-default">{{$point}}</div>
                                </a>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
@stop
