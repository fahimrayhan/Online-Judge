@extends('pages.administration.settings.layout.base')
@section('title')
Judge Problem    
@endsection
@section('languages-sub-content')

    <style type="text/css">


    </style>
    <table class="table-custom">
        <tr>
            <th>Problem Name</th>
            <th>Request By</th>
            <th>Added At</th>
            <th></th>
        </tr>
        @foreach ($problems as $problem)
        <tr>
            <td>{{ $problem->name }}</td>
            <td><a href="{{route('profile',['handle' => $problem->judgeProblem->user->handle])}}">{{$problem->judgeProblem->user->handle}}</a></td>
            <td>{{ $problem->judgeProblem->created_at }}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="problem.deleteFromJudgeProblem($(this))" data-url="{{ route('administration.settings.judge_problem.delete_from_judge_problem',['judge_problem_id' => $problem->judgeProblem->id ]) }}">Delete</button>
                @if (!$problem->judgeProblem->is_accepted)
                    <button class="btn btn-sm btn-success" onclick="problem.aproveRequestForJudgeProblem($(this))" data-url="{{ route('administration.settings.judge_problem.requests.aprove',['judge_problem_id' => $problem->judgeProblem->id]) }}">Approved</button>
                @endif
            </td>
        </tr>
            
        @endforeach
    </table>

@stop
