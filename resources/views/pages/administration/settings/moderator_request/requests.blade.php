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
                <td>{{ $user->moderatorRequest->message }}</td>
                <td>
                    <button class="btn btn-sm btn-info" onclick="moderator.aproveRequest($(this))" data-url = "{{ route('administration.settings.moderators.request.aprove',['requestId' => $user->moderatorRequest->id]) }}">Aprove</button>
                    <button class="btn btn-sm btn-danger" onclick="moderator.deleteRequest($(this))" data-url = "{{ route('administration.settings.moderators.request.delete',['requestId' => $user->moderatorRequest->id]) }}">Cancle</button>
                </td>
            </tr>
        @endforeach

    </table>

@stop
