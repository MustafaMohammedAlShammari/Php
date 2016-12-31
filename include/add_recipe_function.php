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
 */
class add_recipe_function {
    //put your code here
    private $conn;
    
    public function __construct() {
        require_once 'include/add_recipe_function';
        $db = new db_connect();
        $this->conn=$db->connec();
    }
    
    public function InsertRecipe($user_fk,$recipe_name,$cooking_time,$serving,$ingredients,$recipe_step){
        
    }
    
    
}
