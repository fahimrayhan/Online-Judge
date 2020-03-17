<?php
class Judge {
   
	public $serverNo;
	public $submissionData=array();
	public $isPending;
	public $apiData;
	public $isQueue;
	public $analysisData=array();
	public $saveSubmissionData=array();
	public $saveSubmissionTestData=array();

 	public function __construct($serverNo){
     	$this->DB=new Database();
     	$this->Site=new Site();
     	$this->SiteHash=new SiteHash();
     	$this->conn=$this->DB->conn;
     	$this->setServer($serverNo);
 	}

 	public function setServer($serverNo){
 		$this->serverNo=$serverNo;
 	}

 	public function getSubmissionTestCase(){
 		$serverNo1=$this->serverNo;
 		$serverNo2=$serverNo1+3;
 		$serverNo3=$serverNo1+6;
 		$sql="select * from submissions natural join submissions_on_test_case where
 		(submissionId % 9 = $serverNo1 or submissionId % 9 = $serverNo2 or submissionId % 9 = $serverNo3 ) and runOnTest = testCaseSerialNo and judgeStatus = -1 and testCaseReady = 1 and judgeComplete=0";


 		$data=$this->DB->getData($sql);

 		echo "<pre>";
 		print_r($data);
 		echo "</pre>";

 		echo "$sql";

 		if(isset($data[0])){
 			$this->submissionData=$data[0];
 			$this->isPending=1;
 		}
 		else $this->isPending=0;
 	}

 	public function setProcessingSubmissionTestCase(){
 		if($this->isPending==0)
 			return;
 		$data=array();
 		$data['judgeStatus']=0;
 		$data['submissionTestCaseId']=$this->submissionData['submissionTestCaseId'];
 		$this->DB->pushData("submissions_on_test_case","update",$data);
 	}

 	public function resetProcessingSubmissionTestCase(){
 		if($this->isPending==0)
 			return;
 		$data=array();
 		$data['judgeStatus']=($this->isQueue==1)?-1:1;
 		$data['submissionTestCaseId']=$this->submissionData['submissionTestCaseId'];
 		$this->DB->pushData("submissions_on_test_case","update",$data);
 	}

 	//create test case

 	public function createTestCaseToken(){
		if($this->isPending==0)
 			return;
		$testCaseId=$this->submissionData['testCaseId'];
		$testCaseHashId=$this->SiteHash->testCaseHash($testCaseId);
		$token=$this->sendTestCasePostRequest($testCaseHashId);
		if($token!=""){
			$this->submissionData['testCaseToken']=$token;
			$data=array();
 			$data['submissionTestCaseId']=$this->submissionData['submissionTestCaseId'];
 			$data['testCaseToken']=$this->submissionData['testCaseToken'];
 			$this->DB->pushData("submissions_on_test_case","update",$data);
		}
	}

	public function sendTestCasePostRequest($testCaseHashId){
 		
 		/*******************************************************************************
		*	@ get source code, input, output and convert base64 for processing api call.
 		********************************************************************************/

 		$problemId=$this->submissionData['problemId'];
 		$sql="select cpuTimeLimit,memoryLimit from problems where problemId=$problemId";
 		$problemData=$this->DB->getData($sql);
 		$problemData=$problemData[0];

 		$data=array();
 		
    	$data['source_code']=base64_encode($this->submissionData['sourceCode']);
 		$data['stdin']=base64_encode($this->Site->readFile("test_case/input/".$testCaseHashId.'.txt'));
 		$data['expected_output']=base64_encode($this->Site->readFile("test_case/output/".$testCaseHashId.'.txt'));

 		$data['language_id']=$this->submissionData['languageId'];
 		$data['cpu_time_limit']=$problemData['cpuTimeLimit'];
 		$data['memory_limit']=$problemData['memoryLimit'];
        
        print_r($data);

        $token=$this->sendCurlRequestForToken(json_encode($data));
 		//$token="asfsdafsa0";

 		return $token;
 	}

	public function sendCurlRequestForToken($data){
 		
 		/*******************************************************************************
		*	@ this function use for only send post request api for token.
 		********************************************************************************/

        $curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.judge0.com/submissions/?base64_encoded=true&wait=false",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_HTTPHEADER => array(
				"accept: application/json",
				"content-type: application/json"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		
		if ($err) return "";
		$token=json_decode($response,true);
		if(!isset($token['token']))
			return "";	
		return $token['token'];
 	}




 	//process data

	public function sendCurlRequest($url){
		//$data='{"stdout":"2\n","time":"0.2","memory":1470,"stderr":null,"token":"87499552-56fd-4bb4-8bbc-cc24fa4ccc61","compile_output":null,"message":null,"status":{"id":3,"description":"WA"}}';
		//$data=file_get_contents($url);
  		//return $data;

		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	
 	public function getApiData(){
 		if($this->isPending==0)
 			return;
 		$tokenId=$this->submissionData['testCaseToken'];

 		//$tokenId="87499552-56fd-4bb4-8bbc-cc24fa4ccc61";
 		$url="https://api.judge0.com/submissions/$tokenId";
 		$data=$this->sendCurlRequest($url);
 		$this->apiData=($data=="")?"{}":$data;
 	}

 	public function analysisApiData(){
 		if($this->isPending==0)
 			return;
 		$data=json_decode($this->apiData,true);
 		print_r($data);
 		if(!isset($data['status'])){
 			$this->analysisData['verdict']=6;
 			$this->analysisData['memory']=0;
 			$this->analysisData['time']=0;
 			return;
 		}

 		$this->analysisData['verdict']=$data['status']['id'];
 		$this->analysisData['memory']=$data['memory']==null?0:$data['memory'];
 		$this->analysisData['time']=$data['time']==null?0:$data['time'];

 		$this->isQueue=0;
 		if($this->analysisData['verdict']<=2)
 			$this->isQueue=1;

 	}

 	public function processData(){
 		if($this->isQueue==1 || $this->isPending==0)
 			return;
 		if($this->submissionData['totalTestCase']==$this->submissionData['runOnTest'] || $this->analysisData['verdict']!=3){
 			$this->saveSubmissionData['judgeComplete']=1;
 			$this->saveSubmissionData['submissionVerdict']=$this->analysisData['verdict'];
 			$this->saveSubmissionData['maxTimeLimit']=max($this->analysisData['time'],$this->submissionData['runOnMaxTime']);
 			$this->saveSubmissionData['maxMemoryLimit']=max($this->analysisData['memory'],$this->submissionData['runOnMaxMemory']);
 			
 		}
 		else{
 			$this->saveSubmissionData['runOnTest']=$this->submissionData['runOnTest']+1;
 		}

 		$this->saveSubmissionData['submissionId']=$this->submissionData['submissionId'];
 		$this->saveSubmissionData['runOnMaxTime']=max($this->analysisData['time'],$this->submissionData['runOnMaxTime']);
 		$this->saveSubmissionData['runOnMaxMemory']=max($this->analysisData['memory'],$this->submissionData['runOnMaxMemory']);

 		$this->saveSubmissionTestData['submissionTestCaseId']=$this->submissionData['submissionTestCaseId'];
 		$this->saveSubmissionTestData['verdict']=$this->analysisData['verdict'];
 		$this->saveSubmissionTestData['totalTime']=$this->analysisData['time'];
 		$this->saveSubmissionTestData['totalMemory']=$this->analysisData['memory'];

 		//$this->saveSubmissionTestData['responseData']=$this->DB->buildSqlString($this->apiData);
 		$this->saveSubmissionTestData['judgeStatus']=1;
 		//print_r($this->saveSubmissionTestData);
 	}

 	public function saveData(){
 		if($this->isQueue==1 || $this->isPending==0)
 			return;
 		echo "<pre>";
 		print_r($this->saveSubmissionData);
 		echo "</pre><pre>";
 		print_r($this->saveSubmissionTestData);
 		echo "</pre>";
 		$res=$this->DB->pushData("submissions_on_test_case","update",$this->saveSubmissionTestData);
 		$this->DB->pushData("submissions","update",$this->saveSubmissionData);
 		print_r($res);
 	}
 	
 	 public function clearData(){

 		/*******************************************************************************
		*	@ when function is finished then our need to clear all global data
			  for avoid previous storing.
 		********************************************************************************/
 		
 		unset($this->saveSubmissionData);
 		unset($this->saveSubmissionTestData);
 		unset($this->analysisData);
 		unset($this->submissionData);
 	}


 	public function judgeSubmission(){
 	  
 		$this->getSubmissionTestCase();
 		if($this->isPending==0)
 			return;
 		
 		$this->setProcessingSubmissionTestCase();
 			if($this->submissionData['testCaseToken']==""){
 				$this->createTestCaseToken();
 				$this->isQueue=1;
 			}
 			else if($this->submissionData['testCaseToken']!=""){
 				//if token is not null
 				$this->getApiData();
 				$this->analysisApiData();
 				$this->processData();
 				$this->saveData();
 			}
 		$this->resetProcessingSubmissionTestCase();
 		$this->clearData();
 	}
 	
 	public function judgeMultipleSubmission($totalProcess=1){

 		$this->judgeSubmission();
	    
	    if($totalProcess<=50){
	        sleep(1);
	        $this->judgeMultipleSubmission($totalProcess+1);
	    }

	    return;
 	}



 
}
?>