<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of add_recipe_function
 *
 * @author Mahmood Ali
 * Mustafa Mohammed
 */
class add_recipe_function {
    //put your code here
    private $conn;
    
    public function __construct() {
        require_once 'include/db_connect.php';
        $db = new db_connect();
        $this->conn=$db->connect();
    }
    
    public function insertRecipe($user_fk,$recipe_name,$cooking_time,$serving){
        $stmt=$this->conn->prepare("insert into recipes (user_fk,title,"
                . "cooking_time,serving) values(?,?,?,?) ");
        $stmt->bind_param("isii",$user_fk,$recipe_name,$cooking_time,$serving);
        if($stmt->execute()){
           
            $stmt=$this->conn->prepare("select recipe_id from recipes where "
                    . "user_fk=? order by recipe_id DESC" );
            $stmt->bind_param("i",$user_fk);
            $stmt->execute();
            
            $stmt->bind_result($recipe_id);
            $stmt->fetch();
            
            $stmt->close();
            
            return $recipe_id;
            
        }else{
            echo "false";
            return false;
        }
        
    }
    
    public function insertRecipe_categories($recipe_id,$categories){
        
        $stmt=$this->conn->prepare("insert into recipe_category "
                . "(recipe_fk,category_fk) values (? ,?)");
        
        $mCatrgories = explode(",", $categories);
        $isSuccess=0;
        
        foreach ($mCatrgories as $catrgory) {
            $stmt->bind_param("ii",$recipe_id,$catrgory);
            $isSuccess=$stmt->execute();
        }
        
        return $isSuccess;
       
    }
    
    public function insertRecipe_image($recipe_id,$img){
        $stmt=$this->conn->prepare("insert into recipes_img (recipe_fk,img_url)"
                . " values(?,?)");
        $stmt->bind_param("is",$recipe_id,$img);
        
        if($stmt->execute()){
            $stmt->close();
            return true;
        }else{
            $stmt->close();
            echo  "false";
            return false;
        }
    }
    
    public function insertRecipe_Ingredients($recipe_id,$ingredients){
        $stmt=$this->conn->prepare("insert into ingredients (recipe_fk,ingredient)"
                . " values(?,?)");
        $stmt->bind_param("is",$recipe_id,$ingredients);
        
        if($stmt->execute()){
            $stmt->close();
            return true;
        }else{
            $stmt->close();
            echo  "false";
            return false;
        }
    }
    
    
    public function insertRecipe_steps($recipe_id,$recipe_steps){
        $stmt=$this->conn->prepare("insert into recipe_steps (recipe_fk,instructions)"
                . " values(?,?)");
        $stmt->bind_param("is",$recipe_id,$recipe_steps);
        
        if($stmt->execute()){
            $stmt->close();
            return true;
        }else{
            $stmt->close();
            echo  "false";
            return false;
        }
    }
    
    
}
