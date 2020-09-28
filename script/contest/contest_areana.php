<?php
class ContestAreana {
   
 	public function __construct(){
     	$this->DB = new Database();
     	$this->conn = $this->DB->conn;
     	$this->Contest = new Contest();
     	$this->Submission = new Submission();
 	}


 	// start submission area

 	public function createContestSubmission($data)
    {
        $contestId     = $data['contestId'];

        //contest participate check
        $checkParticipate = $this->Contest->checkContestParticipate($contestId);

        if($checkParticipate == 0) return [
        	'error' => 1,
        	'errorMsg' => 'You can not participate this contest'
        ];

        //contest time check
        $contestInfo = $this->Contest->getSingleContestInfo($contestId);
        
        if($contestInfo['contestStatus'] != 0) return [
        	'error' => 1,
        	'errorMsg' => $contestInfo['contestStatus'] == -1 ? 'Contest is not start':'Contest is finish'
        ];

        $problemNumber = $data['problemNumber'];
        
        $problemList = $this->Contest->getContestProblemList($contestId);
        if (!isset($problemList[$problemNumber])) return [
        	'error' => 1,
        	'errorMsg' => 'Problem Is Not Found'
        ];

        $retData       = array();

        $problemId = $problemList[$problemNumber]['problemId'];

        $submissionData               = array();
        $submissionData['sourceCode'] = $data['sourceCode'];
        $submissionData['languageId'] = $data['languageId'];
        $submissionData['languageName'] = $data['languageName'];
        $submissionData['userId'] = $this->DB->isLoggedIn;
        $submissionData['problemId']  = $problemId;

        $submissionResponse = $this->Submission->createSubmission($submissionData, 3);
        $submissionResponse = json_decode($submissionResponse, true);

        if ($submissionResponse['error'] == 1)return [
        	'error' => 1,
        	'errorMsg' => $submissionResponse['msg']
        ];

        $submissionInfo = json_decode($submissionResponse['msg'], true);

        $submissionId = $submissionInfo['insert_id'];

        $contestSubmissionData                 = array();
        $contestSubmissionData['contestId']    = $contestId;
        $contestSubmissionData['submissionId'] = $submissionId;

        $this->DB->pushData("contest_submission", "insert", $contestSubmissionData, true);

        return [
        	'error' => 0,
        	'submissionId' => $submissionId
        ];
    }

 	public function getContestSubmissionList($filterData){
 		$contestId = $filterData['contestId'];
 		$isFrozen = isset($filterData['isFrozen'])?1:0;
 		
 		$limit = "";
 		
 		if(isset($filterData['limit'])){
 			$limit = $filterData['limit'];
 			$limit = "limit $limit";
 		}

 		$sortOrder = "desc";
 		if(isset($filterData['sortOrder']))
 			$sortOrder = $filterData['sortOrder'];

 		$sql = "select submissionId from contest_submission where contestId = $contestId";
 		$submissionList = $this->DB->getData($sql);

 		$whereIn = array();
 		foreach ($submissionList as $key => $value) {
			array_push($whereIn, $value['submissionId']);
 		}

 		$whereIn = implode(',', $whereIn);
 		$where = ($whereIn != "")?"where submissions.submissionId in ($whereIn)":"";

 		$whereInfo=array();
 		if(isset($filterData['where']))$whereInfo=$filterData['where'];

 		foreach ($whereInfo as $key => $value) {
 			$where.=($where!="")?" and ":"";
 			$where.= "submissions.$key=$value";
 		}

 		$where = ($whereIn =="")?" where ".$where:"".$where;

 		$sql="select submissions.*,users.userHandle,problems.problemName from submissions join users on users.userId=submissions.userId join problems on problems.problemId=submissions.problemId $where order by submissionId $sortOrder $limit";

 		$data=$this->DB->getData($sql);
 		$data = $this->filterContestSubmissionData($data,$contestId);
 		$data=$this->Submission->processSubmissionData($data);

 		return $data;
 	}

 	public function filterContestSubmissionData($submissionData,$contestId){

 		$contestData = $this->Contest->getSingleContestInfo($contestId);
 		$contestProblemList = $this->Contest->getContestProblemList($contestId,"problemId");
 		$contestParticipateUserList = $this->Contest->contestParticipateUserList($contestId);

 		$contestStartSecond = strtotime($contestData['contestStart']);
 		$contestEndSecond = strtotime($contestData['contestEnd']);

 		$filterSubmissionData = array();

 		foreach ($submissionData as $key => $value) {
 			
 			$data = $value;

 			//time check
 			$submissionTimeSecond  = strtotime($data['submissionTime']);
 			$submissionTimeDiff = $submissionTimeSecond - $contestStartSecond;

 			if($submissionTimeDiff<=0 || $contestEndSecond < $submissionTimeSecond)continue;

 			$data['submissionPanalty'] = ceil($submissionTimeDiff/60);
 			$data['submissionTimeTimer'] = $this->Contest->convertContestTime($submissionTimeDiff);

 			//problem check
 			$problemId = $value['problemId'];
 			if(!isset($contestProblemList[$problemId]))continue;
 			$data['problemNumber'] = $contestProblemList[$problemId]['problemNumber'];

 			//user check
 			$userId = $value['userId'];
 			if(!isset($contestParticipateUserList[$userId]))continue;
 			if($contestParticipateUserList[$userId]['registrationStatus'] == "Pending")continue;
 			$data['displayName'] = $contestParticipateUserList[$userId]['displayName'];
 			$data['displaySubName'] = $contestParticipateUserList[$userId]['displaySubName'];

 			array_push($filterSubmissionData, $data);
 		}

 		return $filterSubmissionData;
 	}

 	//end submission area
    function sortByOrder($a, $b) {
        return $a['totalSolved'] - $b['totalSolved'];
    }

 	public function getRankList($contestId){
 		$submissionList = $this->getContestSubmissionList([
 			'contestId' => $contestId,
 			'sortOrder' => "asc"
 		]);

 		$rankList = array();

        $solvedProblemStat = array();
        $attemptedProblemStat = array();

 		foreach ($submissionList as $key => $value) {
 			$userId = $value['userId'];
 			$problemId = $value['problemId'];
 			$verdict = $value['submissionVerdict'];
 			$submissionPanalty = $value['submissionPanalty'];

 			if(!isset($rankList[$userId])){
 				$rankList[$userId] = [
 					'userId' => $userId,
 					'totalSolved' => 0,
 					'totalPanalty' => 0,
 					'problems' => array()
 				];
 			}
 			$data = $rankList[$userId];
 			$problemData = $data['problems'];
 			$panalty = 0;
 			if(!isset($problemData[$problemId])){
 				$panalty = $verdict == 3?$submissionPanalty:0;
 				$problemData[$problemId] = [
 					'attempted' => 1,
 					'panalty' 	=> $panalty,
 					'verdict' 	=> $verdict
 				];
                if(!isset($attemptedProblemStat[$problemId]))
                    $attemptedProblemStat[$problemId] = 1;
                else 
                    $attemptedProblemStat[$problemId] += 1;
 			}
 			else{
 				if($problemData[$problemId]['verdict'] == 3)continue;
 				$attempted = $problemData[$problemId]['attempted'];
 				$panalty = $problemData[$problemId]['panalty'];
 				$panalty = ($verdict == 3)? ($attempted*20) + $submissionPanalty:0;
 				$problemData[$problemId] = [
 					'attempted' => $attempted+1,
 					'panalty' 	=> $panalty,
 					'verdict' 	=> $verdict
 				];
 			}

 			$data['totalSolved'] += $verdict == 3;
 			$data['totalPanalty'] += $panalty;
 			$data['problems'] = $problemData;

            if(!isset($solvedProblemStat[$problemId]))
                    $solvedProblemStat[$problemId] = 0;

            $solvedProblemStat[$problemId] += $verdict == 3;
            

 			$rankList[$userId] = $data;
 		}
        
        usort($rankList, function ($a, $b) use ($key) {
            if($a['totalSolved'] == $b['totalSolved'])
                return $a['totalPanalty'] <=> $b['totalPanalty'];
            return $b['totalSolved'] <=> $a['totalSolved'];
        });

        $rankList['solvedProblemStat'] = $solvedProblemStat;
        $rankList['attemptedProblemStat'] = $attemptedProblemStat;

 		return $rankList;
 	}
 
}
?>