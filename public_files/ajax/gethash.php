<?php

define('LIB_DIR', '../../lib/');
include(LIB_DIR.'DataBase.class.php');;
include (LIB_DIR.'User.class.php');
include (LIB_DIR.'Catalog.class.php');
include (LIB_DIR.'functions.php');
include (LIB_DIR.'Validator.class.php');
include (LIB_DIR.'Group.class.php');


$DB = new DataBase();

 


if(isset($_POST["pass"]) && isset($_POST["id"])){

	
	$id= $_POST["id"];
	$pass=getPasswordHash( $_POST["pass"] );	
	
	if(Validator::validUsername($id)){
		
		$user = User::getUserByName($id);
		if($user){

			if($user->password === $pass){
				$hash= $user->getHash();
				$result =   array('error' => false, 'hash' => $hash);
				echo json_encode($result);	
				return;
			}else{
				$result =   array('error' => true, 'hash' => 'nie te pswd');
			}
			
			
			
			
		}else{
			//nie ma usera
			$result =   array('error' => true, 'hash' => 'nie ma usera');
		}
		
	}else{
		//zly login
		$result =   array('error' => true, 'hash' => 'zly login');
	}
	
	
	
	

	
	
	
	
	
	
	
}else{
	//posty nie ustawione
	$result =   array('error' => true, 'hash' => 'posty nie ustawione');
}

$DB->disconnect();

echo json_encode($result);




?>