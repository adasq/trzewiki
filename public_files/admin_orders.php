<?php

include('../lib/init.php');
include(LIB_DIR.'Alert.class.php'); 
include(LIB_DIR.'Transaction.class.php'); 
include(LIB_DIR.'Cart.class.php'); 
include(LIB_DIR.'Customer.class.php');



function home(){
	global $template; 
	$log = new Log(); 
	$admin = new Admin();
	$customer = new Customer();
	$cart = new Cart();

	$transactions = new Transaction();
	$transactions = $transactions->getTransactions();

 	print_r($transactions);

 

	// foreach ($transactions as $transaction) {
		
	// 	$customerCart = $cart->getCartById($transaction->cart_id);
	// 	$customerObject = $customer->getCustomerById($customerCart->customer_id);

	// 	echo $transaction->toString();
	// 	echo $customerCart->toString();		
	// 	echo $customerObject->toString();
	// 	echo '==============<br>';
	// 	$transaction->customer = $customerObject;
	// 	$transaction->cart = $customerCart;


	// }


	
	$template->assign('transactions', $transactions);
	$template->assign('CONTENT','admin/orders');

}


//=======================================================================================================
	
 
    
    
	global $template;
	$template->assign("current", "orders");
	switch($_GET['action']){
	case "home":
		home();
	break;		
	};
	$template->assign('PAGE_TITLE','admin');
	$template->display('admin_template.tpl');


?>