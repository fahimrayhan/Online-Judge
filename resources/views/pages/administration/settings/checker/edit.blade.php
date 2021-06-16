<form action="{{ route('administration.settings.checker.update',['checkerId' => $checker->id]) }}" class="form" id="update_checker" method="post">
    @csrf
    <div class="alert-area">
        <div class="alert alert-danger error-area">ok</div>
        <div class="alert alert-success success-area"></div>
    </div>
    <div class='row' style="margin-bottom: 5px;">
        <div class='col-md-4 label-area'>
            <label> Checker Name<font color="red">*</font>:</label>
        </div>
        <div class="col-md-8">
            <input type="text" class='form-control-input' name="name" placeholder="Enter Checker Name" value="{{ $checker->name }}">
        </div>
    </div>
     <div class='row' style="margin-bottom: 5px;">
        <div class='col-md-4 label-area'>
            <label> Short Description<font color="red">*</font>:</label>
        </div>
        <div class="col-md-8">
            <input type="text"  name="short_description" id="" cols="30" rows="5" class='form-control-input' value="{{ $checker->short_description }}">
        </div>
    </div>
    <div class='row' style="margin-bottom: 5px;">
        <div class='col-md-4 label-area'>
            <label>Description<font color="red">*</font>:</label>
        </div>
        <div class="col-md-8">
            <textarea name="description" id="" cols="30" rows="5" class='form-control-input'>{{ $checker->description }}</textarea>
        </div>
    </div>
    <div class='row' style="margin-bottom: 5px;">
        <div class='col-md-4 label-area'>
            <label> Checker Code<font color="red">*</font>:</label>
        </div>
        <div class="col-md-8">
            <textarea name="code" id="" cols="30" rows="10" class='form-control-input'>{{ $checker->code }}</textarea>
        </div>
    </div>
    <div class='row'>
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <div>
                <button type="submit" class="btn btn-primary" onclick="checker.update()" style="margin-top: 15px;">Update Checker</button>
            </div>
        </div>
    </div>
</form>
