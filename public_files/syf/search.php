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
include(LIB_DIR.'Tag.class.php');
include(LIB_DIR.'Template.class.php');
include(LIB_DIR.'Link.class.php');
include(LIB_DIR.'Validator.class.php');
 

$DB = new DataBase();
$template = new Template();
$user= getUser();



$template->configLoad('lang.conf', null);
if(strpos( $_SERVER['REQUEST_URI'] , 'search.php')){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/search');
}




if(!$user){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
}


if(isset($_GET["q"])){
	
	$tags= $_GET["q"];

	$tags= Validator::clean($tags);
	
	$tags_name_arr2 = explode(' ',  $tags);
	$tags_name_arr= array();
	 
	 
	if(sizeof($tags_name_arr2) > 0){
		 
		foreach ($tags_name_arr2 as $tag_name){
			if(Validator::validTag($tag_name)){
				$tags_name_arr[]=$tag_name;
			}
		}
	}
	
	
	if(sizeof($tags_name_arr) > 0){

		$tags_ids_arr= Tag::getIdsByTags($tags_name_arr);
		
		$links = Tag::getLinksByTags($tags_ids_arr, $user);
		
		$template->assign('links',$links);
		
		
	}else{
		
	}
	

	
	$template->assign('search',$_GET["q"]);
	
}
	





$DB->disconnect();
$template->assign('PAGE_TITLE','Szukaj linków');
$template->assign('CONTENT','search');
$template->display('main_template.tpl');