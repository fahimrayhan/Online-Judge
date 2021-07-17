@extends("pages.administration.contest.contest")
@section('title', 'Announcements')
@section('contest-sub-content')
<style type="text/css">
    .label-area{
        margin-top: 15px;
    }
    .label-area span{
        
    }
    a:hover,a:focus{
        text-decoration: none;
    }
    .announcement-text{
        font-size: 15px;
    }
</style>
    <div style='text-align: right; margin-bottom: 10px;'><button class="btn btn-primary"
           onclick="new Modal('custom',680).load('{{route('administration.contest.announcements.create',['contest_id' => request()->contest_id])}}','Add Announcement')"><span
                class='glyphicon glyphicon-plus'></span> Add Announcement</button></div>

        @foreach($announcements as $announcement)
            <div class="box-body" style="margin-bottom: 5px;">
                <div class="pull-right" style="margin: 5px;">
                    <button style="padding: 8px;" class="btn btn-sm btn-success" onclick="new Modal('custom',680).load('{{route('administration.contest.announcements.edit',['contest_id' => request()->contest_id,'announcement' => $announcement->id])}}','Update Announcement')"><i class="fa fa-pencil"></i></button>
                    <button style="padding: 8px;" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                </div>
                <div class="announcement-text">
                    {{$announcement->description}}
                </div>
                <div class="label-area">
                    @if($announcement->is_published)
                        <span class="label label-success"><i class="fa fa-check"></i> Published ({{$announcement->updated_at->diffForhumans()}})</span>
                    @endif
                    <span class="label label-primary"><i class="fa fa-user"></i> <a style="color: #ffffff" href="{{route('profile',['handle' => $announcement->user->handle])}}">{{$announcement->user->handle}}</a></span>
                    <span class="label label-info" title="{{$announcement->created_at}}"><i class="fa fa-clock"></i> {{$announcement->created_at->diffForhumans()}}</span>
                </div>
            </div>
        @endforeach
@stop
