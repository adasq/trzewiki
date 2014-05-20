<?php
include('../lib/init.php');
include(LIB_DIR.'Alert.class.php');
include(LIB_DIR.'Customer.class.php');


function edit(){

	global $template;

	if(isset($_GET["id"])){
		$id = $_GET["id"];

			$customer = new Customer();
			$customer= $customer->getCustomerById($id);
			if($customer){

			if( isset($_POST["customer_id"]) ){

 					
 					if($_POST["password"] === ""){
 							$_POST["password"]= $customer->password;
 							$customer->setData($_POST);
 					}else{
 							$customer->password= getPasswordHash($_POST["password"], $customer->salt);
 					}
 					
 					
					$customer->save();
					$customer= $customer->getCustomerById($id);
					$template->assign('alert', new Alert("success", "Pomyślnie zaktualizowano dane"));

			}else{

			}
			$customer->password = "";
			$template->assign('customer', $customer);			

			}else{
				$template->assign('alert', new Alert("danger", "Taki uzytkownik nie istnieje"));

			}//!content


		}//GET id

	$template->assign("states", array(	"aktywny"=> "ACTIVE", "nieaktywny"=> "INACTIVE", "aktywny"=> "ACTIVE", "ban"=> "BANNED"	));
	$template->assign('CONTENT','admin/user');
	$template->assign('PAGE_TITLE','admin');
	$template->display('admin_template.tpl');
	
}//edit
function neww(){

	global $template, $DB;
			$customer = new Customer();
			if( isset($_POST["customer_id"]) ){

 					$customer->setData($_POST); 				 
 					$customer->customer_id = null;
 					$customer->deleted = 0;
					$customer->save(); 
					$template->assign('alert', new Alert("success", "Pomyślnie dodano nowego użytkownika. Kliknij 
						<a href=\"".$template->getConfigVariable('BASE_URL')."/admin/users/edit/".$DB->getLastId()."\">tutaj</a>,
						 aby przejść do edycji..."));

			}else{

			}
			$template->assign('customer', $customer);	
			$template->assign("states", array(	"aktywny"=> "ACTIVE", "nieaktywny"=> "INACTIVE", "aktywny"=> "ACTIVE", "ban"=> "BANNED"	));	
	$template->assign('CONTENT','admin/user');
	$template->assign('PAGE_TITLE','admin');
	$template->display('admin_template.tpl');
	
}//edit
function home(){

	global $template; 
	$customer= new Customer();  
	$template->assign('users', $customer->getCustomers());
	$template->assign('CONTENT','admin/users');
	$template->assign('PAGE_TITLE','admin');
	$template->display('admin_template.tpl');

}

//=======================================================================================================
	$template->assign("current", "users");
	switch($_GET['action']){
	case "edit":
		edit();
	break;
	case "home":
		home();
	break;	
	case "new":
		neww();
	break;	
	};



?>