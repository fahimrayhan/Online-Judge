<?php
class Problem {
   
//starting connection
 	public function __construct(){
     	$this->DB=new Database();
     	$this->conn=$this->DB->conn;
 	}
 
 	public function getProblemList(){

 	}

 	public function getProblemInfo($id,$json=false){
 		$sql="select * from problems where problemId=$id";
 		$data=$this->DB->getData($sql);
 		return $json?json_encode($data[0]):$data[0];
	}

	public function getModeratorProblemList($json=false){
		if(!$this->DB->isLoggedIn)
			return;
		$userId=$this->DB->isLoggedIn;
		$sql="select problem_moderator.*,problems.problemName,problems.cpuTimeLimit,problems.memoryLimit from problem_moderator join problems on problems.problemId=problem_moderator.problemId where problem_moderator.userId=$userId";
		$data=$this->DB->getData($sql);
		return ($json)?json_encode($data):$data;
	}

	public function checkProblemModeratorRoles($problemId){
		$userId=$this->DB->isLoggedIn;
		if($userId==0)return -1;
		$sql="select userRoles from users where userId=$userId";
		$data=$this->DB->getData($sql);
		if($data[0]['userRoles']<=20)return 1;
		if($data[0]['userRoles']==40)return -1;
		$role=$this->checkProblemModerator($problemId,$userId);
		if($role==10)return 1;
		if($role==20)return 2;
		return -1;
	}
	 
	public function checkProblemModerator($problemId,$userId){
		$sql="select * from problem_moderator where problemId=$problemId and userId=$userId";
		$data=$this->DB->getData($sql);
		if(!isset($data[0]))return -1;
		return $data[0]['moderatorRoles'];
	}

 	public function getProblemModeratorList($problemId,$json=false){
 		$sql="select userId,userHandle,userPhoto,moderatorRoles from problem_moderator natural join users where problemId=$problemId";
 		$data=$this->processModeratorData($this->DB->getData($sql));
 		return ($json)?json_encode($data):$data;
 	}

 	public function getNonProblemModeratorList($problemId,$json=false){
		$sql="(select userId,userHandle,userPhoto from users where userRoles<=30) EXCEPT (select userId,userHandle,userPhoto from problem_moderator natural join users where problemId=$problemId)";
 		$data=$this->processModeratorData($this->DB->getData($sql));
 		return ($json)?json_encode($data):$data;
 	}

 	public function addProblemModerator($info){
 		$info['moderatorRoles']=20;
 		$this->DB->pushData("problem_moderator","insert",$info);
	}

	public function deleteProblemModerator($info){
		$chechModeratorRole=$this->checkProblemModerator($info['problemId'],$info['userId']);
		if($chechModeratorRole==-1 || $chechModeratorRole==10){
			return $this->DB->makeJsonMsg(1,"You Can Not Delete Problem Owner");
		}
		return $this->DB->pushData("problem_moderator","delete",$info,true);
	}
	 
	

 	public function processModeratorData($data){
 		foreach ($data as $key => $value) {
 			$value['userPhoto']=($value['userPhoto']==null)?"avatar.jpg":$value['userPhoto'];
 			$value['userPhoto']="file/user_photo/".$value['userPhoto'];
 			$data[$key]=$value;
 		}
 		return $data;
 	}

 	public function updateProblem($info){
 		foreach ($info as $key => $value) {
 			$info[$key]=mysqli_real_escape_string($this->DB->conn, $value);
 		}
 		$this->DB->pushData("problems","update",$info);
 	}


}
?>