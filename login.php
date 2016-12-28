<?php

require_once 'include/db_logIn_register_function.php';

$db=new db_function();

$response['error']=true;
if(isset($_POST['email']) & isset($_POST['password'])
        & isset($_POST['device_id']) ){
 
    $email=$_POST['email'];
    $password=$_POST['password'];
    $device_id=$_POST['device_id'];
    
   
    $userStatus= $db->isUser_block($device_id);
    if($userStatus=="newUser" || $userStatus=="unBlock"){
        $loginStatus=$db->getEmail_password($email,$password);
        if($loginStatus){

            $response['msg']='Login succussfully';
            $response['user_id']=$loginStatus['user_id'];
            $response['name']=$loginStatus['name'];
            $reponse['error']=False;
            echo json_encode($response);    
        }
        else{
            $response['msg']='error in email or password';
            echo json_encode($response);
        }
    }
    else{
        $response['msg']='your block';
        echo json_encode($response);
    }
    
    
      
}
else {
    $response['msg']='miss param email,password,device_id';
    echo json_encode($response);
}

?>

