@php
    $navbar = [
        '' => [
            'icon'  => 'fas fa-home',
            'name' => 'HOME',
            'url' => route('home'),
            'callback' => ''
        ],

        'contests' => [
            'icon'  => 'glyphicon glyphicon-list',
            'name' => 'CONTESTS',
            'url' => route('contests'),
            'callback' => ''
        ],
        
        'problems' => [
            'icon'  => 'glyphicon glyphicon-list',
            'name' => 'PROBLEMS',
            'url' => route('problems'),
            'callback' => ''
        ],
        'submissions' => [
            'icon'  => 'fas fa-random',
            'name' => 'SUBMISSIONS',
            'url' => route('submissions'),
            'callback' => ''
        ],

    ];
@endphp

<style type="text/css">
    .navbar-login .option-list{
        padding: 10px 2px 10px 2px;
        border: 1px solid #eeeeee;
        border-width: 0px 0px 1px 0px;
    }
    .navbar-login a{
        color: #2C3542;
    }
    .navbar-login a:focus{
        background: #ffffff;
    }
    .navbar-login a:hover{
        text-decoration: none;
        background-color: #f5f5f5;
    }
    .navbar-login a:hover i{
        color: #1A6FC9;
    }
    .delHoverA:focus{text-decoration: none;color: #ffffff}
</style>

<div class="navbar navbar-default navbar-fixed-top navbar-custom" role="navigation">
    <div class="top-loader" style="display: none;" id="top-loader">
      <div class="bar"></div>
    </div>
    <div class="container-fluid container" style="margin-top: 5px;">
        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <style type="text/css">.delHoverA:hover{text-decoration: none;}</style>
            <b class="navbar-brand nav-logo">
            <strong>
              <a href="{{route('home')}}" class="delHoverA coderOJLogo" >
                CoderOJ<strong color="#ced6e0;"><sup>&alpha;</sup></strong>
              </a>
            </strong>
          </b>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                @foreach($navbar as $key => $value)
                  <li id="navbar-{{$value['name']}}" class="{{ Request::segment(1) == $key ? 'nav-active' : '' }}">

                    <a href="{{$value['url']}}" callback="{{$value['callback']}}">
                      <i class="{{$value['icon']}} span_icon"></i>{{$value['name']}}
                    </a>
                  </li>
                @endforeach
             </ul>
             <script>
                 $(document).on('click', '.navbar-right .dropdown-menu', function (e) {
                    e.stopPropagation();
                });
             </script>
            <ul class="nav navbar-nav navbar-right">
                @if(!auth()->check())
                    <div class="sign-area">
                        <span onclick="auth.loginPage(this)" url="{{route('login')}}" class="btn btn-sign"><i class="fas fa-sign-in-alt"></i> Login</span>
                        <span class="btn btn-sign" onclick="auth.registerPage(this)" url="{{route('register')}}"><i class="fas fa-user-plus"></i> Register</span>
                    </div>
                @endif

                @if(auth()->check())
                 <li class="dropdown">
                    <button class="nav-profile-btn" data-toggle="dropdown">
                    <img src="{{ auth()->user()->avatar }}" >
                    {{auth()->user()->name}}
                        <b><i class="fas fa-chevron-down"></i></b>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-custom" style="margin-top: -5px;">
                        <span class="dropdown-menu-arrow"></span>
                        <li>
                            <div class="navbar-login">
                                <a href="{{route('profile',['handle' => auth()->user()->handle])}}">
                                <div class="row">
                                    <div class="col-md-12" style="color: #000000;text-align: center;margin-top: 5px;">
                                        <img class="img-thumbnail" src="{{ auth()->user()->avatar }}" style="height: 75px; width: 75px;border-radius: 50%"><br/>
                                        <b style="font-size: 15px;">{{auth()->user()->name}}</b>
                                        <p class="text-center small">{{auth()->user()->handle}}</p>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12" style="text-align: left;margin-top: -15px;" >
                                        <p>
                                            <a href="{{route('administration')}}" class="">
                                            <div class="option-list">
                                                <div class="row" style="color: #2C3542">
                                                    <div class="col-md-2" style="font-size: 35px">
                                                        <i class="fas fa-shield-alt"></i>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        
                                                    <b>Administration</b><br/>
                                                    <small id="checker-description" class="form-text text-muted">Control site administration</small>
                                                
                                                    </div>
                                                </div>
                                            </div>
                                            </a>
                                            <a href="{{route('settings.general')}}">
                                            <div class="option-list">
                                                <div class="row" style="color: #2C3542">
                                                    <div class="col-md-2" style="font-size: 35px">
                                                        <i class="fa fa-cog"></i>
                                                    </div>
                                                    <div class="col-lg-10"><b>
                                                        Setting</b><br/>
                                                    <small id="checker-description" class="form-text text-muted">Access account settings</small>
                                               
                                                    </div>
                                                </div>
                                            </div>
                                             </a>
                                             <a href="" onclick="auth.logout(this)" url="{{route('logout')}}">
                                            <div class="option-list">
                                                <div class="row" style="color: #2C3542">
                                                    <div class="col-md-2" style="font-size: 35px">
                                                        <i class="fa fa-sign-out"></i>
                                                    </div>
                                                    <div class="col-lg-10"><b>
                                                         Logout</b><br/>
                                                    <small id="checker-description" class="form-text text-muted">Logout from your account</small>
                                                
                                                    </div>
                                                </div>
                                            </div>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>

<center>
    <div class="alert-warning loader-top-message" id="top-loader-message"><i class="fas fa-spinner fa-pulse"></i>  Loading...</div>
</center>
