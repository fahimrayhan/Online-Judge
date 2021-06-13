@extends('pages.administration.settings.layout.base')
@section('title')
Moderators    
@endsection
@section('languages-sub-content')

    <style type="text/css">


    </style>
    <div class="pull-right" style="margin-bottom: 10px;">
       <a href="{{ route('administration.settings.moderators.reqeusts') }}">Moderator Requests</a>
    </div>
    <table class="table-custom">
        <tr>
            <th>Sl</th>
            <th>Name</th>
            <th>Handle</th>
            <th></th>
        </tr>
        @foreach ($moderators as $key => $moderator)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $moderator->name }}</td>
                <td>{{ $moderator->handle }}</td>
                <td><button class="btn btn-sm btn-danger" onclick="moderator.deleteModerator($(this))" data-url = "{{ route('administration.settings.moderators.delete',['userId' => $moderator->id]) }}">Delete</button></td>
            </tr>
        @endforeach

    </table>
    

@stop
