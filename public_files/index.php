<?php
session_start();//sesja




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
require LIB_DIR.'Benchmark/Timer.php';
//=======================================================================================================

$template= new Template();
 

$template->configLoad('lang.conf', null); 


if(strpos( $_SERVER['REQUEST_URI'] , 'index.php')){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
}


	$template->assign('CONTENT','home');
	$template->assign('PAGE_TITLE','Strona Główna');
	




$template->display('main_template.tpl');



?>