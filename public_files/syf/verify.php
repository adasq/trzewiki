<?php

define('LIB_DIR', '../lib/');
define('CONFIG_DIR', '../config/');
define('SMARTY_DIR', LIB_DIR.'Smarty-3.1.11/');



include(LIB_DIR.'DataBase.class.php');
include(LIB_DIR.'functions.php');
include(LIB_DIR.'Catalog.class.php');
include (LIB_DIR.'User.class.php');
include (LIB_DIR.'Friend.class.php');
include (LIB_DIR.'Message.class.php');
include(LIB_DIR.'Link.class.php');
include(LIB_DIR.'Group.class.php');
include(LIB_DIR.'Template.class.php');
include(LIB_DIR.'Validator.class.php');
include(LIB_DIR.'recaptchalib.php');
include(CONFIG_DIR.'config.php');


$DB= new DataBase();

$template = new Template();
$template->configLoad('lang.conf', null);
if(strpos( $_SERVER['REQUEST_URI'] , 'verify.php')){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/verify');
}





if(isset($_GET["id"]) && isset($_GET["token"]) && Validator::validVerifyToken($_GET["token"]) && Validator::validUsername($_GET["id"])){
	
	$id = $_GET["id"];
	$token = $_GET["token"];
	
	if($user= User::getUserByName($id)){
 
		$activated= $user->setUserAsActive($token);
		
		if($activated){
			$template->assign('verify_info',$template->getConfigVariable('VERIFY_info_1'));
		}else{
			$template->assign('verify_info',$template->getConfigVariable('VERIFY_info_2'));
		}
		

	}else{
		$template->assign('verify_info',$template->getConfigVariable('VERIFY_info_3'));
	}
	
	
	
	
}else{
	//redirect
	$template->assign('verify_info',$template->getConfigVariable('VERIFY_info_2'));
}


$DB->disconnect();
$template->assign('PAGE_TITLE','Weryfikacja konta');
$template->assign('CONTENT','verify');
$template->display('main_template.tpl');

?>