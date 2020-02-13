<?php
class Submission {
   
	public $submissionData;
	public $loggedIn;

 	public function __construct(){
     	$this->DB=new Database();
     	$this->conn=$this->DB->conn;
     	$this->loggedIn=$this->DB->isLoggedIn;
 	}

 	public function getSubmissionList($requestData,$json=false){
 		$requestData=($requestData=="")?"{}":$requestData;

 		$info=json_decode($requestData,true);
 		$sql="";
 		foreach ($info as $key => $value) {
 			$sql.=($sql!="")?" and ":"";
 			$sql.= "submissions.$key=$value";
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
 			$verdictName="Running";
 			if($testCaseRun>-1)$verdictName.=" On Test $testCaseRun";
 			$verdictClass="primary";
 		}
 		else if($verdictId==3){
 			$verdictName="Accepted";
 			$verdictClass="success";
 		}
 		else if($verdictId==4)$verdictName="Wrong answer";
 		else if($verdictId==5)$verdictName="Time limit exceeded";
 		else $verdictName="Compailer Error";
        
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
 		$info['sourceCode']=base64_decode($info['sourceCode']);
 		$info['sourceCode']=$this->DB->buildSqlString($info['sourceCode']);
 		$info['submissionType']=$submissionType;
 		$info['userId']=$this->loggedIn;
 		$info['submissionTime']=$this->DB->date();
 		$response=$this->DB->pushData("submissions","insert",$info);
 		print_r($response);
 	}

 	public function getSubmissionTestCase($submissionId,$submissionFinish,$runOnTest){
 		$sql="select submissionTestCaseId,testCaseSerialNo, verdict ,totalTime,totalMemory from submissions_on_test_case where submissionId=$submissionId";
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
 		$json_data['submissionId']=$submissionId;
 		$submissionInfo=$this->getSubmissionList(json_encode($json_data));
 		$data['submissionInfo']=$submissionInfo[0];
 		$data['submissionTestCase']=$this->getSubmissionTestCase($submissionId,$submissionInfo[0]['judgeComplete'],$submissionInfo[0]['runOnTest']);
 		return $json==true?json_encode($data):$data;

 	}

 	


 
}
?>