<?php

include('../lib/init.php');
include(LIB_DIR.'Alert.class.php');

$admin = new Admin();


	if(isset($_POST["login"]) && isset($_POST["password"]) && strlen($_POST["login"]) > 0 && strlen($_POST["password"]) > 0){

		$login = $_POST["login"];
		$password = $_POST["password"];

		$admin= $admin->getByColumn("login", $login);
		if($admin && $admin->password === $password){
			echo "OKEJ!";
			$_SESSION['access'] = TRUE;
			$_SESSION['userId'] = $admin->admin_id;
			$_SESSION['username'] = $admin->login;
			setcookie("username", $admin->login);
			header('Location: '.$template->getConfigVariable('BASE_URL').'/admin');				
		}else{
			$template->assign("alert", new Alert("danger", "Nieprawidłowy login / hasło ;("));
		}
		

		
	}

	$template->display('admin/login.tpl');



?>