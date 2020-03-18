<?php
class Site
{
    
    //starting connection
    public function __construct()
    {
        
        $this->DB   = new Database();
        $this->conn = $this->DB->conn;
    }
    
    public function getBackPageUrl()
    {
        
        $main_url = $_SERVER['REQUEST_URI'];
        
        $url       = explode('/', $main_url);
        $len       = count($url);
        $page_name = $url[$len - 1];
        
        //check if login or register page then its back url is always same
        if (strpos($main_url, 'login.php') !== false)
            return (isset($_GET['back'])) ? $_GET['back'] : "index.php";
        if (strpos($main_url, 'register.php') !== false)
            return (isset($_GET['back'])) ? $_GET['back'] : "index.php";
        
        return base64_encode($page_name == "" ? "index.php" : $page_name);
    }

    public function redirectPage($url){
        echo "<script>window.location.replace('$url');</script>";
    }


    public function dateToAgo($timestamp){
      $time_ago = strtotime($timestamp);  
      $current_time = $this->DB->date();
      $current_time = strtotime($current_time); 

      $time_difference = $current_time - $time_ago;  
      $seconds = $time_difference;  
      $minutes      = round($seconds / 60 );           // value 60 is seconds  
      $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
      $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
      $weeks          = round($seconds / 604800);          // 7*24*60*60;  
      $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
      $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
      if($seconds <= 60)return "Just Now";  
      else if($minutes <=60)  
      {  
        if($minutes==1) return "1 minute ago";   
        else   return "$minutes minutes ago";   
   }  
      else if($hours <=24)  
      {  
     if($hours==1)  
           {  
       return "an hour ago";  
     }  
           else  
           {  
       return "$hours hrs ago";  
     }  
   }  
      else if($days <= 7)  
      {  
     if($days==1)  
           {  
       return "yesterday";  
     }  
           else  
           {  
       return "$days days ago";  
     }  
   }  
      else if($weeks <= 4.3) //4.3 == 52/12  
      {  
     if($weeks==1)  
           {  
       return "a week ago";  
     }  
           else  
           {  
       return "$weeks weeks ago";  
     }  
   }  
       else if($months <=12)  
      {  
     if($months==1)  
           {  
       return "a month ago";  
     }  
           else  
           {  
       return "$months months ago";  
     }  
   }  
      else  
      {  
     if($years==1)  
           {  
       return "one year ago";  
     }  
           else  
           {  
       return "$years years ago";  
     }  
   }  
    }
    
    public function createFile($url, $file_name, $txt)
    {
        $new_file_name = $url . $file_name;
        $file          = fopen($new_file_name, "w");
        fwrite($file, $txt);
        fclose($file);
    }
    
    public function readFile($path)
    {
        $basePath = dirname(__FILE__);
        
        //problem for cpanel path cronjob need specefic file name otherwise its go to infinate loop
        if (!strpos($basePath, 'wamp64') !== false) {
            $basePath = explode("/", $basePath);
            array_pop($basePath);
            array_pop($basePath);
            $basePath = implode('/', $basePath);
            $path     = $basePath . '/' . $path;
        }
        $data = "";
        $file = fopen($path, "r");
        while (!feof($file)) {
            $data .= fgets($file);
        }
        fclose($file);
        return $data;
    }
    
    
}
?>