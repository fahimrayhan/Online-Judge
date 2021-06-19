@extends("pages.administration.problem.problem")
@section('title', 'Programming Languages')
@section('problem-sub-content')



<form action="{{ route('administration.problem.save_languages',['slug' => request()->slug]) }}" class="" id="add_languages" method="post">
    @csrf

    <table class="table-custom">
        <tr>
            <th><input type="checkbox" name="" id="allcb" {{$checkAll ? "checked" : ""}}></th>
            <th>Language Name</th>
            <th>Language Short Code</th>
            <th>Time Limit</th>
            <th>Memory Limit</th>
        </tr>
        @foreach ($languages as $language)
            @php
                $timeLimit = isset($language->time_limit) ? $language->time_limit : 1;
                $memoryLimit = isset($language->memory_limit) ? $language->memory_limit : 1;
            @endphp
            <tr>
                <td>
                    <input type="checkbox" class='' name="languages[]" placeholder="Enter Language Name" id="{{ $language->code }}" value="{{ $language->id }}" {{isset($language->is_checked) ? 'checked' : ''}}>
                </td>
                <td width="35%">{{ $language->name }} 
                @if($language->is_archive)
                    <label class='label label-danger'>Archived</label><br/>
                    <small style="margin-top: 5px;" id="emailHelp" class="form-text text-muted">user can not submit using archive language</small>
                @endif
                </td>
                <td>{{ $language->code }}</td>
                <td>
                    <input style="width: 60px;" step="0.01" type="number" name="time_limit[{{$language->id}}]" value="{{$timeLimit}}"> x<br/>
                    <div style="margin-top: 3px;"></div>
                    <small style="margin-top: 5px;" id="emailHelp" class="form-text text-muted">Total: {{ceil($problem->time_limit * $timeLimit)}} ms</small>
                </td>
                <td>
                    <input style="width: 60px;" min="0" step="0.01" type="number" name="memory_limit[{{$language->id}}]" value="{{$memoryLimit}}"> x<br/>
                    <div style="margin-top: 3px;"></div>
                    <small style="margin-top: 5px;" id="emailHelp" class="form-text text-muted">Total: {{ceil($problem->memory_limit * $memoryLimit)}} kb</small>
                </td>
            </tr>

        @endforeach

    </table>

    <div class="row">

        <div class="col-md-12">
            <div class="pull-left" style="margin-top: 10px;">
                <label for="language_auto_update" >Auto select all language list:</label> <input type = 'checkbox' id="language_auto_update" name="language_auto_update"  {{$problem->language_auto_update ? "checked" : ""}}>
                <div class="form-text text-muted" style="margin-top: -5px"><small>(If you want to select perticuler language for submission please not select this.)</small></div>
            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-primary" onclick="problem.addLanguages()" style="margin-top: 10px;">Save Languages</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $('#allcb').change(function () {
        $('tbody tr td input[type="checkbox"]').prop('checked', $(this).prop('checked'));
    });

</script>


@stop
