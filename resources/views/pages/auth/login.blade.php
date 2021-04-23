
<form action="{{route('login')}}" class="form" id="login" method="post">
        @csrf
        <div class="alert-area">
            <div class="alert alert-danger error-area">ok</div>
            <div class="alert alert-success success-area"></div>
        </div>
        <div class='row' style="margin-bottom: 5px;">
            <div class='col-md-4 label-area'>
                <label> Handle or Email<font color="red">*</font>:</label>
            </div>
            <div class="col-md-8">
                <input type="text" class='form-control-input' name="login" placeholder="Enter Handle or Email">
            </div>
        </div>

        <div class='row'>
            <div class='col-md-4 label-area'>
                <label> Password<font color="red">*</font>:</label>
            </div>
            <div class="col-md-8">
                <input type="password" class='form-control-input' name="password" placeholder="Enter Password">
            </div>
        </div>
        <div class='row'>
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <div>
                    <button type="submit" class="btn submit-btn" onclick="auth.login()" style="margin-top: 15px;">Login</button>
                </div>
            </div>
        </div>
</form>
