@extends('pages.administration.contest.contest')
@section('title', 'Submissions')
@section('contest-sub-content')
<style type="text/css">
    .submissionFilter{
        text-align: center;
        padding-bottom: 10px;
    }
    .filter_td1{
        background-color: #eeeeee;
        padding: 6px 10px 6px 10px;
        border: 1px solid #ffffff;
        text-align: center;
    }
    .filter_td2{
        padding: 6px 10px 6px 10px;
        border: 1px solid #f5f5f5;
        text-align: center;
    }
    .handle-filter-suggestion{
        position: absolute;
        background-color: #ffffff;
        width: 210px;
        margin-top: 5px;
        border: 1px solid #dddddd;
        border-radius: 5px;
        text-align: left;
        padding: 1px;
    }

</style>

<div class="submissionFilter">
    <center>
        <table style="">

            <tr>
                <td class="filter_td2">
                    <input style="width: 210px;" id="submission-filter-handle" class="form-control" type="text" placeholder="User Handle" value="{{request()->handle}}">
                </td>
                <td class="filter_td2">
                    <select class="form-control" id="submission-filter-problem">
                        <option value="">
                            Any Problem
                        </option>
                        @foreach($problems as $key => $problem)
                        <option value="{{$key}}" {{$key == request()->problem ? "selected" : ""}}>{{$key}} . {{$problem->name}}</option>
                        @endforeach
                    </select>
                </td>
                <td class="filter_td2">
                    <select id="submission-filter-language" class="form-control">
                        <option value="">Any Language</option>
                        @foreach($languages as $key => $language)
                        <option value="{{$language->name}}" {{$language->name == request()->language ? "selected" : ""}}>{{$language->name}}</option>
                        @endforeach
                    </select>
                </td>
                <td class="filter_td2">
                    <select id="submission-filter-verdict" class="form-control">
                        <option value="">Any Verdict</option>
                        @foreach($verdicts as $key => $verdict)
                            <option value="{{$verdict->name}}" {{$verdict->name == request()->verdict ? "selected" : ""}}>{{$verdict->name}}</option>
                        @endforeach
                    </select>
                </td>
                <td class="filter_td2">
                    <button id="submissionFilterBtn" onclick="submission.filter('{{route('administration.contest.submissions',['contest_id' => request()->contest_id])}}')" style="width: 150px;" class="btn btn-info">Filter</button>
                </td>
            </tr>
        </table>
    </center>
</div>



<div class="table-responsive">

    <table class="table-custom">
    <tr>
        <th>#</th>
        <th>Author</th>
        <th>Problem</th>
        <th>Time</th>
        <th>Language</th>
        <th>CPU</th>
        <th>Memory</th>
        <th></th>
    </tr>
    @foreach($submissions as $key => $submission)
        <tr>
            <td><a modal='true' modal-type='lg' modal-header="Submission #{{$submission->id}}" href="{{route('administration.contest.submissions.view',['contest_id' => request()->contest_id,'submission_id' => $submission->id])}}"><u>{{$submission->id}}</u></a></td>
           
            <td><a href="{{route('profile',[ 'handle' => $submission->user->handle])}}">{{$users[$submission->user->id]->main_name}}</a><br/>({{$users[$submission->user->id]->handle}})</td>
            <td style="text-align: left;">
                {{$problemsKeyId[$submission->problem->id]['problem_no']}}. {{$submission->problem->name}}</td>
            <td><font title="{{$submission->created_at}}">{{gmdate("H : i : s", $contest->start->diffInSeconds($submission->created_at))}}</font></td>
            <td>{{$submission->language->name}}</td>
            <td><span id="submission_{{$submission->id}}_time">{{$submission->time}} ms</span></td>
            <td><span id="submission_{{$submission->id}}_memory">{{$submission->memory}} kb</span></td>
            <td><span id="submission_{{$submission->id}}_verdict">{!!$submission->verdictStatus()!!}</span></td>
        </tr>
    @endforeach
</table>
                </div>
               <div style="text-align: center;">
    {!! $submissions->appends(request()->input())->links() !!}
</div>
            

@stop
