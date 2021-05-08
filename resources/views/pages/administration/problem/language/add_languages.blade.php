<form action="{{ route('administration.problem.save_languages',['slug' => request()->slug]) }}" class="form" id="add_languages" method="post">
    @csrf
    <div class="alert-area">
        <div class="alert alert-danger error-area">ok</div>
        <div class="alert alert-success success-area"></div>
    </div>
    <div class='row' style="margin-bottom: 5px;">
        <div class='col-md-12'>
            <label> Select Languages<font color="red">*</font>:</label>
        </div>
        
        <div class="col-md-12" style="margin-bottom: 5px; margin-left: 5px;">
            <table class="table-custom" >
                <tr>
                    <th></th>
                    <th>Language Name</th>
                    <th>Time Limit</th>
                    <th>Memory Limit</th>
                </tr>
                @foreach ($languages as $key => $language)
                <tr>
                    <td><input type="checkbox" class='' name="languages[]" placeholder="Enter Language Name" id="{{ $language->code }}" value="{{ $language->id }}" @if ($problem->hasLanguage($language->id)) checked @endif></td>
                    <td style="text-align: left;">
                        <label for="{{ $language->code }}">{{ $language->name }}</label>
                        
                    </td>
                    <td><input type="number" step="0.01" name="time_limit[{{$language->id}}]" value="1">x</td>
                    <td><input type="number" step="0.01" name="memory_limit[{{$language->id}}]" value="1">x</td>
                </tr>
                @endforeach               
            
            </table>        
        </div>
        
    </div>
    <div class='row'>
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <div>
                <button type="submit" class="btn submit-btn" onclick="problem.addLanguages()" style="margin-top: 15px;">Add Languages</button>
            </div>
        </div>
    </div>
</form>
