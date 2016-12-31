<?php

require_once 'include/db_logIn_register_function.php';

$db=new db_function();

$response['error']=true;
if(isset($_POST['name']) & isset($_POST['email']) & isset($_POST['password'])
        & isset($_POST['img']) & isset($_POST['device_id']) ){
    
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $img=$_POST['img'];
    $device_id=$_POST['device_id'];
    
    $dt= date("Ymd");
    $ti= date("his");
    $rnd= rand(0,5000);
    $imgName="img_".$dt.$ti.$rnd.".jpg";
    $decod= base64_decode("$img");
 
    
    $userStatus= $db->isUser_block($device_id);
	
    if( $userStatus=="unBlock" || $userStatus=="newUser"){
        
        if(!$db->isUserExisted($email)){
               $user_fk=$db->insertUser($name, $email, $password, $imgName);
             
               if($user_fk){
                   file_put_contents("userProfileImage/".$imgName, $decod);
                   $db->insertUser_block($device_id, $user_fk);
                   
                   $response['msg']='register successfully';
                   $reponse['error']=False;
                   echo json_encode($response);
               }
               else{
                    $response['msg']='unknow error occurding';
                    echo json_encode($response);
               }
             
               
        }
        else{
            $response['msg']='email is alread exists';
            echo json_encode($response);
        }
    }
    else{
        $response['msg']='your block  ياكلب يا حقير';
        echo json_encode($response);
    }
    
      
      
      
}
else {
    $response['msg']='miss param name,email....etc';
    echo json_encode($response);
}

?>

