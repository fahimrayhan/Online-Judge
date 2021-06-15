@extends('pages.administration.settings.layout.base')
@section('languages-sub-content')

    <style type="text/css">


    </style>
    <div class="pull-right" style="margin-bottom: 10px;">
        <button
            onclick="new Modal('md',600).load('{{ route('administration.settings.checker.create') }}','Create Checker')">Create
            Checker</button>
    </div>
    <table class="table-custom">
        <tr>
            <th>Checker Name</th>
            <th>Checker Description</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th></th>
        </tr>
        @foreach ($checkers as $checker)
            <tr>
                <td>{{ $checker->name }}</td>
                <td>{{ $checker->description }}</td>
                <td>{{ $checker->created_at }}</td>
                <td>{{ $checker->updated_at }}</td>
                <td>
                    <button
                        onclick="new Modal('md',600).load('{{ route('administration.settings.checker.edit',['checkerId' => $checker->id]) }}','Update Checker')"
                        class="btn btn-sm btn-primary" title="Edit Checker"><i class="fa fa-pencil"></i></button>
                        <button
                        onclick="checker.delete($(this))" data-url = "{{ route('administration.settings.checker.delete',['checkerId' => $checker->id]) }}" class="btn btn-sm btn-danger" title="Edit Checker"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </table>

@stop
