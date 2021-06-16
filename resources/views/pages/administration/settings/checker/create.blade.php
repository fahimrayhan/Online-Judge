<form action="{{ route('administration.settings.checker.store') }}" class="form" id="create_checker" method="post">
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
            <input type="text" class='form-control-input' name="name" placeholder="Enter Checker Name">
        </div>
    </div>
    <div class='row' style="margin-bottom: 5px;">
        <div class='col-md-4 label-area'>
            <label> Short Description<font color="red">*</font>:</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="short_description" id="" cols="30" rows="5" class='form-control-input' placeholder="Enter Short Description">
        </div>
    </div>
    <div class='row' style="margin-bottom: 5px;">
        <div class='col-md-4 label-area'>
            <label> Checker Description<font color="red">*</font>:</label>
        </div>
        <div class="col-md-8">
            <textarea name="description" id="" cols="30" rows="5" class='form-control-input'></textarea>
        </div>
    </div>
    <div class='row' style="margin-bottom: 5px;">
        <div class='col-md-4 label-area'>
            <label> Checker Code<font color="red">*</font>:</label>
        </div>
        <div class="col-md-8">
            <textarea name="code" id="" cols="30" rows="10" class='form-control-input'></textarea>
        </div>
    </div>
    <div class='row'>
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <div>
                <button type="submit" class="btn btn-primary" onclick="checker.create()" style="margin-top: 15px;">Create Checker</button>
            </div>
        </div>
    </div>
</form>
