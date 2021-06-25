@extends($layout)

@section('content')

<style type="text/css">
    .request-table .td1{
        background-color: #f5f5f5;
        padding: 10px 5px 7px 10px;
        border: 1px solid #eeeeee;
        width: 120px;
        text-align: right;
        font-weight: bold;
    }
    .request-table .td2{
        padding: 10px 5px 7px 10px;
        border: 1px solid #eeeeee;
        width: 300px;
    }
</style>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 offset-2">
        <div class="box">
            <div class="header">Moderator Request</div>
            <div class="body">
                <h4><font title="{{$problem->pivot->created_at}}">{{$problem->pivot->created_at->diffForHumans()}}</font> -  <strong><a href="{{route('profile',['handle' => $problem->owner()->handle])}}">{{ $problem->owner()->handle }}</a></strong> sending a moderator request in problem "<strong>{{$problem->name}}"</strong></h4>
                <table class="request-table" style="font-size: 14px;">
                    <tr>
                        <td class="td1">Problem Name</td>
                        <td class="td2">{{$problem->name}}</td>
                    </tr>
                    <tr>
                        <td class="td1">Owner</td>
                        <td class="td2"><a href="{{route('profile',['handle' => $problem->owner()->handle])}}">{{ $problem->owner()->handle }}</a></td>
                    </tr>
                    <tr>
                        <td class="td1">Created At</td>
                        <td class="td2"><font title="{{$problem->created_at}}">{{$problem->created_at->diffForHumans()}}</font></td>
                    </tr>
                    
                </table>
                <div style="margin-bottom: 15px;"></div>
                <button class="btn btn-success btn-sm" data-url="{{ route('administration.problem.accept_moderator',['slug' => request()->slug]) }}" onclick="problem.acceptProblemModerator($(this))" data-userId = "{{ auth()->user()->id }}"><i class="fa fa-check" aria-hidden="true"></i> Accept</button> 

                <button onclick='problem.cancelProblemModerator($(this))' class='btn btn-sm btn-danger' data-url = "{{ route('administration.problem.cancel_moderator',['slug' => request()->slug]) }}"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
@stop