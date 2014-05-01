<?php
session_start();

define('LIB_DIR', '../lib/');
define('CONFIG_DIR', '../config/');
define('SMARTY_DIR', LIB_DIR.'Smarty-3.1.11/');

include(LIB_DIR.'DataBase.class.php');
include(LIB_DIR.'functions.php');
include (LIB_DIR.'User.class.php');
include (LIB_DIR.'Friend.class.php');
include(LIB_DIR.'Group.class.php');
include(LIB_DIR.'Template.class.php');
include(LIB_DIR.'Validator.class.php');
 
$DB = new DataBase();

$template = new Template();
$template->configLoad('lang.conf', null);


if(strpos( $_SERVER['REQUEST_URI'] , 'users.php')){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/people');
}


$user= getUser();
if(!$user){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
}


 


$users=null;




if(isset($_GET["q"])){
	
	$username=$_GET["q"];
	if(Validator::validSearchUsername($username)){
		
		$users=User::getUsers($username);
		if(!$users){
			$template->assign('users_search_none',true);
		}
		
		
		$template->assign('users_search', $_GET["q"]);
	}else{
		$template->assign('users_search_none',true);
	}
	
}else{
 	//$users= User::getUsers();
 }


if($users){
	$template->assign('users',$users);
}







$DB->disconnect();
$template->assign('PAGE_TITLE','Przeglądaj użytkowników');
$template->assign('CONTENT','users');
$template->display('main_template.tpl');