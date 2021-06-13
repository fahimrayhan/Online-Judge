@extends('pages.administration.settings.layout.base')
@section('title')
Judge Problem    
@endsection
@section('languages-sub-content')

    <style type="text/css">


    </style>

    <div class="pull-right" style="margin-bottom: 10px;">
        <a href="{{ route('administration.settings.judge_problem.requests') }}">Requests </a>
     </div>
    
    <table class="table-custom">
        <tr>
            <th>Problem Name</th>
            <th>Request By</th>
            <th>Role</th>
            <th>Added At</th>
            <th></th>
        </tr>
        @foreach ($problems as $problem)
        <tr>
            <td>{{ $problem->name }}</td>
            <td>{{ $problem->judgeProblem->user->name}}</td>
            <td>{{ $problem->userRole($problem->judgeProblem->user->id) }}</td>
            <td>{{ $problem->judgeProblem->created_at }}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="problem.deleteFromJudgeProblem($(this))" data-url="{{ route('administration.settings.judge_problem.delete_from_judge_problem',['judgeProblemId' => $problem->judgeProblem->id ]) }}">Delete</button>
            </td>
        </tr>
            
        @endforeach
    </table>

@stop
