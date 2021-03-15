@php
    $navbar = [
        '' => [
            'icon'  => 'fas fa-home',
            'name' => 'HOME',
            'url' => route('home'),
            'callback' => 'profile.afterLoad'
        ],
        'contest' => [
            'icon'  => 'glyphicon glyphicon-list',
            'name' => 'CONTEST',
            'url' => 'http://127.0.0.1:8000/login',
            'callback' => 'profile.afterLoad'
        ],
        'problems' => [
            'icon'  => 'glyphicon glyphicon-list',
            'name' => 'PROBLEMS',
            'url' => route('problems'),
            'callback' => 'profile.afterLoad'
        ],
        'profile' => [
            'icon'  => 'fas fa-random',
            'name' => 'PROFILE',
            'url' => route('profile',['handle' => 'amirhamza05']),
            'callback' => 'profile.afterLoad()'
        ],
        'ranklist' => [
            'icon'  => 'fas fa-trophy',
            'name' => 'RANK LIST',
            'url' => route('ranklist'),
            'callback' => 'profile.afterLoad'
        ],

    ];
@endphp

<div class="navbar navbar-default navbar-fixed-top navbar-custom" role="navigation">
    <div class="top-loader" style="display: none;" id="top-loader">
      <div class="bar"></div>
    </div>
    <div class="container-fluid" style="margin-top: 5px;">
        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <style type="text/css">.delHoverA:hover{text-decoration: none;}</style>
            <b class="navbar-brand nav-logo">
            <strong>
              <a href="/" class="delHoverA coderOJLogo" >
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
                    <button onclick="auth.loginPage(this)" url="{{route('login')}}" class="btn btn-custom btn-info">Login</button>
                    <button class="btn btn-custom btn-success" onclick="auth.registerPage(this)" url="{{route('register')}}">Register</button>
                @endif

                @if(auth()->check())
                 <li class="dropdown">
                    <button class="nav-profile-btn" data-toggle="dropdown">
                    <img src="http://localhost/project/Online-Judge/user_file/user_photo/24fa9768400dcfc9a8bc9afb33832099459a055173880a36d5d8f32c60eb772b.jpg" >
                    {{auth()->user()->handle}}
                        <b><i class="fas fa-chevron-down"></i></b>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-custom" style="margin-top: -5px;">
                        <span class="dropdown-menu-arrow"></span>
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-md-4" style="text-align: center">
                                        <img src="http://localhost/project/Online-Judge/user_file/user_photo/24fa9768400dcfc9a8bc9afb33832099459a055173880a36d5d8f32c60eb772b.jpg" style="height: 80px; width: 80px;">
                                    </div>
                                    <div class="col-md-8" style="color: #000000">
                                        <strong>{{auth()->user()->handle}}</strong>
                                        <p class="text-left small">{{auth()->user()->email}}</p>
                                        <p class="text-left">
                                            <a href="{{route('profile',['handle' => auth()->user()->handle])}}" class="btn btn-primary btn-block btn-sm">View Profile</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            <a href="{{route('settings')}}" class="btn btn-success btn-block">Setting</a>
                                            <button id="logout-btn" onclick="auth.logout(this)" url="{{route('logout')}}" class="btn btn-danger btn-block">Logout</button>
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