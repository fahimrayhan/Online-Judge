@extends('pages.administration.settings.language.base')
@section('languages-sub-content')

    <style type="text/css">


    </style>
    @php
        $archived = isset(request()->archived) ? "checked" : "";
    @endphp
    <div class="pull-right" style="margin-bottom: 10px;">
        Archived Problems <input type="checkbox" style="margin-right: 15px;" location="{{ route('administration.settings.languages') }}" name="" onclick="language.loadArchived($(this))" {{$archived}}> 
        <button
            onclick="new Modal('md',600).load('{{ route('administration.settings.languages.create') }}','Create Language')">Create
            Language</button>
    </div>
    <table class="table-custom">
        <tr>
            <th>Language Name</th>
            <th>Language Short Code</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th></th>
        </tr>
        @foreach ($languages as $key => $language)
            <tr>
                <td>{{ $language->name }}</td>
                <td>{{ $language->code }}</td>
                <td>
                    @if ($language->is_archive)
                        <label class="label label-danger"><i class="fas fa-ban"></i> Archived</label>
                    @else
                        <label class="label label-success"><i class="fas fa-check"></i> Active</label>
                    @endif
                <td>{{ $language->created_at }}</td>
                <td>{{ $language->updated_at }}</td>
                <td>
                    <button
                        onclick="new Modal('md',600).load('{{ route('administration.settings.languages.edit', ['language_id' => $language->id]) }}','Update Language')"
                        class="btn btn-sm btn-primary" title="Edit Language"><i class="fa fa-pencil"></i></button>
                    @php
                        $archiveBtnIcon = $language->is_archive ? 'fas fa-eye' : 'fas fa-eye-slash';
                        $archiveBtnClass = $language->is_archive ? 'btn-success' : 'btn-danger';
                    @endphp
                    <button value='' class='btn btn-sm {{ $archiveBtnClass }}'
                        url="{{ route('administration.settings.languages.toggle_archive', ['language_id' => $language->id]) }}"
                        onclick='language.toggleArchive($(this))' id='updateTestCaseBtn'
                        data-archive-status={{ $language->is_archive }}>
                        <i class="{{ $archiveBtnIcon }}"></i>
                    </button>
                </td>
            </tr>
        @endforeach

    </table>

@stop
