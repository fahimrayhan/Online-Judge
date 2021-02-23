<style type="text/css">

    .form{
        font-family: "Exo 2";
    }
    
    .form .form-control-input{
        padding: 10px;
        width: 100%;
        border-radius: 3px;
        font-size: 14px;
        color: #585a58;
        border: 1px solid #d4d4d4;
        background-color: #f9f9f9;
        
    }
    .form .form-control-input:focus,
    .form-control:focus {
        outline: none;
        border-radius: 5px;
        border: 1px solid var(--blue);
        box-shadow: 0 0 3px 3px #CCC7D8;
    }
    .form .form-control-input{
        margin-bottom: 5px;
    }
    
    .form label{
        margin-left: 5px;
        margin-top: 10px;
        text-align: right;
    }
    </style>
    
    <form action="{{route('register')}}" class="form" id="register" method="post">
        @csrf
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <div class="row" style="padding: 5px;">
        <div class='row' style="margin-bottom: 5px;">
            <div class='col-md-4'>
                <label> Handle or Email<font color="red">*</font>:</label>
            </div>
            <div class="col-md-8">
                <input type="text" class='form-control-input' name="handle" placeholder="Enter email">
            </div>
        </div>
        <div class='row'>
            <div class='col-md-4'>
                <label> Password<font color="red">*</font>:</label>
            </div>
            <div class="col-md-8">
                <input type="password" class='form-control-input' name="password" placeholder="Enter email">
            </div>
        </div>
        <div class='row'>
            <div class="col-md-12">
                <div class="pull-right">
                    <button type="submit" class="btn btn-success" onclick="auth.login()" style="margin-top: 15px;">Login</button>
                </div>
            </div>
        </div>
    </div>
    </form>
{{route("register")}}