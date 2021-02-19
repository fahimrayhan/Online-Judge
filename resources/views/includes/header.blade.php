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
            'url' => route('contests'),
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
            'url' => route('profile'),
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
            <ul class="nav navbar-nav navbar-right">
                <button onclick="auth.loginPage(this)" url='/login' class="btn btn-custom btn-info">Login</button>
                <button class="btn btn-custom btn-success">Registration</button>
                <!-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle navbar-style2" data-toggle="dropdown">
              			<img src="http://localhost/project/Online-Judge/user_file/user_photo/24fa9768400dcfc9a8bc9afb33832099459a055173880a36d5d8f32c60eb772b.jpg" class="navProfileImage">
              			HAMZA05
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <img src="http://localhost/project/Online-Judge/user_file/user_photo/24fa9768400dcfc9a8bc9afb33832099459a055173880a36d5d8f32c60eb772b.jpg" style="height: 80px; width: 80px;">
                                    </div>
                                    <div class="col-lg-8" style="color: #000000">
                                        <p class="text-left"><strong>Nombre Apellido</strong></p>
                                        <p class="text-left small">correoElectronico@email.com</p>
                                        <p class="text-left">
                                            <a href="#" class="btn btn-primary btn-block btn-sm">Actualizar Datos</a>
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
                                            <a href="#" class="btn btn-danger btn-block">Cerrar Sesion</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</div>