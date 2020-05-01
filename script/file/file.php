<?php
class File {
   
 	public function __construct(){
     	$this->DB=new Database();
     	$this->conn=$this->DB->conn;
     	$this->Hash=new SiteHash();
 	}

 	function getUserFileList(){
 		$userId=$this->DB->isLoggedIn;
 		$sql="select * from file_upload where userId=$userId order by fileUploadId DESC";
 		$info=$this->DB->getData($sql);
 		return $info;
 	}

 	public function uploadFile($fileInfo){
 		if($this->DB->userRole>30)return;
        $userId=$this->DB->isLoggedIn;

 		$insertData=array();
 		$insertData['userId']=$userId;
 		$insertData['addedDate']=$this->DB->date();
 		$response = $this->DB->pushData("file_upload","insert",$insertData,true);
 		$response=json_decode($response,true);
 		$fileId=$response['insert_id'];

 		$fileExplode     = explode('.', $fileInfo["file"]["name"]);
    	$fileExt      = end($fileExplode);
    	$fileName     = $this->Hash->userUplaodFile($fileId).".$fileExt";
    	$uploadLocation = 'file/user_file/' . $fileName;
    	move_uploaded_file($fileInfo["file"]["tmp_name"], $uploadLocation);
    	$data=array();
    	$data['fileUploadId']=$fileId;
    	$data['fileName']=$fileName;
    	$data['filePath']=$uploadLocation;
    	$data['fileType']=$fileExt;
    	$data['fileSize']=$fileInfo['file']['size'];
    	return $this->DB->pushData("file_upload","update",$data,true);
 	}

 	public function deleteFile($filePath){
 		$data=array();
 		unlink($filePath);
 		$data['filePath']=$filePath;
 		return $this->DB->pushData("file_upload","delete",$data,true);
 	}
 
}
?>