<?php
class ProblemFormat {
   
//starting connection
 	public function __construct(){
     	$this->DB=new Database();
     	$this->conn=$this->DB->conn; 
 	}
 
//end dabtabase connection
 public function buildProblemFormat($info){
 	$description=$info['problemDescription'];
 	$input_description=$info['inputDescription'];
 	$output_description=$info['outputDescription'];
 	$input_example=$info['inputExample'];
 	$output_example=$info['outputExample'];
 	$notes=$info['notes'];
 	$constraint_description=$info['constraintDescription'];
 	$problemName=isset($info['problemName'])?$info['problemName']:"---";
 	$cpu=isset($info['cpuTimeLimit'])?$info['cpuTimeLimit']:"";
 	$memory=isset($info['memoryLimit'])?$info['memoryLimit']:"";
 	
 	$this->addMathScript();

 	if(isset($info['problemName']))
 		echo $this->addProblemNameArea($problemName,$cpu,$memory);

 	echo $description;
 	echo  $this->addOptionBreak("Input");
 	echo $input_description;
 	echo  $this->addOptionBreak("Constraints");
 	echo $constraint_description;
 	echo  $this->addOptionBreak("Output");
 	echo $output_description;
 	echo  $this->addOptionBreak("Example");
 	echo $this->addExample($input_example,$output_example);
 	echo  $this->addOptionBreak("Notes");
 	echo $notes;
 	

 }

 public function addOptionBreak($name){
 	return "<div class='problem_bold_text'>$name</div>";
 }

 public function addProblemNameArea($name,$cpu,$memory){
 	if($memory!="")$memory/=1024;
 	return "<div class='problem_name_area'>
 		<div class='problem_name'><span class='label label-default number_label'>10001</span> $name</div>
 		<div class='problem_limit'>
 			CPU: $cpu s<br/>
			Memory: $memory MB
		</div>

 	</div>";
 }

 public function addExample($input,$output){
 	return "<table class='table table-bordered'>
                <thead>
                    <tr>
                        <th class='th_input_ex' style='width: 50%'>Input</th>
                        <th class='th_input_ex' style='width: 50%'>Output</th>
                    </tr>
                </thead>
                <tbody style='background-color: #EFEFEF'>
                    <tr>
                        <td class='td_pre' style='width: 50%; padding: 0px;'>
                           $input
                        </td>
                        <td style='padding:0px;' class='td_pre'>
                            $output
                        </td>
                    </tr>
                </tbody>
            </table>";
 }

 public function addMathScript(){
 	echo "<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML'></script>";
 }

 public function getSubmissionArea($jsFunctionName){
 	$sql="select * from judge_setting where judgeSettingId=1";
 	$data=$this->DB->getData($sql);
 	$data=json_decode($data[0]['languageList'],true);

 	echo "<select class='form-control' id='selectLanguage' onclick='selectLanguage()'><option value='-1'>Select Language</option>";
 	foreach ($data as $key => $value) {
 		$languageId=$value['id'];
 		$languageName=$value['name'];
 		echo "<option value='$languageId'>$languageName</option>";
 	}
 	echo "</select>";
 	echo "<div style='margin-top: 10px;'></div>";
 	echo "<textarea id='sourceCodeEditor' style='height: 250px; width: 100%;'></textarea>";
 	echo "<div id='submission_error' style='display: none' class='alert alert-danger'></div>";
	echo "<center><button id='btnCreateSubmit' onclick='$jsFunctionName()'>Submit</button></center>";
 }

}
?>