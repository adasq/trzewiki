<?php
session_start();//sesja




define('LIB_DIR', '../lib/');
define('CONFIG_DIR', '../config/');
define('SMARTY_DIR', LIB_DIR.'Smarty-3.1.11/');


include(LIB_DIR.'DataBase.class.php');
include (LIB_DIR.'User.class.php');
include(LIB_DIR.'Template.class.php');
include(LIB_DIR.'functions.php');

//=======================================================================================================



$template= new Template();

$template->configLoad('lang.conf', null);

if(strpos( $_SERVER['REQUEST_URI'] , 'info.php')){
	header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
}


$DB= new DataBase();
$user= getUser();

$action= $_GET["action"];


$pattern = '/^(about|rules|contact|faq)$/';
$DB->disconnect();
if(preg_match($pattern, $action)){
	
	$template->assign('action',$action);
	$template->assign('CONTENT','info');
	$template->assign('PAGE_TITLE',$action );
	$template->display('main_template.tpl');
}else{
	
	header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
}
 



?>