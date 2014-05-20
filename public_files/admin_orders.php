<?php

include('../lib/init.php');
include(LIB_DIR.'Alert.class.php'); 
include(LIB_DIR.'Transaction.class.php'); 
include(LIB_DIR.'Cart.class.php'); 
include(LIB_DIR.'CartItem.class.php'); 
include(LIB_DIR.'Customer.class.php');
include(LIB_DIR.'Item.class.php');
include(LIB_DIR.'Product.class.php');


function home(){
	global $template; 
	$log = new Log(); 
	$admin = new Admin();
	$customer = new Customer();
	$cart = new Cart();	


	$transactions = new Transaction();
	$transactions = $transactions->getTransactions();


 

	foreach ($transactions as $transaction) {
		
		$customerCart = $cart->getCartById($transaction->cart_id);
		$customerObject = $customer->getCustomerById($customerCart->customer_id);

		$transaction->customer = $customerObject;
		$transaction->cart = $customerCart;


	}


	
	$template->assign('transactions', $transactions);
	$template->assign('CONTENT','admin/orders');

}





function edit(){
	global $template; 
	$log = new Log(); 
	$admin = new Admin();
	$customer = new Customer();
	$cart = new Cart();
	$cartItem = new CartItem();
	$item = new Item();
	$transactions = new Transaction();
	$products = new Product();

	if(isset($_POST["tid"]) && isset($_GET["id"]) ){
		$tid = $_POST["tid"];
		$id = $_GET["id"]; 
	

		$transaction = $transactions->getTransactionById($id);
		$customerCart = $cart->getCartById($transaction->cart_id);
		$cartItems = $cartItem->getByColumna("cart_id", $customerCart->cart_id);
		
		$transaction->status = Transaction::STATUS_FINISHED;
		$transaction->end_date = datetime();
		$transaction->save();

		foreach($cartItems as $cartItem){		
			$currentItem = $item->getItemById( $cartItem->item_id );
			$currentItem->toString();
			$currentItem->delete();
			
		}	
		//print_r($cartItems);
	}
	 


 	if( isset($_GET["id"]) ){

 		$id = $_GET["id"]; 
 		$transaction = $transactions->getTransactionById($id);

 		if($transaction){

 		$customerCart = $cart->getCartById($transaction->cart_id);
		$customerObject = $customer->getCustomerById($customerCart->customer_id);

		$transaction->customer = $customerObject;
		$transaction->cart = $customerCart;

		$cartItems = $cartItem->getByColumna("cart_id", $transaction->cart->cart_id );
		$items = array();

		foreach($cartItems as $cartItem){			 
			$currentItem = $item->getItemByIdWithDeleted( $cartItem->item_id );
			if($currentItem){
				$currentProduct = $products->getProductById($currentItem->product_id);			
				$items [] = array("item"=> $currentItem, "product"=> $currentProduct );
			}
			
			
		}

 		}else{
 			//redirecy
 		}

 	}

 


	
	$template->assign('transaction', $transaction);
	$template->assign('items', $items);	
	$template->assign('CONTENT','admin/order');

}
function faktura(){
	global $template; 
	$log = new Log(); 
	$admin = new Admin();
	$customer = new Customer();
	$cart = new Cart();
	$cartItem = new CartItem();
	$item = new Item();
	$transactions = new Transaction();
	$products = new Product();




 	if( isset($_GET["id"]) ){

 		$id = $_GET["id"]; 
 		$transaction = $transactions->getTransactionById($id);

 		if($transaction){
 			if($transaction->status === Transaction::STATUS_FINISHED){




 		$customerCart = $cart->getCartById($transaction->cart_id);
		$customerObject = $customer->getCustomerById($customerCart->customer_id);

		$transaction->customer = $customerObject;
		$transaction->cart = $customerCart;

		$cartItems = $cartItem->getByColumna("cart_id", $transaction->cart->cart_id );
		$items = array();
		$total = 0;
		foreach($cartItems as $cartItem){			 
			$currentItem = $item->getItemByIdWithDeleted( $cartItem->item_id );
			if($currentItem){
				if($currentItem->price2){
					$total+= $currentItem->price2;
				}else{
					$total+= $currentItem->price;
				}
				$currentProduct = $products->getProductById($currentItem->product_id);			
				$items [] = array("item"=> $currentItem, "product"=> $currentProduct );
			}

		}




 			}
 		}else{
 			//redirecy
 		}

 	}
	$template->assign('total', $total);
	$template->assign('transaction', $transaction);
	$template->assign('items', $items);	
	$template->display('admin/vat.tpl');
	exit(0);

}
//=======================================================================================================
	
 
    
    
	global $template;
	$template->assign("current", "orders");
	switch($_GET['action']){
	case "home":
		home();
	break;	
	case "edit":
		edit();
	break;
	case "faktura":
		faktura();
	break;

	};
	$template->assign('PAGE_TITLE','admin');
	$template->display('admin_template.tpl');


?>