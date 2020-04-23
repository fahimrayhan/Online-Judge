<?php
class User {
   
//starting connection
 public function __construct(){
     
     $this->DB=new Database();
     $this->conn=$this->DB->conn;
 }
 
 public function getUserInfo(){

 	$sql="select * from users";
 	$data=$this->DB->getData($sql);
 	print_r($data);
 }

 public function getSingleUserInfo($userId){
 	$sql="select * from users where userId=$userId";
 	$data=$this->DB->getData($sql);
 	return $data;
 }

 public function updateProfileInfo($data){
 	if(!$this->DB->isLoggedIn)return;
 	$data['userId']=$this->DB->isLoggedIn;
 	$this->DB->pushData("users","update",$data);
 }

 public function updateUserStatus($info){
 	if(!$this->DB->isLoggedIn)return;
 	$data=$this->getUserStatus();
 	$data['userId']=$this->DB->isLoggedIn;
 	$data['lastLoginUrl']=$info['url'];
 	//print_r($data);
 	$this->DB->pushData("users","update",$data);
 }

 public function getUserStatus(){
 	$info=array();
 	
 	if (!empty($_SERVER['HTTP_CLIENT_IP']))   
    	$ip_address = $_SERVER['HTTP_CLIENT_IP'];
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
    	$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else
    	$ip_address = $_SERVER['REMOTE_ADDR'];

 	$info['lastLoginIp']=$ip_address;
 	$info['lastLoginTime']=$this->DB->date();

 	return $info;
 }

}
?>