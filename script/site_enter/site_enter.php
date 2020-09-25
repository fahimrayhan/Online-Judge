<?php
class SiteEnter
{

//starting connection
    public function __construct()
    {

        $this->DB   = new database();
        $this->conn = $this->DB->conn;
        $this->Hash = new SiteHash();
    }
    
    public function register($info)
    {

        $error     = 0;
        $error_msg = array();

        array_push($error_msg, $this->fullNameValidator($info['userFullName']));
        array_push($error_msg, $this->handleValidator($info['userHandle']));
        array_push($error_msg, $this->emailValidator($info['userEmail']));
        array_push($error_msg, $this->passwordValidator($info['userPassword'], $info['userCpassword']));

        $msg = "";
        foreach ($error_msg as $key => $value) {
            if ($value != "") {
                $msg .= "<li>$value</li>";
            }

        }

        if ($msg != "") {
            $error = 1;
        }

        if ($error == 0) {
            unset($info['userCpassword']);
            $info['userRegistrationDate'] = $this->DB->date();
            $info['userPassword']         = $this->Hash->userPasswordHash($info['userPassword']);
            $info['userPhoto']            = 'user_file/user_photo/avatar.jpg';
            $response                     = $this->DB->pushData("users", "insert", $info, true);
            $msg                          = "Registration Is Sucessfully Compleated.";
            $response                     = json_decode($response, true);
        }

        if ($error == 0) {
            $_SESSION['oj_login_handle_id'] = $response['insert_id'];
        }

        return $this->DB->makeJsonMsg($error, $msg);
    }

    public function updatePassword($info)
    {
        $oldPass     = $info['oldPass'];
        $newPass     = $info['newPass'];
        $hashOldPass = $this->Hash->userPasswordHash($oldPass);
        $userId      = $this->DB->isLoggedIn;
        $error       = 1;
        $msg         = "";
        if (!$userId) {
            $msg = "User Is Not LoggedIn";
        }
        if ($msg == "") {
            $sql  = "select userPassword from users where userId=$userId";
            $data = $this->DB->getData($sql);
            $msg  = "";
            if ($data['0']['userPassword'] != $hashOldPass) {
                $msg = "Old Password Is Not Correct.";
            }

        }
        if ($msg == "") {
            $msg = $this->passwordValidator($newPass, $newPass);
        }

        if ($msg == "") {
            $data                 = array();
            $data['userId']       = $userId;
            $data['userPassword'] = $this->Hash->userPasswordHash($newPass);
            $this->DB->pushData("users", "update", $data);
            $msg   = "Sucessfully Password Update.";
            $error = 0;
        }
        return $this->DB->makeJsonMsg($error, $msg);
    }

    public function passwordValidator($pass, $cpass)
    {

        $len = strlen($pass);
        if ($len < 6) {
            return "Password Length Must Be Minimum 6";
        }

        if ($pass != $cpass) {
            return "Two Password Not Same";
        }

    }
    public function fullNameValidator($handle)
    {
        if ($handle == "") {
            return "Enter Full Name";
        }

    }

    public function handleValidator($handle)
    {
        $len = strlen($handle);
        if ($len < 4 || $len > 14) {
            return "Handle Length Must Be (4 to 14)";
        }

        if (!preg_match("/^[a-zA-Z0-9\_]*$/", $handle)) {
            return "Handle Is Not Valid";
        }

        $sql  = "select userId from users where userHandle='$handle'";
        $data = $this->DB->getData($sql);
        if (isset($data[0])) {
            return "Handle Is Already Used.";
        }

    }

    public function emailValidator($email)
    {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Email Is Not Valid";
        }

        $sql  = "select userId from users where userEmail='$email'";
        $data = $this->DB->getData($sql);
        if (isset($data[0])) {
            return "Email Is Already Used";
        }

    }

    

}
