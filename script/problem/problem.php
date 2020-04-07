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

	public function  getAllJudgeProblemList($where="",$json=false){
		$where=($where=="")?"":"where ".$where;
		$sql="select judge_problem_list.*,problems.problemName from judge_problem_list join problems on problems.problemId=judge_problem_list.problemId $where";
		$data=$this->DB->getData($sql);
 		return $json?json_encode($data):$data;
	}

	public function checkProblemInJudgeList($problemId){
		$sql="select * from judge_problem_list where problemId=$problemId and status=1";
		$data=$this->DB->getData($sql);
		return isset($data[0])?1:0;
	}	

	public function addProblem($info){
		$error="";

		if($info['memoryLimit']=='')unset($info['memoryLimit']);
		if($info['cpuTimeLimit']=='')unset($info['cpuTimeLimit']);

		if($info['problemName']==""){
			$error.="<li>Problem Name Field Is Empty</li>";
		}

		if($error!="")return $this->DB->makeJsonMsg(1,$error);
		
		$info['userId']=$this->DB->isLoggedIn;
		$info['problemAddedDate']=$this->DB->date();
		
		$res=$this->DB->pushData("problems","insert",$info,"true");
		return $res;
	}

	public function deleteProblem($problemId){
		$info=array();
		$info['problemId']=$problemId;	
		$res=$this->DB->pushData("problems","delete",$info,"true");
		return $res;
	}

	public function checkProblemInProblemSet($problemId){
		$sql="select count(*) as total from problems where problemId=$problemId;";
		$result=$this->DB->getData($sql);
		return $result[0]['total'];
	}

	public function problemStat($problemId,$json=false){
		$data=array();
		$sql="select count(*) as totalModerator from problem_moderator where problemId=$problemId;";
		$result=$this->DB->getData($sql);
		$data['totalModerator']=$result[0]['totalModerator'];

		$sql="select count(*) as totalTestCase from test_case where problemId=$problemId";
		$result=$this->DB->getData($sql);
		$data['totalTestCase']=$result[0]['totalTestCase'];

		$sql="select count(*) as totalSubmission from submissions where problemId=$problemId";
		$result=$this->DB->getData($sql);
		$data['totalSubmission']=$result[0]['totalSubmission'];

		return ($json)?json_encode($data):$data;
	}

	public function getModeratorProblemList($json=false){
		if(!$this->DB->isLoggedIn)
			return;
		$userId=$this->DB->isLoggedIn;
		$sql="select problem_moderator.*,problems.problemName,problems.cpuTimeLimit,problems.memoryLimit from problem_moderator join problems on problems.problemId=problem_moderator.problemId where problem_moderator.userId=$userId order by problem_moderator.problemModeratorId DESC";
		$data=$this->DB->getData($sql);
		return ($json)?json_encode($data):$data;
	}

	public function checkProblemModeratorRoles($problemId){
		$userId=$this->DB->isLoggedIn;
		if($this->DB->userRole>=35)return -1;
		$role=$this->checkProblemModerator($problemId,$userId);
		if($role==10)return 1;
		if($role==20)return 2;
		//role=10->admin
		//role=20->moderator
		if($this->DB->userRole<=20)return 3;
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

 	public function updateProblemSetting($info){
 		return $this->DB->pushData("problems","update",$info,"true");
 	}

 	public function checkJudgeProblemList($pid){
		$sql="select * from judge_problem_list where problemId=$pid";
		$data=$this->DB->getData($sql);
		return (isset($data[0]))?$data[0]['status']:-1;
	}

	public function reqJudgeProblemList($problemId){
		$data=array();
		$data['problemId']=$problemId;
		return $this->DB->pushData("judge_problem_list","insert",$data,"true");
	}

	public function addJudgeProblemList($data){
		return $this->DB->pushData("judge_problem_list","update",$data,"true");
	}

	public function delJudgeProblemList($problemId){
		$data=array();
		$data['problemId']=$problemId;
		return $this->DB->pushData("judge_problem_list","delete",$data,"true");
	}

	public function problemVerdictStat($problemId,$json=false){
		$sql="select submissionVerdict,count(*) from submissions where problemId=$problemId and submissionType=2 group by submissionVerdict";
		$getData=$this->DB->getData($sql);
		$data=array();
		foreach ($getData as $key => $value) {
			$data[$value['submissionVerdict']]=$value['count(*)'];
		}

		return $json==true?json_encode($data):$data;
	}


}
?>