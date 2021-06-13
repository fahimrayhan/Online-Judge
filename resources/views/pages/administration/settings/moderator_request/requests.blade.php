@extends('pages.administration.settings.layout.base')
@section('title')
Moderators    
@endsection
@section('languages-sub-content')

    <style type="text/css">


    </style>
    <div class="pull-right" style="margin-bottom: 10px;">
        <a href="{{ route('administration.settings.moderators') }}">Moderators </a>
     </div>
    <table class="table-custom">
        <tr>
            <th>Sl</th>
            <th>Name</th>
            <th>Handle</th>
            <th></th>
        </tr>
        @foreach ($users as $key => $user)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->handle }}</td>
                <td>
                    <button class="btn btn-sm btn-info" onclick="moderator.aproveRequest($(this))" data-userId = {{ $user->id }} data-url = "{{ route('administration.settings.moderators.aprove_moderator_request') }}">Aprove</button>
                    <button class="btn btn-sm btn-danger" onclick="moderator.deleteRequest($(this))" data-userId = {{ $user->id }} data-url = "{{ route('administration.settings.moderators.delete_moderator_request') }}">Delete</button>
                </td>
            </tr>
        @endforeach

    </table>

@stop
