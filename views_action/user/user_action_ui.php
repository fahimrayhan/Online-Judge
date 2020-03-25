<?php

	if(isset($_POST['updateProfileInfoForm'])){
		echo "info form";
	}

	if(isset($_POST['updatePasswordForm'])){
		 echo "<label for='password'>Old Password <b style='color: #EA2027'>*</b></label><br>
                <input type='password' name='password' placeholder='Enter Your Old Password' id='userPassword'>
        		<label for='password'>New Password <b style='color: #EA2027'>*</b></label><br>
                <input type='password' name='password' placeholder='Enter Your New Password' id='userPassword'>
                <button style='width: 100%'>Update Password</button>
                ";
	}


?>