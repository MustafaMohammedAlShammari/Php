<?php 

class db_connect {
	private $conn;
	
	public function connect(){
		require_once 'config.php';
		
		$this->conn=new mysqli(db_host,db_user,db_password,db_database);
	
		return $this->conn;
	}
	
}

?>