<style type="text/css">
    .welcomeBanner{
        width: 260px;
        height: 260px;
    }
    .bannerArea{
        text-align: center;
    }
    .logoTitle{
        font-size: 35px;
        text-align: center;
        margin-bottom: 10px;
        color: #020202;
        border: 1px solid #f5f5f5;
        background: url("https://thumbs.gfycat.com/UntidySickHairstreak-size_restricted.gif");

        color: var(--bg-color);
        padding: 5px 5px 5px 5px;
        border-width: 0px 0px 2px 0px;
        margin: -15px -15px 10px -15px;

        color: var(--bg-color);
        -webkit-text-fill-color: #eeeeee; /* Will override color (regardless of order) */
        -webkit-text-stroke-width: 0.04em;
        -webkit-text-stroke-color: var(--bg-color);
    }
    .welcomeInfo{
        font-family: New Century Schoolbook, serif;
        margin-top: -5px;
    }

    .bannerImg{
        height: 170px;
        width: 100%;
    }
    .welcomeFeature{
        height: 200px;
        margin-top: 10px;
        text-align: center;
        box-shadow: 3px 3px 3px 1px #888888;
    }
    .featureIcon{
        font-size: 5.5em;
        color: #7f8c8d;
        margin-top: 10px;
        margin-right: 10px;
    }
    .featureName{
        font-size: 18px;
        margin-top: 25px;
        font-weight: bold;
        color: #7f8c8d;
        font-family: "Times New Roman", Times, serif;
    }
    .welcomeFeature:hover{
        cursor: pointer;
        font-size: 15px;
        background: #f5f5f5;
    }

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
<script type="text/javascript">
    var userId=<?php echo "$userId"; ?>
</script>
<script type="text/javascript" src="views/profile/js/script.js"></script>
<?php 
    $userInfo=$userInfo[0];
    $lastLoginTime="";
    $userPhoto=$userInfo['userPhoto'];
    if($userInfo['lastLoginTime']!=""){
        $lastLoginTime=$Site->dateToAgo($userInfo['lastLoginTime']);
    }

    if($lastLoginTime=="Just Now")$lastLoginTime="<span style='color:green; font-weight: bold'><span class='onlineIcon'></span>Online Now</span>";

    $actionPage=(isset($_GET['action']))?$_GET['action']:"info";
    $incluePage="views/profile/user_$actionPage.php";

    $tabActive=array();
    $tabActive['info']=$actionPage=="info"?"active":"";
    $tabActive['submission']=$actionPage=="submission"?"active":"";



    //print_r($userInfo);
?>
<div class="row">
    <div class="col-md-12">

<div class="box">
    <div class="box_body" style="padding: 15px 15px 20px 15px;">
        <div class="row" style="background: url('file/site_metarial/geometry.png')">
            <div class="col-md-3">
                <div class="bannerArea">
                    <img class="welcomeBanner img-thumbnail " src="<?php echo $userPhoto; ?>">
                    <div class="userHandle"><?php echo $userInfo['userHandle']; ?></div>
                    <div class="userFullName"><?php echo $userInfo['userFullName']; ?></div> 
                     
                    <div class="box_body" style="height: auto;margin-top: 10px;text-align: left;padding-right: 0px;">
                        <div class="userInfoLeft">
                             <i class="fas fa-university profileInfoIcon"></i> <?php echo $userInfo['instituteName']; ?>
                        </div>
                         <div class="userInfoLeft">
                             <i class="fas fa-envelope profileInfoIcon"></i> <?php echo $userInfo['userEmail']; ?>
                        </div>
                         <div class="userInfoLeft">
                             <i class="fas fa-eye profileInfoIcon"></i> Last seen <?php echo $lastLoginTime; ?>
                        </div>

                        <div class="userInfoLeft">
                             <i class="fas fa-history profileInfoIcon"></i> Join On <?php echo $DB->dateToString($userInfo['userRegistrationDate']); ?>
                        </div>
                    </div>
                    <?php if($userId==$DB->isLoggedIn){ ?>
                        <div class="profileBtnArea">
                            <button class="btn-sm btnProfile" onclick="updateProfileInfoForm()" title="Update Info"><i class="fas fa-pen"></i></button>
                            <button class="btn-sm btnProfile" onclick="updatePasswordForm()" title="Update Password"><i class="fas fa-key"></i></button>
                            <button class="btn-sm btnProfile" onclick="updateProfilePhotoForm()"><i class="fas fa-image"></i></button>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <div class="col-md-9">
                <div class="welcomeInfo">
                <ul class="nav nav-tabs">
                    <li class="nav-item userProfileTab">
                            <a class="nav-link active" href="profile.php?id=<?php echo $userId; ?>">Info</a>
                    </li>
                    <li class="nav-item userProfileTab">
                        <a class="nav-link" href="profile.php?id=<?php echo $userId; ?>&action=submission">Submission</a>
                    </li>
                    
                </ul>

                <div class="box_body" style="min-height: 480px;border-radius: 0px">
                    <?php include $incluePage; ?>
                </div>
                </div>
            </div>
            <div class="col-md-2">

            </div>
        </div>
        
        
        
    </div>
</div>

</div>
<div class="col-md-3"></div>
</div>
  