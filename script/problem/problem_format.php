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
 	$notes=$info['notes'];
 	$constraint_description=$info['constraintDescription'];
 	$problemName=isset($info['problemName'])?$info['problemName']:"---";
 	$cpu=isset($info['timeLimit'])?$info['timeLimit']:"";
 	$memory=isset($info['memoryLimit'])?$info['memoryLimit']:"";
 	$testCaseSampleList = isset($info['testCaseSampleList'])?$info['testCaseSampleList']:array();

 	$this->addMathScript();
    echo "<div>";
 	if(isset($info['problemName']))
 		echo $this->addProblemNameArea($problemName,$cpu,$memory);

 	echo $description;
 	if($input_description!=""){
        echo  $this->addOptionBreak("Input");
        echo $input_description;
    }

    if($constraint_description!=""){
        echo  $this->addOptionBreak("Constraints");
        echo $constraint_description;
    }

    if($output_description!=""){
        echo  $this->addOptionBreak("Output");
        echo $output_description;
    }

    if(!empty($testCaseSampleList)){
        echo  $this->addOptionBreak("Examples");
    }

 	foreach ($testCaseSampleList as $key => $value) {
 		echo $this->addExample($key+1,$value['input'],$value['output']);
 	}
 	
    if($notes!=""){
        echo  $this->addOptionBreak("Notes");
        echo $notes;
    }

 	echo "</div>";

 }

 public function addOptionBreak($name){
 	return "<div class='problem_bold_text'>$name</div>";
 }

 public function addProblemNameArea($name,$cpu,$memory){
 	if($memory!="")$memory/=1024;
 	return "<div class='problem_name_area'>
 		<div class='problem_name'>$name</div>
 		<div class='problem_limit'>
 			Time: $cpu s<br/>
			Memory: $memory MB
		</div>

 	</div>";
 }

 public function addExample($sl,$input,$output){
    $input = nl2br(htmlspecialchars($input));
    $output = nl2br(htmlspecialchars($output));
    $smInput = "problemSampleInput_$sl";
    $smOutput = "problemSampleOutput_$sl";
 	return "<table class='table table-bordered'>
                <thead>
                    <tr>
                        <th class='th_input_ex' style='width: 50%'>Input <div class='pull-right'><button value='$smInput' class='btn-sm cpyBtn' onclick='copyTestCase(this)'>copy</button></div></th>
                        <th class='th_input_ex' style='width: 50%'>Output<div class='pull-right'><button class='btn-sm cpyBtn' value='$smOutput' onclick='copyTestCase(this)'>copy</button></div></th>
                    </tr>
                </thead>
                <tbody style='background-color: #EFEFEF'>
                    <tr>
                        <td class='td_pre' style='width: 50%; padding: 0px;'>
                        <div id='$smInput'>$input</div>  
                        </td>
                        <td style='padding:0px;' class='td_pre'>
                            <div id='$smOutput'>$output</div>
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
 		$languageId=$value['languageId'];
 		$languageName=$value['languageName'];
 		echo "<option value='$languageId'>$languageName</option>";
 	}
 	echo "</select>";
 	echo "<div style='margin-top: 10px;'></div><style>#sourceCodeEditor {position: absolute;width: 500px; height: 400px;}</style>";
 	echo "<textarea id='sourceCodeEditor' style='height: 350px; width: 100%;'></textarea>";
 	echo "<div id='submission_error' style='display: none' class='alert alert-danger'></div>";
	echo "<center><button id='btnCreateSubmit' onclick='$jsFunctionName()'>Submit</button></center>";
 }

}
?>