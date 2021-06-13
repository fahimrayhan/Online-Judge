@extends('pages.administration.settings.layout.base')
@section('title')
Judge Problem    
@endsection
@section('languages-sub-content')

    <style type="text/css">


    </style>

    <div class="pull-right" style="margin-bottom: 10px;">
        <a href="{{ route('administration.settings.judge_problem') }}">Problems</a>
     </div>
    
    <table class="table-custom">
        <tr>
            <th>Problem Name</th>
            <th>Request By</th>
            <th>Role</th>
            <th>Request At</th>
            <th></th>
        </tr>
        @foreach ($judgeProblems as $judgeProblem)
        <tr>
            <td>{{ $judgeProblem->problem->name }}</td>
            <td>{{ $judgeProblem->user->name }}</td>
            <td>{{ $judgeProblem->problem->userRole($judgeProblem->user->id) }}</td>
            <td>{{ $judgeProblem->created_at }}</td>
            <td>
                <button class="btn btn-sm btn-success" onclick="problem.aproveRequestForJudgeProblem($(this))" data-url="{{ route('administration.settings.judge_problem.requests.aprove',['judgeProblemId' => $judgeProblem->id]) }}">Approved</button>
            </td>
        </tr>
            
        @endforeach
    </table>

@stop
