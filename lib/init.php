<?php
session_start();//sesja
define('LIB_DIR', '../lib/');
define('CONFIG_DIR', '../config/');
define('SMARTY_DIR', LIB_DIR.'Smarty-3.1.11/');


include(LIB_DIR.'DataBase.class.php');
include(LIB_DIR.'Template.class.php');
include(LIB_DIR.'Base.class.php'); 
include(LIB_DIR.'Admin.class.php');
include(LIB_DIR.'functions.php');


$DB = new DataBase();
$template= new Template();
$template->configLoad('lang.conf', null); 
authorize();


?>