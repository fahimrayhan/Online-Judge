

<?php 
// Create ZIP file
function downloadFile(){
      $zip = new ZipArchive();
      $filename = "temp/myzipfile.zip";

      if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
          exit("cannot open <$filename>\n");
      }

      $dir = 'file/';

      // Create zip
      createZip($zip,$dir);

      $zip->close();

      $file_url = '../../temp/test.txt';
      header('Content-Type: application/octet-stream');
      header("Content-Transfer-Encoding: Binary"); 
      header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
      readfile($file_url);
      //unlink($filename);
  }

  function createZip($zip,$dir){
  if (is_dir($dir)){

    if ($dh = opendir($dir)){
       while (($file = readdir($dh)) !== false){
 
         // If file
         if (is_file($dir.$file)) {
            if($file != '' && $file != '.' && $file != '..'){
 
               $zip->addFile($dir.$file);
            }
         }else{
            // If directory
            if(is_dir($dir.$file) ){

              if($file != '' && $file != '.' && $file != '..'){

                // Add empty directory
                $zip->addEmptyDir($dir.$file);

                $folder = $dir.$file.'/';
 
                // Read data of the folder
                createZip($zip,$folder);
              }
            }
 
         }
 
       }
       closedir($dh);
     }
  }
}
?>