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

//print_r($_SERVER['REQUEST_URI']);


if(strpos( $_SERVER['REQUEST_URI'] , 'group.php')){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
}


$user= getUser();
 

$imauthor=false;

if(isset($_GET["name"]) && $user)
{
	$gname= $_GET["name"];
	
	if(Validator::validGroupName($gname) && $group = Group::getGroupByName($gname)){
				
		$group->create_date = formatDate($group->create_date);
		
		if($group->author_id == $user->user_id){
			$imauthor=true;
		}		
		if($imauthor){
			//jestem autorem grupy				
			//akcje
			if(isset($_POST["action"]) && isset($_POST["user"])){
				$targetname=$_POST["user"];
				$action=Validator::parseNumber($_POST["action"]);
				
				$target=User::getUserByName($targetname);
				
				if($target && $action !== null){
					//autor grupy wykonuje akcje
					$user->updateGroupStatus($group, $action, $target);
				}else{
					//header('Location: index.php');
					header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
				}			
			}			
			//wyswietla kto chcialby dolaczyc do grupy:
			$others=$group->getGroupMembers(Group::GROUPS_WHO_NOTMEMBERS);
			$arr_others=array();
			if($others){
				foreach ($others as $obj){
					$arr_others[$obj->mode][]= $obj;
				}
				$template->assign('group_others', $arr_others);
			}	
		}else{
			//nie jest autorem grupy	
			//akcje
			if(isset($_POST["action"]) && !isset($_POST["user"])){			
				$action= Validator::parseNumber($_POST["action"]);
				if($action === null){
				}else{
					$user->updateGroupStatus($group, $action);				
				}		
			}
			//pobierz status uzytkownika
			$status = $user->getGroupStatus($group);
			if($status){			
				$template->assign('group_userstatus', $status->mode);
			}	
		}	
		//wyswietla sie zawsze, czy autor, czy nie:
	
		//info o grupie
		$template->assign('group', $group);
		
		//lista czlonkow
		$members=$group->getGroupMembers(Group::GROUPS_WHO_MEMBERS);
		if($members){
			$template->assign('group_members', $members);
		}
		
		//koniec
		

		
		
	}else{
		//header('Location: index.php');
		$DB->disconnect();
		header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
	}
}else{
	//header('Location: index.php');
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
}
 
if($imauthor){$template->assign('group_mygroup', true);}
$DB->disconnect();
$template->assign('PAGE_TITLE','Strona główna grupy '.$group->group_name);
$template->assign('CONTENT','group_show');
$template->display('main_template.tpl');


?>