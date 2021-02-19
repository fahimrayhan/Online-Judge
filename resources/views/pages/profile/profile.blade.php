@extends($layout)
@section('title', 'Profile')
@section('content')

	<style type="text/css">
    

    .userInfoTr{
        border: 1px solid #ffffff;
        border-width: 0px 0px 1px 0px;
        padding: 15px;
    }
    .userInfoTd1{
        padding: 5px 2px 2px 2px ;
        width: 150px;
    }

    .btnProfile{
        margin-bottom: 3px;
        text-align: left;
    }

    .profileBtnArea{
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .profileInfoIcon{
        color: #2F353B;
        margin-right: 1px;
    }

    .userStatLeft{
        padding: 4px;
    }
    .userHandle{
        font-size: 22px;
        margin-top: 5px;
        font-weight: bold;
    }
    .userFullName{
        font-size: 18px;
    }

    .userInfoLeft{
        padding: 5px 2px 2px 2px ;
    }

    .userProfileTab{
        background-color: #ffffff;
        border: 1px solid #E7ECF1;
        min-width: 120px;
        padding: 1px;
        font-weight: bold;
        text-align: center; 
    }
</style>
<div class="">
        <div class="row">
            <div class="col-md-3">
                <div class="bannerArea">
                    <div class="box box-body" style="text-align: center;">
                    	<img class="welcomeBanner img-thumbnail " src="http://coderoj.com/user_file/user_photo/f1aeebe4d60da07a91a4adf39683e885e9fa07f2e0f18958f78f651c68ca9eca.jpg">
                    	<div class="userHandle">AmirHamza</div>
                    	<div class="userFullName">Sk.Amir Hamza</div> 
                    </div>
                    
                     
                    <div class="box box-body" style="margin-top: 10px;">
                        <div class="userInfoLeft">
                             <i class="fas fa-university profileInfoIcon"></i> EWU                        </div>
                         <div class="userInfoLeft">
                             <i class="fas fa-envelope profileInfoIcon"></i> sk.amirhamza@gmail.com                        </div>
                         <div class="userInfoLeft">
                             <i class="fas fa-eye profileInfoIcon"></i> Last seen <span style='color:green; font-weight: bold'><span class='onlineIcon'></span>Online Now</span>                        </div>

                        <div class="userInfoLeft">
                             <i class="fas fa-history profileInfoIcon"></i> Join On 03 Aug 2020 05:47:AM                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-9">
                <div class="">
                <ul class="nav nav-tabs">
                    <li class="nav-item userProfileTab box">
                            <a class="nav-link active mixBackground" href="{{route('profile.info')}}">Overview</a>
                    </li>
                    <li class="nav-item userProfileTab" style="background-color: #eeeeee">
                        <a class="nav-link mixBackground" href="profile.php?id=1&action=submission">Submission</a>
                    </li>
                    
                </ul>
                </div>
                <div class="el-card is-always-shadow" style="height: 300px;margin-top: 10px;">
                	@yield('profile-sub-content',view('pages.profile.sub.info'))
                </div>
            </div>
        </div>
</div>

@stop