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
        
        'clearifications' => [
            'icon'  => 'fas fa-trophy',
            'name' => 'Clearifications',
            'url' => route('contest.arena.clearifications',['contest_slug' => request()->contest_slug]),
        ],
        'standings' => [
            'icon'  => 'fas fa-trophy',
            'name' => 'Standings',
            'url' => route('contest.arena.standings',['contest_slug' => request()->contest_slug]),
        ],
        'submissions' => [
            'icon'  => 'fas fa-list',
            'name' => 'Submissions',
            'url' => route('contest.arena.submissions',['contest_slug' => request()->contest_slug]),
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
      <a class="" href="index.php"><img src="http://localhost/project/Online-Judge/file/site_metarial/coderoj_logo.png" height="45px"></a>
    </div>
    <div class="pull-right">
      <div class="collapse navbar-collapse" id="myNavbar">
        @foreach($navbars as $key => $navbar)
          <a href="{{$navbar['url']}}">
            <button class="btn navbar-btn contestNavBtn {{ Request::segment(4) == $key ? 'contestNavBtnActive' : '' }}"><i class="{{$navbar['icon']}}"></i> {{$navbar['name']}}</button>
          </a>
        @endforeach

        <button class="btn contestNavBtn" style="margin-left: 20px">amirhamza05</button>
        <button class="btn contestNavBtn">Logout</button>
      </div>
    </div>
    
  </div>
  </div>
</nav>

<center>
    <div style="margin-top: -30px;" class="alert-warning loader-top-message" id="top-loader-message"><i class="fas fa-spinner fa-pulse"></i>  Loading...</div>
</center>