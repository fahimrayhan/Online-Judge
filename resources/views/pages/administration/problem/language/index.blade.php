@extends("pages.administration.problem.problem")
@section('title', 'Programming Languages')
@section('problem-sub-content')

    <style type="text/css">
    </style>
    <div class="pull-right" style="margin-bottom: 10px;">
        <button
            onclick="new Modal('md',600).load('{{ route('administration.problem.add_languages', ['slug' => request()->slug]) }}','Add Language')">Add
            Languages</button>
    </div>
    <table class="table-custom">
        <tr>
            <th>Language Name</th>
            <th>Language Short Code</th>
            <th>Time Limit</th>
            <th>Memory Limit</th>
            <th></th>
        </tr>
        @foreach ($languages as $language)
            <tr>
                <td>{{ $language->name }}</td>
                <td>{{ $language->code }}</td>
                <td>{{ $language->pivot->time_limit }}</td>
                <td>{{ $language->pivot->memory_limit }}</td>
                <td>
                    <button
                        onclick=""
                        class="btn btn-sm btn-primary" title="Edit Language"><i class="fa fa-pencil"></i></button>
                </td>
            </tr>

        @endforeach

    </table>


@stop
