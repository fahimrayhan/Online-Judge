<style>
  .contestNavBody{
    background-color: #ffffff;
    border-width: 0px;
    box-shadow: 0 0 4px 1px #aaaaaa;
    padding: 1px 0px 1px 0px;
  }
  .contestNavBtn{
    background-color: #F3F3F3;
    border: 1px solid #BBBBBB;
    color: #555555;
    font-weight: bold;
    padding: 6px 12px 6px 12px;
    font-family: "Exo 2";
  }
  .contestNavBtn:hover{
    background-color: #565C66;
    color: #ffffff;
  }
  .contestNavBtnActive{
    background-color: #565C66;
    color: #ffffff;
    font-family: "Exo 2";
  }
  .contestNavBody a{
    text-decoration: none;
  }
</style>

<?php 
 $contestId = 1; 

?>

@php
    $navbars = [
        'problems' => [
            'icon'  => 'fa fa-dashboard',
            'name' => 'Problems',
            'url' => route('contest.arena.problems',['contest_slug' => request()->contest_slug]),
        ],
        'standings' => [
            'icon'  => 'fas fa-trophy',
            'name' => 'Standings',
            'url' => route('contest.arena.standings',['contest_slug' => request()->contest_slug]),
        ],
        'submissions' => [
            'icon'  => 'fas fa-list',
            'name' => 'Submissions',
            'url' => route('contest.arena.submissions.my',['contest_slug' => request()->contest_slug]),
        ],
    ];

@endphp

<nav class="navbar navbar-inverse navbar-fixed-top contestNavBody">
  <div class="container">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <div style="color: #000000!important">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>     
        </div>
                       
      </button>
      <a class="" href="{{route('home')}}"><img src="{{asset("assets/img/coderoj_logo.png")}}" height="45px"></a>
    </div>
    <div class="pull-right">
      <div class="collapse navbar-collapse" id="myNavbar">
        @foreach($navbars as $key => $navbar)
          <a href="{{$navbar['url']}}">
            <button class="btn navbar-btn contestNavBtn {{ Request::segment(4) == $key ? 'contestNavBtnActive' : '' }}"><i class="{{$navbar['icon']}}"></i> {{$navbar['name']}}</button>
          </a>
        @endforeach
        <a href="{{route('profile',['handle' => auth()->user()->handle])}}">
        <button class="btn contestNavBtn" style="margin-left: 20px">{{auth()->user()->name}}</button>
        </a>
        <a href="" onclick="auth.logout(this)" url="{{route('logout')}}">
        <button class="btn contestNavBtn">Logout</button>
        </a>
      </div>
    </div>
    
  </div>
  </div>
</nav>

<center>
    <div style="margin-top: -30px;" class="alert-warning loader-top-message" id="top-loader-message"><i class="fas fa-spinner fa-pulse"></i>  Loading...</div>
</center>