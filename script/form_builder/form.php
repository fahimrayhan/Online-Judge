<?php
class Form
{

    public function __construct()
    {
        $this->DB   = new Database();
        $this->conn = $this->DB->conn;
        $this->SiteHash=new SiteHash();
    }

    public function getFormList()
    {

    }

    public function getFormIdFromHashId($formHashId){
        $sql  = "select * from form where formHashId = '$formHashId'";
        $data = $this->DB->getData($sql);
        return isset($data[0]) ? $data[0]['formId'] : -1;
    }

    public function getFormWhere($filterData){
        $where = "";
        if(isset($filterData['formId'])) 
            $where.="formId=".$filterData['formId'];
        else if(isset($filterData['formHashId']))
            $where.="formHashId=".$filterData['formHashId'];

        if($where!="")$where = "where ".$where;
        return $where;
    }

    public function getFormInfo($filterData)
    {
        
        $where = $this->getFormWhere($filterData);
        $sql  = "select * from form $where";
        $data = $this->DB->getData($sql);
        return isset($data[0]) ? $data[0] : array();
    }

    public function formQuestionList($filterData)
    {
        $where = $this->getFormWhere($filterData);
        if($where == "")return array();
        $sql  = "select * from form_question $where";
        $data = $this->DB->getData($sql);
        $data = $this->processFormQuestionList($data);
        return $data;
    }

    public function processFormQuestionList($data){
        foreach ($data as $key => $value) {
            $formQuestionInputData = json_decode($value['formQuestionInputData'],true);
            $formQuestionInputData['name'] = $value['formQuestionTitle'];
            $data[$key]['formQuestionInputData'] = json_encode($formQuestionInputData);
        }
        return $data;
    }

    public function createForm($data)
    {
        $formData              = array();
        $formData['formTitle'] = "Untitle Form";
        $formData['userId']    = $this->DB->isLoggedIn;
        $formData['addedDate'] = $this->DB->date();
    }

    public function processFormQuestion($fieldData)
    {

        $data['formId'] = $fieldData['formId'];

        $data['formQuestionTitle']       = trim($fieldData['formQuestionTitle']);
        $data['formQuestionDescription'] = $fieldData['formQuestionDescription'];
        $data['formQuestionHint'] = $fieldData['formQuestionHint'];
        $data['formQuestionDescription'] = $fieldData['formQuestionDescription'];

        //print_r($fieldData);

        $error = $this->formQuestionFilter($fieldData);

        if ($error != "") {
            return array(
                'error'    => 1,
                "errorMsg" => $error,
            );
        }

        $inputFieldData         = $this->processInputField($fieldData['formQuestionInputData'],$fieldData['formType']);

        if (isset($inputFieldData['required'])) {
            $data['formQuestionRequired'] = true;
        }

        $inputFieldData = json_encode($inputFieldData);

        $data['formQuestionInputData'] = $this->DB->buildSqlString($inputFieldData);

        return $data;
    }

    public function formQuestionFilter($data)
    {
        $error = "";
        if ($data['formQuestionTitle'] == "") {
            $error = "Title Field Is Empty";
        }
        else if (!isset($data['formType'])) {
            $error = "Form type can not select";
        }

        return $error;

    }

    public function processInputField($inputFieldData,$type)
    {
        $data = array();
        $data['type'] = $type;
        if($type == "select"){
            foreach ($inputFieldData['options'] as $key => $value) {
                $data['options'][$value['value']] = $value['text'];
            }
            unset($inputFieldData['options']);
        }
        
        foreach ($inputFieldData as $key => $value) {
            $data[$value['name']] = $value['value'];
        }

        return $data;
    }

    public function addQuestion($data)
    {
        $response = $this->DB->pushData("form_question", "insert", $data);

        print_r($data);

        if($response['error'] == 0){
            $questionId = $response['insert_id'];
            $hashId = $this->SiteHash->getHash($questionId);
            $updateData = array(
                'formQuestionHashId' => $hashId,
                'formQuestionId' => $questionId
            );
            $this->DB->pushData("form_question", "update", $updateData);
        }

        return $response;
    }

    public function getFormQuestionIdFromHash($formQuestionHashId)
    {
        $sql  = "select * from form_question where formQuestionHashId = '$formQuestionHashId'";
        $data = $this->DB->getData($sql);
        return isset($data[0]) ? $data[0]['formQuestionId'] : -1;
    }

    public function deleteFormQuestion($formQuestionHashId)
    {
        $formQuestionId = $this->getFormQuestionIdFromHash($formQuestionHashId);
        if ($formQuestionId == -1) {
            return array(
                'error'    => 1,
                'errorMsg' => 'Invalid action',
            );
        }

        $data = array(
            'formQuestionId' => $formQuestionId,
        );

        $response = $this->DB->pushData("form_question", "delete", $data);

        return $response;
    }

}
