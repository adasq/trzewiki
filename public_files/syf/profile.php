<?php


session_start();

define('LIB_DIR', '../lib/');
define('CONFIG_DIR', '../config/');
define('SMARTY_DIR', LIB_DIR.'Smarty-3.1.11/');


include(LIB_DIR.'DataBase.class.php');
include(LIB_DIR.'functions.php');
include (LIB_DIR.'User.class.php');
include (LIB_DIR.'Friend.class.php');
include(LIB_DIR.'Link.class.php');
include(LIB_DIR.'Group.class.php');
include(LIB_DIR.'Validator.class.php');
include(LIB_DIR.'Image.php');
include(LIB_DIR.'Template.class.php');


$DB = new DataBase();
$template = new Template();

$template->configLoad('lang.conf', null);
if(strpos( $_SERVER['REQUEST_URI'] , 'profile.php')){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
}

$user= getUser();
 


$myprofile=false;

if(!isset($_GET["user"])){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
}else{
	
	 $profileusername=$_GET["user"];	
	if(!$person=User::getUserByName($profileusername) ){
		$DB->disconnect();
		header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
	}else{
		 $person->reg_date=formatDate($person->reg_date);
		 $user->reg_date=formatDate($user->reg_date);
				
		if($user && $user->user_id == $person->user_id){
			$person= $user;
			$myprofile=true;
			$template->assign('myprofile',true);
		}else{
			//$person=$person;
		}
		
		
	}
$template->assign('person',$person);
}

//jesli zalogowany uzytkownik przeglada nie swoj profil:
if($user && !$myprofile){

	$obj=$user->getFriendStatusByUser($person);
	$form_text=null;
	$form_action=null;
	$friend_text=null;
	
if(isset($_POST["faction"])){

$fa = $_POST["faction"];
	
if($obj){
//jest w bazie
		
		$sql=null;
		switch($obj->mode){
			case Friend::FRIENDS_ACTIONS_REQUEST:
				if($user->user_id == $obj->user1){					
				}else{
					if($fa == Friend::FRIENDS_ACTIONS_ACCEPT){
						$sql="UPDATE friends set mode=1 where friend_id=".$obj->friend_id;
					}else if($fa == Friend::FRIENDS_ACTIONS_REJECT){					
						$sql="UPDATE friends set mode=2, last_activity='".date("Y-m-d H:i:s")."' where friend_id=".$obj->friend_id;	
					}
				}
				break;
			case Friend::FRIENDS_ACTIONS_ACCEPT:
				if($fa == Friend::FRIENDS_ACTIONS_DELETE){
					$sql= "UPDATE friends set user1= ".$user->user_id.", user2=".$person->user_id.", mode=3, last_activity='".date("Y-m-d H:i:s")."' where friend_id=".$obj->friend_id;
				}
				break;
			case Friend::FRIENDS_ACTIONS_REJECT:
				if($fa == Friend::FRIENDS_ACTIONS_REQUEST){
					$sql="UPDATE friends set user1= ".$user->user_id.", user2=".$person->user_id.", mode=0, last_activity='".date("Y-m-d H:i:s")."'  where friend_id=".$obj->friend_id;			
				}
				break;
			case Friend::FRIENDS_ACTIONS_DELETE:				
				if($fa == Friend::FRIENDS_ACTIONS_REQUEST){
					$sql="UPDATE friends set user1= ".$user->user_id.", user2=".$person->user_id.", mode=0, last_activity='".date("Y-m-d H:i:s")."'  where friend_id=".$obj->friend_id;
				}
				break;
			default:		
				break;	
		}
	if($sql){
		$DB->execute($sql);
		//header('Location: profile.php?user='.$person->username);
	}
	
}else{
//nie ma w bazie

	if($fa == Friend::FRIENDS_ACTIONS_REQUEST){
		$sql="INSERT into friends values (null, ".$user->user_id.", ".$person->user_id.", ".Friend::FRIENDS_ACTIONS_REQUEST.", '".date("Y-m-d H:i:s")."')";
		$DB->execute($sql);
	}
	
		
	
}
	
}
	
$friend_form=array();
$obj=$user->getFriendStatusByUser($person);	
if($obj){
	//jest wpis w db	
			switch($obj->mode){
				case Friend::FRIENDS_ACTIONS_REQUEST:	
					if($user->user_id == $obj->user1){
						$friend_text= "Zaprosiłeś tego użytkownika do znajomych.";
					}else{
						$friend_text= 'Ten użytkownik zaprosił Cię do znajomych';
						$friend_form[]= array("Przyjmij zaproszenie", Friend::FRIENDS_ACTIONS_ACCEPT);
						$friend_form[]= array("Odrzuć zaproszenie", Friend::FRIENDS_ACTIONS_REJECT);				
					}				
					break;
				case Friend::FRIENDS_ACTIONS_ACCEPT:	
						$friend_text= 'Jesteście znajomymi.';
						$friend_form[]= array("Usuń ze znajomych", Friend::FRIENDS_ACTIONS_DELETE);
											
					break;
				case Friend::FRIENDS_ACTIONS_REJECT:
						if($user->user_id == $obj->user1){
							$friend_text= 'Ten użytkownik nie przyjął Cie do znajomych.';
						}else{				
							$friend_text= 'Nie przyjąłeś tego użytkownika do znajomych.';
						}		
						$form_text= "Zaproś tego użytkownika do znajomych.";
						$friend_form[]= array("Zaproś do znajomych", Friend::FRIENDS_ACTIONS_REQUEST);
					break;
				case Friend::FRIENDS_ACTIONS_DELETE:
						if($user->user_id == $obj->user1){
							$friend_text ='Usunąłeś tego użytkownika z listy znajomych.';
						}else{
							$friend_text= 'Ten użytkownik usunął Cię z listy znajomych.';
						}
						$friend_form[]= array("Zaproś do znajomych", Friend::FRIENDS_ACTIONS_REQUEST);
						break;
					
	}
	
}else{
	//brak wpisu
						$friend_text= 'Nie masz tego użytkownika w znajomych';
						$friend_form[]= array("Zaproś do znajomych", Friend::FRIENDS_ACTIONS_REQUEST);
}

$template->assign('friend_text', $friend_text);
$template->assign('friend_form', $friend_form);

}else{
	//nie zalogowany to nie mozna
}







if(isset($_GET['action'])){
	$action = $_GET['action'];
	$template->assign('action', $action);





switch ($action) {
	//------------------------------------------------------------------------------------------------------------------------------
	case "mail":
		if(!$myprofile){$DB->disconnect();
		header('Location: '.$template->getConfigVariable('BASE_URL').'/home');}
		
		
$success=false;
		if(isset($_POST["submitted"])){

			if(!$_POST["chg_mail"]){
				$template->assign('err_mail',"Wypełnij to pole!");
			
			}else if(!Validator::validMail($_POST["chg_mail"])){
				
				
					$template->assign('err_mail',"Zły adres e-mail!");
				
			}else if(!$_POST["chg_mail2"]){
				$template->assign('err_mail2',"Przepisz!");
			
			}else if($_POST["chg_mail"] != $_POST["chg_mail2"]){
				$template->assign('err_mail2',"Oba pola muszą być równe");
			}else{
				//$smarty->assign('mail_error',"Poprawnie zmieniono maila!");
				$person->mail=$_POST["chg_mail"];
				$user->save();
				$template->assign('profile_msg', array("error" => false, "message" => 'Zmieniono adres e-mail.'));
				$success=true;
			}
			
			if(!$success){
				$template->assign('chg_mail',$_POST["chg_mail"]);
				$template->assign('chg_mail2',$_POST["chg_mail2"]);
			}


		}


		break;
		//------------------------------------------------------------------------------------------------------------------------------
	case "avatar":
if(!$myprofile){$DB->disconnect(); header('Location: '.$template->getConfigVariable('BASE_URL').'/home');}
		
		
		if(isset($_POST["submitted"]) ){
				

				
			if(!$_POST["chg_avatar"]){
				$template->assign('err_avatar','Wypełnij pole!');
			}else{
				
				$link=$_POST["chg_avatar"];
				 
				
				if(Image::getImageType($link) != -1){
					error_reporting(0);
					try {
					$img = new Image($link);
					$img2=$img->scale(100, 100, Image::PROP_GROW);
					$img3 = $img2->crop(100, 100, Image::HCENTER | Image::VCENTER);
					$ava=$person->username.'_'.generateRandomString().'.png';
					} catch (Exception $e) {
						//print_r($_SERVER['QUERY_STRING']);
						//header ("Location: ".$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
						$DB->disconnect();
						header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
						
						return;
					}

					
					if($person->avatar!='user_default_100x100.png'){
						unlink('images/avatars/'.$person->avatar);
					}
					 
					$img3->toPNG('images/avatars/'.$ava);
					$person->avatar=$ava;
					$person->save();
					$template->assign('profile_msg', array("error" => false, "message" => 'Zmieniono avatar.'));
				}else{
					$template->assign('err_avatar',"Link z obrazkiem niepoprawny!");
				}
				
				
			}

			
			
			
			//error_reporting(0);

		}
		break;
		//------------------------------------------------------------------------------------------------------------------------------
	case "password":
	if(!$myprofile){$DB->disconnect(); header('Location: '.$template->getConfigVariable('BASE_URL').'/home');}

	$succes=false;
		if(isset($_POST["submitted"])){
			if(!$_POST["chg_password"]){
				$template->assign('err_password',"Wypełnij pole!");
			}else {
				
				$oldpswd = $_POST["chg_password"];
				$newpassword=$_POST["chg_password_new"];
				$newpassword2=$_POST["chg_password_new2"];
				
				if($user->password != getPasswordHash($oldpswd)){
					$template->assign('err_password',"Złe hasło!");
				}else if($newpassword == ''){
					$template->assign('err_password_new',"Wprowadź nowe hasło!");		
				}else if(!Validator::validPassword($newpassword)){
					$template->assign('err_password_new',"Zbyt krótkie!");
				}else if($newpassword2 == ''){
					$template->assign('err_password_new2',"Przepisz!");
				}else if($newpassword2 !=$newpassword ){
					$template->assign('err_password_new2',"Pola muszą się zgadzać!");
				}else{
					$user->password=getPasswordHash($newpassword);
					$user->save();
					$template->assign('profile_msg', array("error" => false, "message" => 'Zmieniono hasło.'));
					$succes=true;
				}
				
				
			}
			
			
			if(!$succes){
				$template->assign('chg_password',$_POST["chg_password"]);
				$template->assign('chg_password_new',$_POST["chg_password_new"]);
				$template->assign('chg_password_new2',$_POST["chg_password_new2"]);
				
			}

		}
			
			
		break;
		//------------------------------------------------------------------------------------------------------------------------------
		case "friends":
		
			$friendslist = $person->getFriendsList();
				
			if($myprofile){
					$request = array();
					$response = array();
					$arr=$user->getFriendsActions($user, Friend::FRIENDS_MODE_REQUEST);
					if($arr){
						foreach ($arr as $each){
							$request[$each->mode][]=$each;
						}
						//$template->assign('request', $request);
					}else{
						//echo 'pusto';
					}
					
					$arr=$user->getFriendsActions($user, Friend::FRIENDS_MODE_RESPONSE);
					if($arr){
						foreach ($arr as $each){
							$response[$each->mode][]=$each;
						}
						//$template->assign('response', $response);
					}else{
						//echo 'pusto';
					}
					
					if(sizeof($request)== 0 && sizeof($response)== 0){
						$template->assign('empty', true);
					}else{

						$template->assign('friends_mi_req', $request);
						$template->assign('friends_mi_res', $response);
					}
					
					
					
}
			
			$template->assign('friends', $friendslist);
			
			break;
			case "groups":
				
			$belongto= Group::getUserGroups($person, Group::GROUPS_MODE_BELONGTO);
			if($belongto){
				$template->assign('groups_belongto', $belongto);
			}
			
			
			
			$own= Group::getUserGroups($person, Group::GROUPS_MODE_OWN);	
			if($own){
				$template->assign('groups_own', $own);
			}
			
				
			break;
			
			default:
				$DB->disconnect();
				//header("Location: profile.php?user=".$person->username);
				header('Location: '.$template->getConfigVariable('BASE_URL').'/home');
			break;
}//switch

}//jesli action ustawione

$DB->disconnect();
$template->assign('PAGE_TITLE','Profil użytkownika '. $person->username);
$template->assign('CONTENT','profile');
$template->display('main_template.tpl');




?>