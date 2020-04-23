<?php

	if(isset($_POST['updateProfileInfoForm'])){
		$userId=$DB->isLoggedIn;
    $info=$User->getSingleUserInfo($userId);
    $info=$info[0];
    $instituteName=$info['instituteName'];
    $userFullName=$info['userFullName'];
    echo ' <label for="username">Full Name <b style="color: #EA2027">*</b></label>
                <input type="text" value="'.$userFullName.'" placeholder="Enter Your Full Name" autocomplete="off" id="userFullName"><label for="username">Your Institute Name</label>
                <input type="text" value="'.$instituteName.'" placeholder="Enter Your Institute Name" autocomplete="off" id="instituteName"><button id="updateInfoBtn" onclick="updateProfileInfo()" style="width: 100%">Update Info</button>';
	}

	if(isset($_POST['updateProfilePhotoForm'])){ ?>
   		<center>
      	<span id="uploaded_image">
      		<img id="add_profile_pic" class="img-thumbnail userImage" src="<?php echo $loggedInUserInfo['userPhoto']; ?>">
      	</span>
      	<div style="margin-top: 5px"></div>
      	<input type="file" name="file" id="file" onchange="loadFile(event)"  />
      	<button id="updateProfilePhotoBtn" style="margin-top: 10px;width: 100%" onclick="uploadProfilePhoto()" id="">Upload Profile Photo</button>
      	</center>	

	<?php }

	if(isset($_POST['updatePasswordForm'])){
		 if($DB->isLoggedIn==0)return;
     echo "<div class='label label-success' style='padding: 5px' id='errorLog'></div><div></div><label for='password'>Old Password <b style='color: #EA2027'>*</b></label><br>
                <input type='password' id='oldPass' placeholder='Enter Your Old Password' id='userPassword'>
        		<label for='password'>New Password <b style='color: #EA2027'>*</b></label><br>
                <input type='password' id='newPass' placeholder='Enter Your New Password' id='userPassword'>
                <button id='updatePassBtn' onclick='updatePassword()' style='width: 100%'>Update Password</button>
                ";
	}


?>