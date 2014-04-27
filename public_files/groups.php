<?php
session_start();//sesja

header('Cache-control: private');

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
include(LIB_DIR.'Image.php');
include(LIB_DIR.'recaptchalib.php');
include(CONFIG_DIR.'config.php');

//=======================================================================================================

$DB = new DataBase();
$template= new Template();
$template->configLoad('lang.conf', null);


if(strpos( $_SERVER['REQUEST_URI'] , 'groups.php')){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/groups');
}



$user= getUser();
if(!$user){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
}




$groups=null;
 

if(!isset($_GET["all"])){
	
	if(isset($_GET["search"])){
	
		$tags=$_GET["search"];
		$tags= Validator::clean($tags);
	
		if($tags != ''){
			$names = explode(" ", $tags);
			print_r($names);
				
			$groups= Group::getGroups($names);
	
			if(!$groups){
				$template->assign('groups_search_none',true);
			}
			$template->assign('groups_search',$_GET["search"]);
		}
	
	}
	
	
}else{
	$groups= Group::getGroups();
}




if($groups){
	$template->assign('groups',$groups);
}
$DB->disconnect();
$template->assign('PAGE_TITLE','Przeglądaj grupy');
$template->assign('CONTENT','groups');
$template->display('main_template.tpl');



?>