<form action="{{ route('administration.languages.update',['language_id' => $language->id]) }}" class="form" id="edit_language" method="post">
    @csrf
    @method('PUT')
    <div class="alert-area">
        <div class="alert alert-danger error-area">ok</div>
        <div class="alert alert-success success-area"></div>
    </div>
    <div class='row' style="margin-bottom: 5px;">
        <div class='col-md-4 label-area'>
            <label> Language Name<font color="red">*</font>:</label>
        </div>
        <div class="col-md-8">
            <input type="text" class='form-control-input' name="name" placeholder="Enter Language Name" value="{{ $language->name }}">
        </div>
    </div>
    <div class='row' style="margin-bottom: 5px;">
        <div class='col-md-4 label-area'>
            <label> Language Short Code<font color="red">*</font>:</label>
        </div>
        <div class="col-md-8">
            <input type="text" class='form-control-input' name="code" placeholder="Enter Language Short Code" value="{{ $language->code }}">
        </div>
    </div>
    <div class='row'>
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <div>
                <button type="submit" class="btn submit-btn" onclick="language.update()" style="margin-top: 15px;">Update Language</button>
            </div>
        </div>
    </div>
</form>
