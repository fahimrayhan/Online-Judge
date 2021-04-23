<form action="{{route('problem.create')}}" class="form" id="create_problem" method="post">
        @csrf
        <div class="alert-area">
            <div class="alert alert-danger error-area">ok</div>
            <div class="alert alert-success success-area"></div>
        </div>
        <div class='row' style="margin-bottom: 5px;">
            <div class='col-md-4 label-area'>
                <label> Problem Name<font color="red">*</font>:</label>
            </div>
            <div class="col-md-8">
                <input type="text" class='form-control-input' name="name" placeholder="Enter Problem Name">
            </div>
        </div>
        <div class='row'>
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <div>
                    <button type="submit" class="btn submit-btn" onclick="problem.create()" style="margin-top: 15px;">Create Problem</button>
                </div>
            </div>
        </div>
</form>
