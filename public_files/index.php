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


include(LIB_DIR.'Base.class.php');
include(LIB_DIR.'Content.class.php');

//=======================================================================================================
$DB = new DataBase();


$template= new Template();
 
$template->configLoad('lang.conf', null); 


if(strpos( $_SERVER['REQUEST_URI'] , 'index.php')){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
}




//$content = Content::getContents();
//echo $content[0]->toString();
 //$content[0]->save();

// $content = new Content();
// $content->content_key = "key heh";
// $content->content_value = "val heh";
// $content->deleted = 0;
// $content->save();
 
$content = new Content();
$content= $content->getContentById(8);
if($content){
	print_r($content->toString());
}else{
	echo "lipa";
}
	$template->assign('CONTENT','home');
	$template->assign('PAGE_TITLE','Strona Główna');
	




$template->display('main_template.tpl');



?>