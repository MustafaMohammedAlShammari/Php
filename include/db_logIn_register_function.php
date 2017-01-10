<?php

class db_function{
    private $conn;
    
    public function __construct() {
        require_once 'db_connect.php';
        $db=new db_connect();
        $this->conn=$db->connect();
    }
    
    public function __destruct() {
        
    }
    
    public function isUserExisted($email){
        $stmt=$this->conn->prepare("select email from users where email=?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows>0){
            $stmt->close();
            return TRUE;
        }
        else {
            $stmt->close();
            return FALSE;
        }
       
 
    }
    
   
     public function isUser_block($device_id){
		
        $stmt=$this->conn->prepare("select status from block_users where device_id=?");
        $stmt->bind_param("s",$device_id);
        $stmt->execute();
        $stmt->store_result();
		
        $stmt->bind_result($status);
        $stmt->fetch();
		
        if($stmt->num_rows>0){
            $stmt->close();
            if($status)             
                return 'block';
	
            return  'unBlock';
        }
        else{
            $stmt->close();
           return  'newUser';
        }
       
    }
    
    public function insertUser_block($device_id,$user_fk){
      
        $stmt=$this->conn->prepare("insert into block_users (device_id,user_fk) values (?,?)  ");
        $stmt->bind_param("si",$device_id,$user_fk);
        
        if($stmt->execute()){
            $stmt->close();
            return true;
        }
            
        else{
            $stmt->close();       
            return false;
        }
           
    }
    
    public function insertUser($name,$email,$password,$img_url){
        
        
        $stmt=$this->conn->prepare("insert into users (name,email,password,img_url) values (?,?,?,?)  ");
        $stmt->bind_param("ssss",$name,$email,$password,$img_url);
        if($stmt->execute()){
            // return user_fk 
            $stmt=$this->conn->prepare("select user_id from users where email =? ");
            $stmt->bind_param("s",$email);
            $stmt->execute();
            
            $stmt->bind_result($user_fk);
            $stmt->fetch();
       
            $stmt->close();
            return $user_fk;
        }
            
        else{
            $stmt->close(); 
            return false;
        }
           
        
    }
    
    public function getEmail_password($email,$password){
        $stmt=$this->conn->prepare("select user_id,name, password from users where email=? and password=?");
        $stmt->bind_param("ss",$email,$password);
        $stmt->execute();
        
               
        $stmt->store_result();
        
        if($stmt->num_rows>0){
      
            $stmt->bind_result($user_id,$name,$dbPassord);
            $stmt->fetch();
            $stmt->close();
         
             
            if ($dbPassord == $password) {
                $response =array("user_id"=>$user_id,"name"=>$name);
                
                return $response;
            }
            return false;
        }
        else{
            $stmt->close();
            return false;
        }
        
    }
}

?>
