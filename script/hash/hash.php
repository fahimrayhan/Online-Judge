<?php
class SiteHash {

   	public function __construct(){
     	
 	}

 	public function getRandomString($len=15){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomString = "";
        for ($i = 0; $i < $len; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        }
        return $randomString;
    }

    public function getHash($hashId){
        $randomString = $this->getRandomString(); 
        $rendomId = uniqid();
        $hashString = "$rendomId-@-$hashId-@-$randomString";
        $hashVal = hash('sha256', $hashString);
        return $hashVal;
    }

	public function userPasswordHash($pass){
		return hash('sha256',$pass);
	}

	public function userProfilePhotoHash($userId){
		return $this->getHash($userId);
	}

	public function  userUplaodFile($fileId){
		return $this->getHash($fileId);
	}

 
//end dabtabase connection
}
?>