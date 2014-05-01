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
include(LIB_DIR.'Validator.class.php');
include(LIB_DIR.'Group.class.php');
include(LIB_DIR.'Template.class.php');
include(LIB_DIR.'Image.php');

//=======================================================================================================

$DB = new DataBase();
$template= new Template();
$template->configLoad('lang.conf', null);


if(strpos( $_SERVER['REQUEST_URI'] , 'group_create.php')){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/newgroup');
}




$user= getUser();
if(!$user){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
}

 


if(isset($_POST['submitted'])){
		
	$success=false;
	$grp_name = $_POST['grp_name'];
	$grp_description= Validator::clean($_POST['grp_description']);
	$grp_image= $_POST['grp_image'];
	

	if(Validator::validGroupName($grp_name)){
		
		if($grp_description== null || (strlen($grp_description)> 9)){

			$group = new Group();
			$group->group_name = $grp_name;
			$group->author_id= $user->user_id;
			$group->description=(strlen($grp_description)==0)?null:$grp_description;
			
			
			
			if(!empty($grp_image) && Image::getImageType($grp_image) != -1){
					
				//error_reporting(0);
				$img = new Image($grp_image);
				$img2= $img->scale(100, 100, Image::PROP_GROW);
				$img3 = $img2->crop(100, 100, Image::HCENTER | Image::VCENTER);
				$groupimg=$group->group_name.'_'.$group->author_id.'_'.generateRandomString().'.png';
				$img3->toPNG('images/groups/'.$groupimg);
				$group->image= $groupimg;
			
			}
			
			//$template->assign('group_info',$group.'');
			
			if($group->save()){
				$template->assign('group_msg', array("error" => false, "message" => 'Utworzono grupę.'));
				$success=true;
			}else{
				$template->assign('group_msg', array("error" => true, "message" => 'Błąd. Możliwe, że taka grupa już istnieje'));
			}
			
			
		}else{
			$template->assign('err_description','Wymagane conajmniej 10 znaków');
		}
	
	}else{
		$template->assign('err_name','Nieprawidłowa nazwa grupy');
	}
		
		
	
	if(!$success){
		if(isset($_POST['grp_name'])){$template->assign('grp_name',$_POST['grp_name']);}
		if(isset($_POST['grp_description'])){$template->assign('grp_description',$_POST['grp_description']);}
		if(isset($_POST['grp_tags'])){$template->assign('grp_tags',$_POST['grp_tags']);}
		if(isset($_POST['grp_image'])){$template->assign('grp_image',$_POST['grp_image']);}
	}


}else{
	//echo 'unset submitted';
}
$DB->disconnect();
$template->assign('PAGE_TITLE','Utwórz własną grupę!');
$template->assign('CONTENT','groups_create');
$template->display('main_template.tpl');


//=======================================================================================================





?>
