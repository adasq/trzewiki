<?php
session_start();

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
include(LIB_DIR.'Tag.class.php');
include(LIB_DIR.'Validator.class.php');
include(LIB_DIR.'recaptchalib.php');
include(CONFIG_DIR.'config.php');




$DB = new DataBase();

$template= new Template();


$template->configLoad('lang.conf', null);
if(strpos( $_SERVER['REQUEST_URI'] , 'putlink.php')){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/send');
}



$user=getUser();
if(!$user){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/login');
}


//katalogi i grupy:----------------

//pobierz katalogi:
$catalogs= $user->getCatalogOrderedList();
if($catalogs){
	$template->assign('catalogs',$catalogs);
}


//pobierz grupy:
$groups = User::getGroupsByUserId($user->user_id);
if($groups){
	$template->assign('groups',$groups);
}

if(isset($_GET['u'])){
	$u=$_GET['u'];
	$template->assign('put_link', $u);
}

if(isset($_POST["submitted"])){
	
	//print_r($_POST);
	
	if(!isset($_POST['u']) || !isset($_POST['a']) || !isset($_POST['s']) ){
		$template->assign('put_msg', array('error'=>true, 'message'=>'Wypełnij puste pola.' ));
	}else{
		
		$u= $_POST['u'];
		
		
		
		if( !preg_match('/^(https?\:)/i', $u) ){
			$u="http://".$u;
		}
			
			$a= $_POST['a'];
			$s= $_POST['s'];
				
			if(isset($_POST['t'])){
				$t=$_POST['t'];
			}else{
				$t=null;
			}
				
			$messages= putlink($a, $s, $u, null, $t);
			//print_r($messages);
				
				
			if(sizeof($messages)>1){
				$messages= implode(" -> ", $messages);
			}else{
				$messages=$messages[0];
			}
				
			$template->assign('put_msg', array('error'=>false, 'message'=>$messages ));
			
			if($t !== null){$template->assign('put_tags', $t);}
			$template->assign('put_link', $u);

		

	}
}

$DB->disconnect();
$template->assign('PAGE_TITLE','Dodaj link!');
$template->assign('CONTENT','putlink');
$template->display('main_template.tpl');



?>