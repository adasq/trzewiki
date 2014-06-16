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


if(sizeof($_POST) > 0){
		//customer_id email first_name last_name street street_additional zip_code city status
		if(isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["customer_id"]) && isset($_POST["email"]) && isset($_POST["first_name"]) 
			&& isset($_POST["last_name"]) && isset($_POST["street"]) && isset($_POST["street_additional"]) && isset($_POST["city"])
			&& isset($_POST["status"]) && isset($_POST["zip_code"])      ){
			 //deleted!
			if(isset($_POST["deleted"])){
				$_POST["deleted"]= intval($_POST["deleted"]);
				if($_POST["deleted"] === 1 || $_POST["deleted"] === 0){
				}else{
					echo "ptaszek lub jego brak, innej mozliwosci nie ma!";		
					return;
				}
			}			 
			 $_POST["customer_id"]= intval($_POST["customer_id"]);
			$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
			

			if( !($_POST["status"] === "INACTIVE" || $_POST["status"] === "ACTIVE" || $_POST["status"] === "BANNED")) {				
				return;
			} 
			if(strlen($_POST["email"]) > 0 && strlen($_POST["login"]) > 0 && strlen($_POST["first_name"]) > 0 && strlen($_POST["last_name"]) > 0 && strlen($_POST["street"]) > 0 
				&& strlen($_POST["street_additional"]) > 0 && strlen($_POST["zip_code"]) > 0 && strlen($_POST["city"]) > 0) {				
			}else{				
				return;
			}

			if(!preg_match($regex, $_POST["email"])){
				return;
			}

		}else{
			echo ":(";
			return;
		}		
	}





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