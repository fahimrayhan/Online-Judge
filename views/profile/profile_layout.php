<style type="text/css">
	.userImage{
		height: 160px;
		width: 150px;
	}
	.sideBarText{
		font-size: 16px;
		margin-top: 5px;
		font-weight: bold;
	}
	.btnUser{
		width: 100%;
		margin-bottom: 3px;
	}
	.buttonArea{
		margin-top: 15px;
	}
	.color1{
		background-color: #c0392b;
		color: #ffffff;
	}
	.color2{
		background-color: #16a085;
		color: #ffffff;
	}
	.color3{
		background-color: #8e44ad;
		color: #ffffff;
	}

	.color4{
		background-color: #283339;
		color: #E3E3E5;
	}
	.userInfoTr{
		border: 1px solid #DDDDDD;
		border-width: 0px 0px 1px 0px;
		padding: 15px;
	}
	.userInfoTd1{
		padding: 15px 2px 2px 2px ;
		width: 160px;
		font-weight: bold;

	}
	.onlineIcon{
		height: 80px;
		width:80px;
		background-color: #4cd137;
		border-radius: 50%;
		border:1.5px solid white;
	}
	.profileBadge{
		height: 90px;
		width: 80px;
		position: absolute;
		text-align: right;
		margin-left: -60px;
		margin-top: -10px;
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

	if($lastLoginTime=="Just Now")$lastLoginTime="<span style='color:green; font-weight: bold'><span class='onlineIcon'></span>Online Now</span>"

	//print_r($userInfo);
?>

<div class="col-md-3">
	<div class="box">
		<div class="box_body" style="text-align: center; height: 380px;">
			<img class="img-thumbnail userImage" src="<?php echo $userPhoto; ?>">
			<span class='onlineIcon'></span>
			<div class="sideBarText">
				<?php echo $userInfo['userHandle']; ?>
			</div>
			<?php if($DB->isLoggedIn==$userId){ ?>
			<div class="buttonArea">
				<button class="btnUser" onclick="updateProfileInfoForm()">Update Info</button>
				<button class="btnUser" onclick="updateProfilePhotoForm()">Update Photo</button>
				<button class="btnUser" onclick="updatePasswordForm()">Update Password</button>
			</div>
			<?php } else{ ?>
				

			<?php } ?>
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="box">
		<div class="box_body" style="height: 350px; padding: 30px 15px 15px 15px;">
			
			<table width="100%">
				<tr class="userInfoTr">
					<td class="userInfoTd1">Handle</td>
					<td class="userInfoTd2"><?php echo $userInfo['userHandle']; ?></td>
				</tr>
				<tr class="userInfoTr">
					<td class="userInfoTd1">Full Name</td>
					<td class="userInfoTd2"><?php echo $userInfo['userFullName']; ?></td>
				</tr>
				<tr class="userInfoTr">
					<td class="userInfoTd1">Email</td>
					<td class="userInfoTd2"><?php echo $userInfo['userEmail']; ?></td>
				</tr>
				<tr class="userInfoTr">
					<td class="userInfoTd1">Institute Name</td>
					<td class="userInfoTd2"><?php echo $userInfo['instituteName']; ?></td>
				</tr>
				<tr class="userInfoTr">
					<td class="userInfoTd1">Last Login</td>
					<td class="userInfoTd2"><?php echo $lastLoginTime; ?></td>
				</tr>
				<tr class="userInfoTr">
					<td class="userInfoTd1">Join</td>
					<td class="userInfoTd2"><?php echo $DB->dateToString($userInfo['userRegistrationDate']); ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<div class="col-md-3">
	<div class="box">
		<div class="box_body" style="height: 335px;">
			<div class="buttonArea">
				<button class="btnUser">Submission</button>
			</div>
		</div>
	</div>
</div>
