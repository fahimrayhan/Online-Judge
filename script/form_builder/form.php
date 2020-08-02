<?php
class Form {
   
 	public function __construct(){
     	$this->DB=new Database();
     	$this->conn=$this->DB->conn;
 	}

 	public function getFormList(){

 	}

 	public function getFormInfo($formId){
 		$sql = "select * from form where formId=$formId";
 		$data = $this->DB->getData($sql);
 		return $data;
 	}

 	public function createForm($data){
 		$formData = array();
 		$formData['formTitle'] = "Untitle Form";
 		$formData['userId'] = $this->DB->isLoggedIn;
 		$formData['addedDate'] = $this->DB->date();
 	}
 
}
?>