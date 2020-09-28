<?php
class Contest
{

    public function __construct()
    {
        $this->DB         = new Database();
        $this->conn       = $this->DB->conn;
        $this->Submission = new Submission();
        $this->Problem    = new Problem();
        $this->Form       = new Form();
        $this->User       = new User();
        $this->SiteHash   = new SiteHash();

    }

    public function getContestList()
    {
        $sql  = "select * from contest";
        $data = $this->DB->getData($sql);

        return $data;
    }

    public function getContestInfo($contestId)
    {
        $data = $this->DB->getData("select * from contest where contestId=$contestId");
        return isset($data[0]) ? $data[0] : $data;
    }

    public function createContest($data)
    {
        //add form
        //add contest
    }

    public function updateContest($data)
    {
        return $this->DB->pushData("contest", "update", $this->filterContestData($data));
    }

    public function filterContestData($data)
    {
        $boolAttr = array("contestFreeze", "contestUnFreeze", "contestPublish", "registrationAutoAccept");
        foreach ($boolAttr as $key => $value) {
            $data[$value] = isset($data[$value]) ? "true" : "false";
        }

        $data['contestDescription'] = $this->DB->buildSqlString($data['contestDescription']);
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

    

    //contest problem

    public function getContestProblemList($contestId,$idxKey = "number")
    {
        $sql               = "select * from contest_problem_set natural join problems natural join users where contestId=$contestId order by problemSerial";
        $data              = $this->DB->getData($sql);
        $problemNumberList = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $problemData       = array();
        foreach ($data as $key => $value) {
            $problemKey = ($idxKey == "number")?$problemNumberList[$key]:$value['problemId'];
            $problemNumber                             = $problemNumberList[$key];
            $problemData[$problemKey]                  = $value;
            $problemData[$problemKey]['problemNumber'] = $problemNumber;
        }
        return $problemData;
    }

    public function addProblem($contestId, $problemId)
    {
        $error          = array();
        $checkJudge     = $this->Problem->checkProblemInJudgeList($problemId);
        $checkModerator = $this->Problem->checkProblemModeratorRoles($problemId);
        $checkProblem   = $this->Problem->checkProblemInProblemSet($problemId);
        $ok             = $checkProblem & ($checkJudge | $checkModerator != -1);
        if ($ok) {
            $data                  = array();
            $data['problemId']     = $problemId;
            $data['contestId']     = $contestId;
            $data['problemSerial'] = count($this->getContestProblemList($contestId)) + 1;
            $response              = $this->DB->pushData("contest_problem_set", "insert", $data);

            $error['error']    = $response['error'];
            $error['errorMsg'] = $response['error'] ? "Problem is already added" : "Successfully added this problem";
        } else {
            $error['error'] = 1;
            if ($checkProblem == 0) {
                $error['errorMsg'] = "Problem id is not found";
            } else {
                $error['errorMsg'] = "You can not authorize this problem";
            }

        }
        return $error;
    }

    public function updateProblemSerial($contestId, $problemSerial)
    {
        $sl = 1;
        foreach ($problemSerial as $key => $value) {
            $data                        = array();
            $data['contestProblemSetId'] = $value['contestProblemSetId'];
            $data['problemSerial']       = $sl++;
            $this->DB->pushData("contest_problem_set", "update", $data);
        }
    }

    public function deleteProblem($contestId, $problemNumber)
    {
        $error       = array();
        $problemList = $this->getContestProblemList($contestId);
        if (isset($problemList[$problemNumber])) {
            $data                        = array();
            $data['contestProblemSetId'] = $problemList[$problemNumber]['contestProblemSetId'];
            $this->DB->pushData("contest_problem_set", "delete", $data);
            unset($problemList[$problemNumber]);
            $this->updateProblemSerial($contestId, $problemList);
            $error['error']    = 0;
            $error['errorMsg'] = "Problem Successfully Deleted";
        } else {
            $error['error']    = 1;
            $error['errorMsg'] = "Problem Is Not Found";
        }
        return $error;
    }

    //start registration area ---------------------------

    public function contestParticipateUserList($contestId){
        $data = $this->getContestRegistrationData($contestId);
        $userList = array();
        foreach ($data as $key => $value) {
            $userList[$value['userId']] = [
                'displayName' => $value['displayName'],
                'displaySubName' => $value['displaySubName'],
                'registrationStatus' => $value['registrationStatus']
            ];
        }
        return $userList;
    }

    public function getRegistrationOptionList($contestId)
    {
        $contestInfo  = $this->getContestInfo($contestId);
        $formId       = $contestInfo['formId'];
        $questionList = $this->Form->formQuestionList(array('formId' => $formId));
        $data         = array(
            'action'                => '',
            'contestRegistrationId' => 'Registration Id',
            'userHandle'            => 'Handle',
            'userId'            => 'User Id',
            'displayName'           => 'Display Name',
            'displaySubName'        => 'Display Sub Name',
            'registrationStatus'    => 'Registration Status',
            'registrationTime'      => 'Registration Time',
            'tempUser'              => 'Temp User',
            'tempUserPassword'      => 'Temp User Password',

        );

        foreach ($questionList as $key => $value) {
            $data[$value['formQuestionTitle']] = $value['formQuestionTitle'];
        }
        return $data;
    }

    public function getContestRegistrationList($contestId, $filter = array())
    {
        $sql  = "select contest_registration.*,users.userHandle from contest_registration join users on users.userId = contest_registration.userId where contestId = $contestId ";
        $data = $this->DB->getData($sql);
        return $data;
    }

    public function getContestDisplayNameList($contestId){
        $registrationData = $this->getContestRegistrationData($contestId);
        $contestInfo = $this->getContestInfo($contestId);
        $nameList = array();
        foreach ($registrationData as $key => $value) {
            $registrationId = $value['contestRegistrationId'];
            
            $displayName = $contestInfo['participateMainName'];
            $displaySubName = $contestInfo['participateSubName'];

            foreach ($value as $key1 => $value1) {
                $displayName = str_replace("{{".$key1."}}",$value1,$displayName);
                $displaySubName = str_replace("{{".$key1."}}",$value1,$displaySubName);
                
            }
            $nameList[$registrationId] = [
                'displayName' =>    $displayName,
                'displaySubName' => $displaySubName
            ];
        }
        return $nameList;
    }

    public function getContestRegistrationData($contestId)
    {
        $registrationList = $this->getContestRegistrationList($contestId);
        $formKeyList = $this->getRegistrationOptionList($contestId);

        $contestRegistrationData = array();

        foreach ($registrationList as $key => $value) {
            $data = $value;
            unset($data['registrationInfo']);

            //basic Info
            $tmpData = json_decode($value['registrationInfo'], true);
            foreach ($tmpData as $key => $value) {
                if (!isset($formKeyList[$key])) {
                    unset($tmpData[$key]);
                }
            }

            $data = array_merge($tmpData, $data);

            foreach ($data as $key => $value) {
                if (!isset($formKeyList[$key])) {
                    unset($data[$key]);
                }
            }
            foreach ($formKeyList as $key => $value) {
                if (!isset($data[$key])) {
                    $data[$key] = "";
                }
            }

            array_push($contestRegistrationData, $data);
        }
        return $this->getProcessRegistrationData($contestRegistrationData,$contestId);
    }

    public function getProcessRegistrationData($registrationData,$contestId){
        $contestInfo = $this->getContestInfo($contestId);
        $nameList = array();
        foreach ($registrationData as $key => $value) {
            $registrationId = $value['contestRegistrationId'];
            
            $displayName = $contestInfo['participateMainName'];
            $displaySubName = $contestInfo['participateSubName'];

            foreach ($value as $key1 => $value1) {
                $displayName = str_replace("{{".$key1."}}",$value1,$displayName);
                $displaySubName = str_replace("{{".$key1."}}",$value1,$displaySubName);
                
            }

            $registrationData[$key] = array_merge($value,[
                'displayName' => $displayName,
                'displaySubName' => $displaySubName
            ]);
        }

        return $registrationData;
    }

    public function checkContestRegistrationId($contestId, $registrationId)
    {
        $sql  = "select * from contest_registration where contestId = $contestId and contestRegistrationId = $registrationId";
        $data = $this->DB->getData($sql);
        $ret  = array();
        if (!isset($data[0])) {
            $ret = array(
                'error'    => 1,
                'errorMsg' => 'Registration id is not valid',
            );
        }
        return $ret;
    }

    public function getRegistrationIdInfo($registrationId)
    {
        $sql  = "select * from contest_registration where contestRegistrationId = $registrationId";
        $data = $this->DB->getData($sql);
        return $data;
    }

    public function updateRegistration($data)
    {
        $response = $this->checkContestRegistrationId($data['contestId'], $data['contestRegistrationId']);
        if (!empty($response)) {
            return $response;
        }

        return $this->DB->pushData("contest_registration", "update", $data);
    }

    public function deleteRegistration($data)
    {
        $response = $this->checkContestRegistrationId($data['contestId'], $data['contestRegistrationId']);
        if (!empty($response)) {
            return $response;
        }

        return $this->DB->pushData("contest_registration", "delete", $data);
    }

    public function createTempUserPassword($len)
    {
        $characters   = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = "";
        for ($i = 0; $i < $len; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }

    public function generateUser($usersData)
    {
        $contestId = $usersData['contestId'];

        $userPrefix     = $usersData['userPrefix'];
        $passwordLength = $usersData['passwordLength'];
        $userList       = json_decode($usersData['generateUserList'], true);

        $error = "";

        $prefixLen = strlen($userPrefix);
        if ($prefixLen < 4 || $prefixLen > 30) {
            $error = "Prefix Length Must Be (4 to 30)";
        } else if (!preg_match("/^[a-zA-Z0-9\_]*$/", $userPrefix)) {
            $error = "Prefix Is Not Valid";
        } else if ($passwordLength < 6 || $passwordLength > 16) {
            $error = "Password Length Must Be (6 to 16)";
        }

        if ($error != "") {
            return [
                'error'    => 1,
                'errorMsg' => $error,
            ];
        }

        $c = 0;
        foreach ($userList as $key => $value) {

            while (1) {

                $c++;
                $userFullName = isset($value['userFullName']) ? $value['userFullName'] : "";
                $emailRand    = $this->createTempUserPassword(10);
                $userHandle   = $userPrefix . ($c < 10 ? "0" : "") . $c;
                $userEmail    = "tempmail-$userHandle-$emailRand@tmp.coderoj.com";

                $createUserInfo = [
                    'userFullName'  => $userFullName,
                    'instituteName' => isset($value['instituteName']) ? $value['instituteName'] : "",
                    'userHandle'    => $userHandle,
                    'userPassword'  => $this->createTempUserPassword($passwordLength),
                    'userEmail'     => $userEmail,
                    'userRoles'     => 50,
                ];

                $response = $this->User->createUser($createUserInfo);
                if ($response['error'] == 0) {
                    break;
                }

            }

            $registrationData = [
                'contestId'          => $contestId,
                'userId'             => $response['insert_id'],
                'registrationStatus' => "Accepted",
                'registrationInfo'   => json_encode($value),
                'tempUser'           => "Yes",
                'tempUserPassword'   => $createUserInfo['userPassword'],
                'registrationTime'   => $this->DB->date(),
            ];

            $response = $this->DB->pushData("contest_registration", "insert", $registrationData);

            // echo "<pre>";
            //print_r($response);
            //print_r($response);
            // echo "</pre>";
        }

        return [
            'error'    => 0,
            'errorMsg' => "Successfully Created " . count($userList) . " User",
        ];
    }


    public function registrationButtonStatus($contestId){

    }

    //end contest registration area -----------------------------------


    //start clearification

    public function getClearificationList($filterData){
        $whereInfo=array();
        if(isset($filterData['where']))$whereInfo=$filterData['where'];
        $where = "";
        foreach ($whereInfo as $key => $value) {
            $where.=($where!="")?" and ":"";
            $where.= "contest_clearification.$key=$value";
        }

        $where = ($where !="")?" where ".$where:"".$where;

        $sql = "select * from contest_clearification $where";
        $data   = $this->DB->getData($sql);
        return $data;
    }

    public function addClearification($data){
        //$data['contestClearificationHash'] = 1;
        //$data['contestClea']
    }

    public function updateClearification($data){

    }

    public function deleteClearification($data){

    }

    //end clearification

    //start contest participation auth
    public function checkContestParticipate($contestId)
    {
        $userId = $this->DB->isLoggedIn;
        $sql    = "select * from contest_registration where contestId = $contestId and userId = $userId and registrationStatus = 'Accepted'";
        $data   = $this->DB->getData($sql);
        return isset($data[0]);
    }

    public function checkContestInfoPage($contestId){
        $contestData = $this->getSingleContestInfo($contestId);
        $error = "";

        if (!isset($contestData['contestId'])) {
            $error = "Contest Id Is Not Valid";;
        }
        else if ($contestData['contestPublish'] == "false") {
            $error = "Contest Is Not Publish";
        }

        return [
            'error' => $error != "",
            'errorMsg' => $error
        ];
    }

    public function checkEnterContestAreana($contestId){
        //check contest id
        //contest publish
        //contest status

        //contest participants
        //contest  
    }

    public function checkContestParticipateAuth($contestId)
    {
        $participateList = $this->contestParticipateUserList($contestId);
        $userId = $this->DB->isLoggedIn;
        $ret = array();
        $registrationStatus = "";
        if(isset($participateList[$userId])){
            $registrationStatus = $participateList[$userId]['registrationStatus'];
        }

        return $registrationStatus;
    }

    //end contest participation auth

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


        //frozen time
        $contestTimeDiff = strtotime($nowTime) - strtotime($contestInfo['contestStart']);
        $frozenTimeStart = 1&$contestInfo['contestFreeze']=='true';
        $frozenTimeStart &= $contestTimeDiff >= ($contestInfo['contestFreezePeriod']*60);
        $frozenTimeStart &= $contestInfo['contestUnFreeze']=='false';

        $contestInfo['frozenHourStart']     = $frozenTimeStart;

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

        return $hour . " : " . $minute . " : " . $second;
    }

    public function getContestCommentList($contestId, $commentType = "", $sortType = "asc")
    {
        $commentWhere = $commentType == "" ? "" : " where contestCommentType='$commentType'";
        $sql          = "select * from contest_comment $commentWhere order by contestCommentId $sortType";
        $data         = $this->DB->getData($sql);
        return $data;
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
