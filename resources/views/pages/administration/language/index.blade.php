@extends($layout)
@section('title', 'Languages')
@section('content')

    <style type="text/css">


    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="header">
                    <span class="glyphicon glyphicon-list-alt"></span> Languages
                </div>
                <div class="body" style="min-height: 500px">

                    <div class="pull-right" style="margin-bottom: 10px;">
                        <button
                            onclick="new Modal('md',600).load('{{ route('administration.languages.create') }}','Create Language')">Create
                            Language</button>
                    </div>
                    <table class="table-custom">
                        <tr>
                            <th>Language Name</th>
                            <th>Language Short Code</th>
                            <th>Is Archive</th>
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
                                        Archived
                                    @else
                                        Visible
                                    @endif
                                <td>{{ $language->created_at }}</td>
                                <td>{{ $language->updated_at }}</td>
                                <td>
                                    <button
                                        onclick="new Modal('md',600).load('{{ route('administration.languages.edit', ['language_id' => $language->id]) }}','Update Language')"
                                        class="btn btn-sm btn-primary" title="Edit Language"><i
                                            class="fa fa-pencil"></i></button>
                                    @php
                                        $archiveBtnIcon = $language->is_archive ? 'fas fa-eye' : 'fas fa-eye-slash';
                                        $archiveBtnClass = $language->is_archive ? 'btn-success' : 'btn-danger';
                                    @endphp
                                    <button value='' class='btn btn-sm {{ $archiveBtnClass }}'
                                        url="{{ route('administration.languages.toggle_archive', ['language_id' => $language->id]) }}"
                                        onclick='language.toggleArchive($(this))' id='updateTestCaseBtn'
                                        data-archive-status={{ $language->is_archive }}>
                                        <i class="{{ $archiveBtnIcon }}"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
