<?php

/* 
 * To change this license header, choose License Headers in 
 * lkknjkljnlnl
 * kjkhkProject Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    require_once 'include/add_recipe_function.php';
    $db=new add_recipe_function();
    
    $response['error']=true;
    
    if(isset($_GET['user_fk']) && isset($_GET['recipe_name']) 
        && isset($_GET['cooking_time']) && isset($_GET['serving'])
        && isset($_GET['ingredients']) && isset($_GET['recipe_steps'])
        && isset($_GET['categories'])  && isset($_GET['img']) ){
        
     
        $user_fk=$_GET['user_fk'];
        $recipe_name=$_GET['recipe_name'];
        $cooking_time=$_GET['cooking_time'];
        $serving=$_GET['serving'];
        $ingredients=$_GET['ingredients'];
        $recipe_steps=$_GET['recipe_steps'];
        $categories=$_GET['categories'];
        $img=$_GET['img'];
        
        $currentDate=date("ymd");
        $currentTime =date("his");
        $randomNumber = rand(0, 5000);
        $imgName="img_".$currentDate .$currentTime .$randomNumber."jpg";
                
        
        $recipe_id=$db->insertRecipe($user_fk, $recipe_name, $cooking_time, $serving);
        
        if($recipe_id){
            $db->insertRecipe_categories ($recipe_id, $categories);
                               
            $decode= base64_decode($img);
            file_put_contents("recipeImage/".$imgName, $decode);
            $db->insertRecipe_image($recipe_id, $imgName);
            
            $db->insertRecipe_Ingredients($recipe_id, $ingredients);
            $db->insertRecipe_steps($recipe_id, $recipe_steps);
            
            $response['error']=false;
            $response['msg']='Recipes upload successully';
            
            echo json_encode($response);
            
        }else{
            
            $response['msg']='Unknow error occurrding';
            
            echo json_encode($response);
        }
    }
    else{
        $response['msg']='miss parameter user_fk,recipe_name,cooking_time'
                . ',serving,ingredients,recipe_steps,categories,img';
        echo json_encode($response);
    }

?>
