<?php

	if(isset($_POST['updateProfileInfoForm'])){
		echo "info form";
	}

	if(isset($_POST['updatePasswordForm'])){
		 echo "<div class='label label-success' style='padding: 5px' id='errorLog'></div><div></div><label for='password'>Old Password <b style='color: #EA2027'>*</b></label><br>
                <input type='password' id='oldPass' placeholder='Enter Your Old Password' id='userPassword'>
        		<label for='password'>New Password <b style='color: #EA2027'>*</b></label><br>
                <input type='password' id='newPass' placeholder='Enter Your New Password' id='userPassword'>
                <button id='updatePassBtn' onclick='updatePassword()' style='width: 100%'>Update Password</button>
                ";
	}


?>