<?php


session_start();

define('LIB_DIR', '../lib/');
define('CONFIG_DIR', '../config/');
define('SMARTY_DIR', LIB_DIR.'Smarty-3.1.11/');


include(LIB_DIR.'DataBase.class.php');
include(LIB_DIR.'functions.php');
include (LIB_DIR.'User.class.php');
include(LIB_DIR.'Template.class.php');
include(LIB_DIR.'Validator.class.php');





$DB = new DataBase();
$template = new Template();
$template->configLoad('lang.conf', null);

if(strpos( $_SERVER['REQUEST_URI'] , 'reset_password.php')){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/reset');
}



$user= getUser();







if(isset($_POST["submitted"]) && isset($_POST["rst_mail"])){

	
	$mail=$_POST["rst_mail"];
	

	
	
	if($mail != ''){	
		
		
		if(Validator::validMail($mail)){
				
			if(User::exists($mail,true)){
				$user=User::getUserByName($mail, true);
				if($user){
					echo $newpass= generateRandomString(6);
					$msg= $newpass;
					$template->assign('rst_mail_succes',$msg);
					$user->password= getPasswordHash($newpass);
					$user->save();
				}else{
					$template->assign('rst_mail_succes',$template->getConfigVariable('RESET_PASSWORD_error_2'));
				}
		
			}else{

				$template->assign('err_mail',$template->getConfigVariable('RESET_PASSWORD_error_1'));
				$template->assign('rst_mail',$_POST["rst_mail"]);
			}
				
		}else{
			$template->assign('err_mail',$template->getConfigVariable('RESET_PASSWORD_error_1'));
			$template->assign('rst_mail',$_POST["rst_mail"]);
		}
	}else{

		$template->assign('err_mail',$template->getConfigVariable('RESET_PASSWORD_error_3'));

		
	
	}
	
}








$DB->disconnect();
$template->assign('PAGE_TITLE','Zresetuj hasło');
$template->assign('CONTENT','reset_password');
$template->display('main_template.tpl');



?>