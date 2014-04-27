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
include(LIB_DIR.'recaptchalib.php');
include(LIB_DIR.'Validator.class.php');
include(CONFIG_DIR.'config.php');


$DB = new DataBase();
$template= new Template();
$template->configLoad('lang.conf', null);
if(strpos( $_SERVER['REQUEST_URI'] , 'register.php')){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/register');
}




$user= getUser();


function register($username, $mail, $pswd){	
	
	global $template;
	
	$user = new User();
	$user->username= $username;
	$user->mail= $mail;
	$user->password= getPasswordHash($pswd);
	$token= $user->setUserAsInactive();
	
	$template->assign('activation_url', 'verify?id='.$user->username.'&token='.$token);
	$template->assign('PAGE_TITLE','Poprawnie założono konto');
	$template->assign('CONTENT','register_complete');
	$template->display('main_template.tpl');
	
	
}

function getRegisterError($username, $mail, $password, $password2){

	
 
	$error=false;
	global $template,$captcha;
	
	
	//username
	if($username != ''){
		if(!Validator::validUsername($username)){
			
			$template->assign('username_err',$template->getConfigVariable('REGISTER_error_1'));
			
			$error=true;
		}else if(User::exists($username)){
			$template->assign('username_err',$template->getConfigVariable('REGISTER_error_2'));
			$error=true;
		}
	
	}else{
		$template->assign('username_err',$template->getConfigVariable('REGISTER_error_3'));
		$error=true;
	}
	
	if(!$error){
		//mail
		if($mail != ''){
			if(Validator::validMail($mail)){
				if(User::exists($mail, true)){
 
					$template->assign('mail_err',$template->getConfigVariable('REGISTER_error_4'));
					$error=true;
				}else{
					//ok
				}
			}else{ 
				$template->assign('mail_err',$template->getConfigVariable('REGISTER_error_5'));
				$error=true;
			}
		}else{
			$template->assign('mail_err',$template->getConfigVariable('REGISTER_error_6'));
			$error=true;
		}
		
		if(!$error){
			
			if($password != ''){
				if(!Validator::validPassword($password)){
					$template->assign('pswd_err',$template->getConfigVariable('REGISTER_error_7'));
					$error=true;
				}
			}else{
				$template->assign('pswd_err',$template->getConfigVariable('REGISTER_error_8'));
				$error=true;
			}
			
			if(!$error){
				
				
				
					if($password2 != ''){
						if($password != $password2){						
							$template->assign('pswd2_err',$template->getConfigVariable('REGISTER_error_9'));
							$error=true;
						}
					}else{
						$template->assign('pswd2_err',$template->getConfigVariable('REGISTER_error_10'));
						$error=true;
					}
			
				if(!$error){
					$resp = recaptcha_check_answer ($captcha["private_key"],
							$_SERVER["REMOTE_ADDR"],
							$_POST["recaptcha_challenge_field"],
							$_POST["recaptcha_response_field"]);
					
					if (!$resp->is_valid) {
//						$template->assign('captcha_err',$template->getConfigVariable('REGISTER_error_11'));
// 						$error = true;
					} else {
						//ok
					}//kapcza ok
				}//pswd2 ok		
			}//pswd ok		
		}//mail ok		
	}//username ok 

	if($error){
		if(isset($_POST['reg_username'])){$template->assign('reg_username',$_POST['reg_username']);}
		if(isset($_POST['reg_mail'])){$template->assign('reg_mail',$_POST['reg_mail']);}
		if(isset($_POST['reg_password'])){$template->assign('reg_password',$_POST['reg_password']);}
		if(isset($_POST['reg_password2'])){$template->assign('reg_password2',$_POST['reg_password2']);}
		return true;
	}else{
		return false;
	}
}


//-----------------------------------------------------------------------------------------------





if(isset($_POST["submitted"])){
	
	
	  $username= $_POST['reg_username'];
	  $mail= $_POST['reg_mail'];
	  $password= $_POST['reg_password'];
	  $password2=$_POST['reg_password2'];
		 	 
	 $error = getRegisterError($username, $mail, $password, $password2);
	 
	 if(!$error){
	 	register($username, $mail, $password);
	 	return;
	 }
}

$template->assign('captcha_html', recaptcha_get_html($captcha["public_key"]));






$DB->disconnect();
$template->assign('PAGE_TITLE','Zarejestruj się');
$template->assign('CONTENT','register');
$template->display('main_template.tpl');
