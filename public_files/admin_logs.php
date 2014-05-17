<?php

include('../lib/init.php');
include(LIB_DIR.'Alert.class.php'); 
include(LIB_DIR.'Customer.class.php');



function home(){
	global $template; 
	$log= new Log(); 
	$admin = new Admin();
	$customer = new Customer();
	$logs= $log->getLogs(); 
	foreach ($logs as $key => $value) {
		if($value->admin_id){	
			$logs[$key]->admin = $admin->getAdminById($value->admin_id);
		}else if($value->customer_id){
			$logs[$key]->client = $customer->getCustomerById($value->customer_id);

		}else{

		}
	} 

	$template->assign('logs', $logs);
	$template->assign('CONTENT','admin/logs');

}


//=======================================================================================================
	
 
    
    
	global $template;
	$template->assign("current", "logs");
	switch($_GET['action']){
	case "home":
		home();
	break;		
	};
	$template->assign('PAGE_TITLE','admin');
	$template->display('admin_template.tpl');


?>