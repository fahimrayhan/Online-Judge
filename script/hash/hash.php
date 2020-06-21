<?php
class SiteHash {
   	
   	public $hashPrefix=array();
   	public $hashPostfix=array();

   	public function __construct(){
     	//user password
     	$this->hashPrefix['userPassword']="@UsEr#@#PaSs@";
     	$this->hashPostfix['userPassword']="#O@J#";

     	$this->hashPrefix['testCase']="##@@@@@Test@@@@@CaSE";
     	$this->hashPostfix['testCase']="O#######J";

     	$this->hashPrefix['userProfilePhoto']="#user&&&&&&Profile@@@@@";
     	$this->hashPostfix['userProfilePhoto']="#useruser%Photo";

     	$this->hashPrefix['userUplaodFile']="#user&&&&&&Upload@@@@@";
     	$this->hashPostfix['userUplaodFile']="#useruser%File%$";
     	
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
 
	public function commonHashFunction($hashVal){
		return base64_encode(hash('sha256', $hashVal));
	}

	public function commonHashFunction1($hashVal){
		return hash('sha256', base64_encode($hashVal));
	}


	public function generateHashVal($table,$val){
		return $this->commonHashFunction($this->hashPrefix[$table].$val.$this->hashPostfix[$table]);
	}

	public function generateHashVal1($table,$val){
		return $this->commonHashFunction1($this->hashPrefix[$table].$val.$this->hashPostfix[$table]);
	}


	public function userPasswordHash($pass){
		return $this->generateHashVal("userPassword",$pass);
	}

	public function testCaseHash($testCaseId){
		return hash('sha256',$this->generateHashVal("testCase",$testCaseId));
	}

	public function userProfilePhotoHash($userId){
		return $this->generateHashVal1("userProfilePhoto",$userId);
	}

	public function  userUplaodFile($fileId){
		return $this->generateHashVal1("userUplaodFile",$fileId);
	}

 
//end dabtabase connection
}
?>