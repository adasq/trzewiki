<?php
session_start();//sesja 



if(strpos( $_SERVER['REQUEST_URI'] , 'login.php')){
	header('Location: ../login');
}


header('Cache-control: private');

define('LIB_DIR', '../lib/');
define('CONFIG_DIR', '../config/');
define('SMARTY_DIR', LIB_DIR.'Smarty-3.1.11/');

include(LIB_DIR.'DataBase.class.php');
include(LIB_DIR.'functions.php');
include (LIB_DIR.'User.class.php');
include(LIB_DIR.'Template.class.php');
include(LIB_DIR.'Validator.class.php');






$DB = new DataBase();
$template= new Template();
$template->configLoad('lang.conf', null);


if(strpos( $_SERVER['REQUEST_URI'] , 'login.php')){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/login');
}



if(isset($_GET['logout'])){
	$_SESSION = array();
	session_unset();
	session_destroy();
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
}

if(isset($_SESSION['access']) && isset($_SESSION['userId'])){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
}

	
	
	
	if(isset($_COOKIE["username"])){
		$template->assign('log_username',$_COOKIE["username"]);
	}

	if(isset($_POST['submitted'])){	
			
		$username = $_POST['log_username'];
		$password= $_POST['log_password'];
		
		if($username != '' && $password !=''){
		
			if($user = User::getUserByName($username)){
				 	
				if($user->is_active && getPasswordHash($password)==$user->password){
					$_SESSION['access'] = TRUE;
					$_SESSION['userId'] = $user->user_id;
					$_SESSION['username'] =$user->username;
					setcookie("username", $username);
					header('Location: home');
				}else{
					$template->assign('login_error',$template->getConfigVariable('LOGIN_error_2'));
				}
				
				
			 }else{
			 	$template->assign('login_error',$template->getConfigVariable('LOGIN_error_2'));
			 }
		
			
		}else{
	
			$template->assign('login_error',$template->getConfigVariable('LOGIN_error_1'));
				
		}

		if(isset($_POST['log_username'])){$template->assign('log_username',$_POST['log_username']);}
	}else{
	//echo 'unset submitted';
	}
	
	
	
	$DB->disconnect();
$template->assign('PAGE_TITLE','Zaloguj się');
$template->assign('CONTENT','login');
$template->display('main_template.tpl');
	 
?>
