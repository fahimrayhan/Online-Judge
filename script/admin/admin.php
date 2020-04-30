<?php
class Admin {
   
 	public function __construct(){
     	$this->DB=new Database();
     	$this->conn=$this->DB->conn;
 	}
 
}
?>