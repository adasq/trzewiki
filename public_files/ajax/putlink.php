<?php
session_start();

define('LIB_DIR', '../../lib/');
define('CONFIG_DIR', '../../config/');
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


header("Content-Type: application/javascript");

$user=null;
if(isset($_SESSION['access']) && isset($_SESSION['userId']) && isset($_GET["h"])){
	$user = User::getUserById($_SESSION['userId']);
	if(!$user){
		$_SESSION = array();
		session_unset();
		session_destroy();
		echo "var ASHER_RESPONSE = {login: false, status: null};";
		return;
	}
}else{
	echo "var ASHER_RESPONSE = {login: false, status: null };";
	return;
}





if($user->getHash() != $_GET["h"]){
	
	session_unset();
	session_destroy();
	$_SESSION = array();
	echo "var ASHER_RESPONSE = {login: false, status: null};";
	return;
}

if(!isset($_GET['a']) || !isset($_GET['s']) || !isset($_GET['u'])){
	echo "var ASHER_RESPONSE = {login: false, status: '".convertChars('błąd.')."'};";
	return;
}

$a = $_GET['a'];
$s=$_GET['s'];
$u=$_GET['u'];


if(isset($_GET['t'])){
	$t=$_GET['t'];
}else{
	$t=null;
}



$messages= putlink($a, $s, $u, null, $t);

//tworzenie powiadomienia wysylanego do klienta w postaci obiektu js




echo "var ASHER_RESPONSE = {login: true, status: '";
foreach ($messages as $msg){
	$msg= convertChars($msg);
	echo $msg;
}
echo "'};";



?>