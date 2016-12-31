<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of app_config
 *
 * @author Mahmood Ali
 */
class app_config {
    //put your code here
   
    private $conn;
    
    public function __construct() {
        
        require_once 'db_connect.php';
        $db=new db_connect();
        $this->conn=$db->connect() ;
        
    }
    
    public function __destruct() {
        $this->conn->close();
    }
    
    
    public  function checkAppStatus(){
        $stmt=$this->conn->query("select is_app_work,message from app_config");
        $result=$stmt->fetch_assoc();
        $stmt->close();
        
        return  $result;
    }
   
}

?>
