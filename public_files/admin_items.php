<?php

include('../lib/init.php');
include(LIB_DIR.'Alert.class.php');
include(LIB_DIR.'Product.class.php');
include(LIB_DIR.'Item.class.php');
include(LIB_DIR.'Manufacturer.class.php');
include(LIB_DIR.'Size.class.php');

function edit(){

	global $template, $DB;

	$product = new Product();
	$products= $product->getProducts();

	$size= new Size();  
	$sizes= $size->getSizes();


	if(isset($_GET["id"])){
		$id = $_GET["id"];

			$item= new Item();  
			$item= $item->getItemById($id);			
			if($item){

				$product = $product->getProductById($item->product_id);
				// $size2 = new Size();
				// $size2 = $size2->getSizeById($item->size_id);
				 $manufacturer2 = new Manufacturer();
				 $manufacturer2 = $manufacturer2->getManufacturers();//getManufacturerById($size2->manufacturer_id);
				//echo $manufacturer2->name;

			if( isset($_POST["item_id"]) ){
				
					$item->setData($_POST);				 
					$item->save();
					$item= $item->getItemById($id);
					$product = $product->getProductById($item->product_id);
					$template->assign('alert', new Alert("success", "Pomyślnie zaktualizowano dane"));

			}else{

			}
			$template->assign('item', $item);
			$template->assign('products', $products);
			$template->assign('product', $product);
			$template->assign('manufacturers', $manufacturer2 );
			$template->assign('sizes', $sizes);
			$template->assign('CONTENT','admin/item');

			}else{
				echo "lipa";
			}//!content

		}//GET id

}//edit
function neww(){

	global $template, $DB;
	
	$product = new Product();
	$products= $product->getProducts();

	$size= new Size();  
	$sizes= $size->getSizes();
   	
   	$item= new Item();  
	
			if( isset($_POST["item_id"]) ){
			
					$item->setData($_POST);	
					$item->item_id=null;
					$item->deleted=0;	
					//echo $item->toString();		 
					$item->save();

			$template->assign('alert', new Alert("success", "Pomyślnie dodano. Kliknij 
						<a href=\"".$template->getConfigVariable('BASE_URL')."/admin/items/edit/".$DB->getLastId()."\">tutaj</a>,
						 aby przejść do edycji..."));


			}else{
				 
			}
			
			$template->assign('item', $item);
			$template->assign('products', $products);
			$template->assign('sizes', $sizes);
			$template->assign('CONTENT','admin/item');


}//edit
function home(){

	global $template; 

	$item= new Item();  
	$template->assign('items', $item->getItems());
	$template->assign('CONTENT','admin/items');
}
//=========================================================================================
	global $template;
	$template->assign("current", "items");
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

	$template->assign('PAGE_TITLE','admin');
	$template->display('admin_template.tpl');

?>