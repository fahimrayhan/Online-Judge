<?php
class Contest
{

    public function __construct()
    {
        $this->DB         = new Database();
        $this->Submission = new Submission();
        $this->conn       = $this->DB->conn;
    }

    public function getContestList()
    {
        $sql  = "select * from contest";
        $data = $this->DB->getData($sql);
        return $data;
    }

    public function checkContest($contestId)
    {
        $data = $this->getSingleContestInfo($contestId);
        return isset($data['contestId']);
    }

    public function checkContestPublish($contestId)
    {
        $data = $this->getSingleContestInfo($contestId);
        if (!isset($data['contestId'])) {
            return 0;
        }

        if ($data['contestPublish'] == "No") {
            return 0;
        }

        return 1;
    }

    public function checkContestParticipate($contestId)
    {
        $userId = $this->DB->isLoggedIn;
        $sql    = "select * from contest_registration where contestId = $contestId and userId = $userId";
        $data   = $this->DB->getData($sql);
        return isset($data[0]);
    }

    public function checkContestAuth($contestId)
    {
        $contestData = $this->getSingleContestInfo($contestId);

        $error = "";
        if (!isset($contestData['contestId'])) {
            $error = "Contest Id Is Not Valid";
            return $error;
        }

        if ($contestData['contestPublish'] == "No") {
            $error = "Contest Is Not Publish";
            return $error;
        }

        if ($contestData['contestStatus'] == -1) {
            $error = "Contest Is Not Start";
            return $error;
        }

        $checkParticipate = $this->checkContestParticipate($contestId);
        //if contest is public then user can go to contest areana
        if ($checkParticipate == 0) {
            if ($contestData['contestVisibility'] != "Public") {
                $error = "You Can Not Participate This Contest";
                return $error;
            }
        }

        return $error;
    }

    

    public function getSingleContestInfo($contestId)
    {
        $sql  = "select * from contest where contestId=$contestId";
        $data = $this->DB->getData($sql);
        if (isset($data[0])) {
            $data = $this->processContestData($data[0]);
        }

        return $data;
    }

    public function processContestData($contestInfo)
    {

        // add contest end time from contest duration
        $newtimestamp              = strtotime($contestInfo['contestStart'] . '+' . $contestInfo['contestDuration'] . 'minute');
        $contestInfo['contestEnd'] = date('Y-m-d H:i:s', $newtimestamp);

        $nowTime          = $this->DB->date();
        $contestTimerTime = 0;

        if ($contestInfo['contestStart'] > $nowTime) {
            $contestStatus    = -1;
            $contestStatusTxt = "Contest Is Not Start";
            $contestTimerTime = strtotime($contestInfo['contestStart']) - strtotime($nowTime);
        } else if ($contestInfo['contestEnd'] < $nowTime) {
            $contestStatus    = 1;
            $contestStatusTxt = "Contest Is End";
        } else {

            $contestStatus    = 0;
            $contestStatusTxt = "Contest Is Running";
            $contestTimerTime = strtotime($contestInfo['contestEnd']) - strtotime($nowTime);
        }

        $contestInfo['contestStatus']       = $contestStatus;
        $contestInfo['contestStatusTxt']    = $contestStatusTxt;
        $contestInfo['contestTimerTime']    = $contestTimerTime;
        $contestInfo['contestTimerTimeTxt'] = $this->convertContestTime($contestInfo['contestTimerTime']);

        return $contestInfo;
    }

    public function convertContestTime($contestTimerTime)
    {
        $timeDiffrent = $contestTimerTime;
        $timeDiffrent = $timeDiffrent <= 0 ? 0 : $timeDiffrent;
        $hour         = floor($timeDiffrent / 3600);
        $timeDiffrent -= $hour * 3600;
        $minute = floor($timeDiffrent / 60);
        $timeDiffrent -= $minute * 60;
        $second = $timeDiffrent;

        if ($hour < 10) {
            $hour = "0" . $hour;
        }

        if ($minute < 10) {
            $minute = "0" . $minute;
        }

        if ($second < 10) {
            $second = "0" . $second;
        }

        return $hour . ":" . $minute . ":" . $second;
    }

    public function getContestProblemList($contestId)
    {
        $sql               = "select * from contest_problem_set natural join problems where contestId=$contestId";
        $data              = $this->DB->getData($sql);
        $problemNumberList = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $problemData       = array();
        foreach ($data as $key => $value) {
            $problemNumber                                = $problemNumberList[$key];
            $problemData[$problemNumber]                  = $value;
            $problemData[$problemNumber]['problemNumber'] = $problemNumber;
        }
        return $problemData;
    }

    public function getContestCommentList($contestId, $commentType = "", $sortType = "asc")
    {
        $commentWhere = $commentType == "" ? "" : " where contestCommentType='$commentType'";
        $sql          = "select * from contest_comment $commentWhere order by contestCommentId $sortType";
        $data         = $this->DB->getData($sql);
        return $data;
    }

    public function createContestSubmission($data)
    {
        $contestId     = $data['contestId'];
        $problemNumber = $data['problemNumber'];
        $errorMsg = "";
        $retData = array();

        $checkAuth = $this->checkContestAuth($contestId)=="" & $this->checkContestParticipate($contestId);
        if(!$checkAuth){
        	$errorMsg = "You Can Not Participate This Contest";
        }

        $problemList   = $this->getContestProblemList($contestId);
        if (!isset($problemList[$problemNumber])) {
            $errorMsg = "Problem Is Not Found";
        }

        if($errorMsg != ""){
        	$retData['error'] = 1;
        	$retData['errorMsg'] = $errorMsg;
        	return $retData;
        }

        $problemId = $problemList[$problemNumber]['problemId'];


        $submissionData = array();
        $submissionData['sourceCode'] = $data['sourceCode'];
        $submissionData['languageId'] = $data['languageId'];
        $submissionData['problemId'] = $problemId;

        $submissionResponse = $this->Submission->createSubmission($submissionData,3);
        $submissionResponse = json_decode($submissionResponse,true);

        print_r($submissionResponse);

        if($submissionResponse['error'] == 1){
        	 $retData['error'] = 1;
        	 $retData['errorMsg'] = $submissionResponse['msg'];
        	 return $retData;
        }

        $submissionInfo = json_decode($submissionResponse['msg'],true);

        $submissionId = $submissionInfo['insert_id'];

        $contestSubmissionData = array();
        $contestSubmissionData['contestId'] = $contestId;
        $contestSubmissionData['submissionId'] = $submissionId;

        $this->DB->pushData("contest_submission","insert",$contestSubmissionData,true);

        $retData['error'] = 0;
        $retData['submissionId'] = $submissionId;

        return $retData;
    }

    public function getContestSubmissionList($contestId)
    {
        $sql = "select * from contest_submission ";
    }

    public function updateContestRegistrationFormSerial($data)
    {
        print_r($data);
        $data = json_decode($data, true);

        $c = 1;
        foreach ($data as $key => $value) {
            $updateData                              = array();
            $updateData['contestRegistrationFormId'] = $value;
            $updateData['optionSerial']              = $c;
            $this->DB->pushData("contest_registration_form", "update", $updateData);
            $c++;
        }
    }

    public function getContestSignUpFormList($contestId)
    {
        $sql  = "select * from contest_registration_form where contestId = $contestId order by optionSerial asc";
        $data = $this->DB->getData($sql);
        foreach ($data as $key => $value) {
            $data[$key]['formOption'] = $this->processForm($value);
        }
        return $data;
    }
    public function processForm($data)
    {
        $formOptionData = json_decode($data['formOptionData'], true);
        //echo "<pre>";
        //print_r($formOptionData);
        //echo "</pre>";
        $formOptionData['name'] = $data['optionName'];

        return $formOptionData;
    }

    public function addFormField($fieldData)
    {

        $data['contestId']  = $fieldData['contestId'];
        $data['optionName'] = $fieldData['optionName'];

        $data['formOptionTitle']   = $fieldData['formOptionTitle'];
        $data['formOptionMessage'] = $fieldData['formOptionMessage'];

        $registrationData = $this->processRegistrationData($fieldData['registrationData']);
        //print_r($registrationData);
        $registrationData['type'] = $fieldData['formType'];

        $registrationData       = json_encode($registrationData);
        $data['formOptionData'] = $this->DB->buildSqlString($registrationData);

        //$response = $this->DB->pushData("contest_registration_form","insert",$data);

        //echo "<pre>";
        print_r($data);
        //echo "</pre>";
        $data = array();
    }

    public function processRegistrationData($registrationData)
    {
        $data = array();
        foreach ($registrationData as $key => $value) {
            $data[$value['name']] = $value['value'];
        }
        return $data;
    }

    public function contestRegistration($data)
    {
        $userId                   = $this->DB->isLoggedIn;
        $data['userId']           = $userId;
        $data['registrationTime'] = $this->DB->date();
        //checker
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        $data['registrationInfo'] = $this->DB->buildSqlString($data['registrationInfo']);
        $response                 = $this->DB->pushData("contest_registration", "insert", $data);
        print_r($response);

    }
}
