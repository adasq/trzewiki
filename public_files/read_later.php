<?php

session_start();//sesja

header('Cache-control: private');

define('LIB_DIR', '../lib/');
define('CONFIG_DIR', '../config/');
define('SMARTY_DIR', LIB_DIR.'Smarty-3.1.11/');


include(LIB_DIR.'DataBase.class.php');
include(LIB_DIR.'functions.php');
include (LIB_DIR.'User.class.php');
include(LIB_DIR.'Link.class.php');
include(LIB_DIR.'Template.class.php');
include(CONFIG_DIR.'config.php');

//=======================================================================================================

$DB = new DataBase();
$template= new Template();

$template->configLoad('lang.conf', null);
if(strpos( $_SERVER['REQUEST_URI'] , 'read_later.php')){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/readlater');
}


$user= getUser();
if(!$user){
	
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
}



if(isset($_POST["wlid"])){

	$wl_id = $_POST["wlid"];
	if(is_numeric($wl_id)){
		if(Link::deleteWtachlaterLink($user, (int)$wl_id)){
			
			//header('Location: read_later.php');
		}
		
	}

}


 



$links = Link::getWatchLaterLinks($user);


if($links){
	$template->assign('links',$links);
	$template->assign('watch_later_links',true);
}
$DB->disconnect();
$template->assign('PAGE_TITLE','Linki dodane do przeczytania na później');
$template->assign('CONTENT','read_later');
$template->display('main_template.tpl');