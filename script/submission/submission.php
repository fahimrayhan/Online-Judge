<?php
class Submission {
   
	public $submissionData;
	public $loggedIn;

 	public function __construct(){
     	$this->DB=new Database();
     	$this->conn=$this->DB->conn;
     	$this->loggedIn=$this->DB->isLoggedIn;
 	}

 	public function getSubmissionList($requestData,$limit=50,$json=false){
 		$requestData=($requestData=="")?"{}":$requestData;

 		$info=json_decode($requestData,true);
 		
 		$limit=50;
 		if(isset($info['filter'])){
 			$filter=$info['filter'];
 			if(isset($filter['limit']))$limit=$filter['limit'];
 		}
 		
 		$whereInfo=array();
 		if(isset($info['where']))$whereInfo=$info['where'];
 		
 		$sql="";
 		foreach ($whereInfo as $key => $value) {
 			$sql.=($sql!="")?" and ":"";
 			$sql.= "submissions.$key=$value";
 		}
 		$sql=($sql!="")?" where ".$sql:"";
 		$sql="select submissions.*,users.userHandle,problems.problemName from submissions join users on users.userId=submissions.userId join problems on problems.problemId=submissions.problemId $sql order by submissionId desc limit $limit";
 		$data=$this->DB->getData($sql);
 		$data=$this->processSubmissionData($data);
 		return $json?json_encode($data):$data;
 	}

 	public function checkSubmissionAuth($submissionId){
 		$sql="select * from submissions where submissionId=$submissionId";
 		$data=$this->DB->getData($sql);
 		if(!isset($data[0]))return -1;
 		
 		if($this->DB->userRole<=20)return 1;
 		if($data[0]['userId']==$this->DB->isLoggedIn)return 1;
 		$submissionType=$data[0]['submissionType'];
 		
 		//check moderator
 		$userId=$this->DB->isLoggedIn;
 		$problemId=$data[0]['problemId'];
 		$sql="select * from problem_moderator where problemId=$problemId and userId=$userId";
 		$data=$this->DB->getData($sql);
 		if(isset($data[0]))return 1;
 		if($submissionType==1)return -1;

 		return 0;
 	}

 	public function getJudgeStatusFromId($jsonDataIdList,$json=false){
 		$requestData=($jsonDataIdList=="")?"{}":$jsonDataIdList;
 		$info=json_decode($requestData,true);

 		$sql="";
 		foreach ($info as $key => $value) {
 			$sql.=($sql!="")?" or ":"";
 			$sql.= "submissions.submissionId=$value";
 		}
 		$sql=($sql!="")?" where ".$sql:"";
 		$sql="select submissions.*,users.userHandle,problems.problemName from submissions join users on users.userId=submissions.userId join problems on problems.problemId=submissions.problemId $sql order by submissionId desc";
 		$data=$this->DB->getData($sql);
 		$data=$this->processSubmissionData($data);
 		return $json?json_encode($data):$data;
 	}

 	public function processSubmissionData($data){
 		foreach ($data as $key => $value) {
 			
 			$testCaseReady=$value['testCaseReady'];
 			$judgeComplete=$value['judgeComplete'];
 			$submissionVerdict=$value['submissionVerdict'];
 			$runOnTest=$value['runOnTest'];

 			$status=$this->getVerdict(0);
 			if($testCaseReady==0)
 				$status=$this->getVerdict(1);
 			else if($testCaseReady==1){
 				if($judgeComplete==0)
 					$status=$this->getVerdict(2,$runOnTest);
 				else
 					$status=$this->getVerdict($submissionVerdict);
 			}

 			$data[$key]['judgeStatus']=$status;
 		}
 		return $data;
 	}

 	public function submissionLanguageList($json=false){
 		$sql="select languageList from judgeSetting";
 		$data=$this->DB->getData($sql);
 		return $json?$date[0]:json_decode($data[0],true);
 	}

 	public function getVerdict($verdictId,$testCaseRun=-1){

 		$verdictClass="danger";
 		$verdictName="";
 		if($verdictId==-1){
 			$verdictName="Skip";
 			$verdictClass="default";
 		}
 		else if($verdictId==0){
 			$verdictName="In Queue";
 			$verdictClass="default";
 		}
 		else if($verdictId==1){
 			$verdictName="Processing";
 			$verdictClass="info";
 		}
 		else if($verdictId==2){
 			$verdictName="<span class='spinner-border'></span> Running";
 			if($testCaseRun>-1)$verdictName.=" On Test $testCaseRun";
 			$verdictClass="primary";
 		}
 		else if($verdictId==3){
 			$verdictName="Accepted";
 			$verdictClass="success";
 		}
 		else if($verdictId==4)$verdictName="Wrong answer";
 		else if($verdictId==5)$verdictName="Time limit exceeded";
 		else if($verdictId==6) $verdictName="Compailer Error";
 		else if($verdictId>=7 && $verdictId<=12) $verdictName="Runtime Error";
 		else if($verdictId==13) $verdictName="Memory Limit Exceeded";
 		else if($verdictId==14) $verdictName="Exec Format Error";
 		else $verdictName="Failed";
 		$verdictClass="label label-$verdictClass";

 		return "<span class='$verdictClass'>$verdictName</span>";
	 }


	 

 	public function createSubmission($info,$submissionType=2){
 		if(!$this->loggedIn)
 			return;
 		/*
 			submissionType,
 				Testing=1
 				Problem=2
 				Contest=3
 		*/
 		$data=array();
 		$data['error']=0;
 		$data['msg']="";
 		if($info['sourceCode']==''){
 			$data['error']=1;
 			$data['msg']='<li>Source Code Is Empty</li>';
 		}
 		if($info['languageId']==-1){
 			$data['error']=1;
 			$data['msg'].='<li>Please Select Language</li>';
 		}

 		if($data['error']==1)
 			return json_encode($data);

 		$info['sourceCode']=base64_decode($info['sourceCode']);
 		$info['sourceCode']=$this->DB->buildSqlString($info['sourceCode']);
 		$info['submissionType']=$submissionType;
 		$info['userId']=$this->loggedIn;
 		$info['submissionTime']=$this->DB->date();
 		$response=$this->DB->pushData("submissions","insert",$info,true);
 		$data['msg']=$response;
 		return json_encode($data);
 	}

 	public function rejudgeSubmission($submissionId){
 		$sql="select submissionTestCaseId from submissions_on_test_case where submissionId=$submissionId";
 		$data=$this->DB->getData($sql);
 		foreach ($data as $key => $value) {
 			$testCase=array();
 			$testCase['submissionTestCaseId']=$value['submissionTestCaseId'];
 			$this->DB->pushData("submissions_on_test_case","delete",$testCase);
 			print_r($testCase);
 		}
 		$submissionData=array();
 		$submissionData['submissionId']=$submissionId;
 		$submissionData['maxTimeLimit']=0;
 		$submissionData['maxMemoryLimit']=0;
 		$submissionData['runOnMaxTime']=0;
 		$submissionData['runOnMaxMemory']=0;

 		$submissionData['submissionVerdict']=1;
 		$submissionData['testCaseReady']=-1;
 		$submissionData['judgeComplete']=0;
 		$submissionData['runOnTest']=1;
 		$submissionData['totalTestCase']=0;
 		$submissionData['threadId']=0;
 		print_r($submissionData);
 		$this->DB->pushData("submissions","update",$submissionData);

 	}

 	public function getSubmissionTestCase($submissionId,$submissionFinish,$runOnTest){
 		$sql="select testCaseToken,submissionTestCaseId,testCaseSerialNo, verdict ,totalTime,totalMemory from submissions_on_test_case where submissionId=$submissionId";
 		$data=$this->DB->getData($sql);
 		$skip=0;
 		foreach ($data as $key => $value) {
 			
 			if($skip==1)
 				$judgeStatus=$this->getVerdict(-1);
 			else if($value['testCaseSerialNo']==$runOnTest && $submissionFinish==0){
 				$judgeStatus=$this->getVerdict(2);
 			}
 			else{
 				if($value['verdict']>3)
 					$skip=1;
 				$judgeStatus=$this->getVerdict($value['verdict']);
 			}
 			$data[$key]['judgeStatus']=$judgeStatus;
 		}
 		return $data;
 	}

 	public function getSubmissionAllInfo($info,$json=false){
 		$submissionId=$info['submissionId'];
 		$data=array();
 		$json_data=array();
 		$json_data['where']['submissionId']=$submissionId;
 		$submissionInfo=$this->getSubmissionList(json_encode($json_data));
 		$data['submissionInfo']=$submissionInfo[0];
 		$data['submissionTestCase']=$this->getSubmissionTestCase($submissionId,$submissionInfo[0]['judgeComplete'],$submissionInfo[0]['runOnTest']);
 		return $json==true?json_encode($data):$data;

 	}

 
 
}
?>
