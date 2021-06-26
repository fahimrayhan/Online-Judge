@extends("pages.administration.contest.contest")
@section('titleSub', 'Contest Problems')
@section('contest-sub-content')
    <style type="text/css">
        .table-custom td {
            padding: 5px;
        }

    </style>
    <div style='text-align: right; margin-bottom: 10px;'><button class="btn btn-primary"
            onclick="Contest.addProblem($(this))"
            url="{{ route('administration.contest.add_problem', ['contest_id' => request()->contest_id]) }}"><span
                class='glyphicon glyphicon-plus'></span> Add Problem</button></div>
    <table width='100%' class="table-custom">
        <tr>
            <th>Problem Id</th>
            <th>Problem Name</th>
            <th>Problem Slug</th>
            <th></th>
        </tr>
        @foreach ($problems as $problem)
            <tr>
                <td>{{ $problem->id }}</td>
                <td>{{ $problem->name }}</td>
                <td>{{ $problem->slug }}</td>
                <td>
                    <button class="btn btn-danger" onclick="Contest.removeProblem($(this))"
                        url="{{ route('administration.contest.remove_problem', ['contest_id' => request()->contest_id, 'problem_id' => $problem->id]) }}">
                        Remove
                    </button>
                </td>
            </tr>
        @endforeach

    </table>
@stop
