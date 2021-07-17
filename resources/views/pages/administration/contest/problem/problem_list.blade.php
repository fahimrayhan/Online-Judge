@extends("pages.administration.contest.contest")
@section('title', 'Problems')
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
            <th></th>
            <th>Title</th>
            <th>Test Cases</th>
            <th>Owner</th>
            <th></th>
        </tr>
        @foreach ($problems as $key => $problem)
            <tr>
                <td><b>{{ chr($key + 65) }}</b></td>
                <td style="text-align: left;width: 50%"><a modal='true' modal-type='lg' modal-header="View Problem" href="{{route('administration.contest.problems.view',['contest_id' => request()->contest_id,'problem_slug' => $problem->slug])}}">{{ $problem->name }}</a></td>
                <td style="width: 90px">{{ $problem->testCases()->count() }}</td>
                <td><a href="{{route('profile',['handle' => $problem->owner()->handle])}}">{{ $problem->owner()->handle }}</a></td>
                <td>
                    <button class="btn btn-danger" style="padding: 10px;" onclick="Contest.removeProblem($(this))"
                        url="{{ route('administration.contest.remove_problem', ['contest_id' => request()->contest_id, 'problem_id' => $problem->id]) }}">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach

    </table>
@stop
