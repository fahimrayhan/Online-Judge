<?php
class Download {
   
 	public function __construct(){
     	$this->DB=new Database();
     	$this->conn=$this->DB->conn;
     	$this->TestCase = new TestCase();
 	}

 	public function singleProblemZip($problemId,$json=false){
 		$sql = "select * from problems where problemId=$problemId";
 		$problemData = $this->DB->getData($sql);
 		$problemData = $problemData[0];
 		unset($problemData['problemId']);
 		unset($problemData['userId']);
 		unset($problemData['problemAddedDate']);

 		$dirList = array();

 		array_push($dirList, array("temp/download_problem", "folder"));
 		array_push($dirList, array("temp/download_problem/problem", "folder"));
 		array_push($dirList, array("temp/download_problem/test_case", "folder"));
 		array_push($dirList, array("temp/download_problem/test_case/input", "folder"));
 		array_push($dirList, array("temp/download_problem/test_case/output", "folder"));

 		$dir = "temp/download_problem/problem/";
		foreach ($problemData as $key => $value) {
			array_push($dirList, array($dir, "file", $key, $value));
		}

		$sql="select testCaseIdHash from test_case where problemId=$problemId";
		$testCaseData = $this->DB->getData($sql);
		$c=1;
		$dir = "temp/download_problem/test_case/";
		foreach ($testCaseData as $key => $value) {
			$testCaseVal = $this->TestCase->getTestCaseData($value['testCaseIdHash']);
			array_push($dirList, array($dir."input/", "file", "in_".$c, $testCaseVal['input']));
			array_push($dirList, array($dir."output/", "file", "out_".$c, $testCaseVal['output']));
			$c++;
		}
 		
 		foreach ($dirList as $key => $value) {
 			
 			$dirType = $value[1];
 			$dir = $value[0];
 			$dir = $this->TestCase->Site->getBasePath($dir);
 			
 			if($dirType=="folder"){
 				if(!is_dir($dir))mkdir($dir);
 			}
 			else if($dirType=="file"){
 				$this->TestCase->Site->createFile($dir,$value[2].".txt",$value[3]);
 			}
 			exec("chmod -R 777 ".$dir); 
 		}
		
		$zip = new ZipArchive();
      	$filename = "temp/download_problem.zip";
      	$filename = $this->TestCase->Site->getBasePath($filename);
      	if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
         	 exit("cannot open <$filename>\n");
      	}
      	$dir = '../../temp/download_problem/';
      	$this->createZip($zip,$dir);
      	$zip->close();
 		//print_r($problemData);
		$dir = "temp/download_problem/";
 		$dir = $this->TestCase->Site->getBasePath($dir);
 		$this->delTree($dir);

 		$zipInfo = array();
 		$zipInfo['error'] = 0;
 		$zipInfo['file'] = "temp/download_problem.zip";
 		return $json?json_encode($zipInfo):$zipInfo;
 	}

 	function delTree($dir){

        $files = array_diff(scandir($dir), array('.', '..')); 

        foreach ($files as $file) { 
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file"); 
        }

        return rmdir($dir); 
    } 


 	public function createZip($zip,$dir,$pre=""){
  		if (is_dir($dir)){

    		if ($dh = opendir($dir)){
    		   	while (($file = readdir($dh)) !== false){
     		    // If file
     		    	if (is_file($dir.$file)) {
            			if($file != '' && $file != '.' && $file != '..'){
               				$file=$dir.$file;
               				$newFilename = $pre.substr($file,strrpos($file,'/') + 1);
							$zip->addFile($file,$newFilename);
               				//$zip->addFile($dir.$file);
               				//echo "$pre $newFilename<br/>";
     		       		}
         			}
         			else{
    		        	// If directory
            			if(is_dir($dir.$file) ){
              				if($file != '' && $file != '.' && $file != '..'){
                			// Add empty directory
   		             			$newFileName = $pre.$file;
   		             			$zip->addEmptyDir($newFileName);
                				$folder = $dir.$file.'/';
                				
  		              			$this->createZip($zip,$folder,$pre.$file."/");
              				}
 		 		    	}
         			}	
       			}
 		     	closedir($dh);
 		    }
  		}
 	}
}
?>