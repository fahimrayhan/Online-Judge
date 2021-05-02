<form action="{{ route('administration.problem.update_languages', ['slug' => request()->slug,'language_id' => request()->language_id]) }}"
    class="form" id="edit_problem_language" method="post">
    @csrf
    @method('PUT')
    <div class="alert-area">
        <div class="alert alert-danger error-area">ok</div>
        <div class="alert alert-success success-area"></div>
    </div>
    <div class='row' style="margin-bottom: 5px;">
        <div class='col-md-4 label-area'>
            <label> Time Limit (Multiplication of {{ $problem->time_limit }})<font color="red">*</font>:</label>
        </div>
        <div class="col-md-8">
            <input type="number" class='form-control-input' name="time_limit"
                placeholder="Give time limit multiplication" value="{{ $language->pivot->time_limit }}" step="0.001">
        </div>
    </div>
    <div class='row' style="margin-bottom: 5px;">
        <div class='col-md-4 label-area'>
            <label> Memory Limit (Multiplication of {{ $problem->memory_limit }}))<font color="red">*</font>:</label>
        </div>
        <div class="col-md-8">
            <input type="number" class='form-control-input' name="memory_limit"
                placeholder="Give memory limit multiplication" value="{{ $language->pivot->memory_limit }}" step="0.001">
        </div>
    </div>
    <div class='row'>
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <div>
                <button type="submit" class="btn submit-btn" onclick="problem.updateLanguages()"
                    style="margin-top: 15px;">Update Language</button>
            </div>
        </div>
    </div>
</form>
