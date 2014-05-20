<?php

include('../lib/init.php');
include(LIB_DIR.'Alert.class.php');
include(LIB_DIR.'Product.class.php');
include(LIB_DIR.'Item.class.php');
include(LIB_DIR.'Validator.class.php');
include(LIB_DIR.'Manufacturer.class.php');
include(LIB_DIR.'Size.class.php');

include(LIB_DIR.'Media.class.php');

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
				goHomePage();
			}//!content

		}else{
			goHomePage();
		}

}//edit
function neww(){

	global $template, $DB;
	
	$product = new Product();
	$products= $product->getProducts();

		$manufacturer = new Manufacturer();
		$manufacturers= $manufacturer->getManufacturers();

	$size= new Size();  
	$sizes= $size->getSizes();

	foreach ($sizes as $size) {		
		foreach ($manufacturers as $manufacturer) {
			if($size->manufacturer_id === $manufacturer->manufacturer_id){
				$size->manufacturer =  $manufacturer->name;
			}
		}
	}
   	
   	$item= new Item();  
	
			if( isset($_POST["item_id"]) ){
			
					$item->setData($_POST);						
					$item->item_id=null;
					$item->deleted=0;		 
					$item->save();

			$template->assign('alert', new Alert("success", "Pomyślnie dodano. Kliknij 
						<a href=\"".$template->getConfigVariable('BASE_URL')."/admin/items/edit/".$DB->getLastId()."\">tutaj</a>,
						 aby przejść do edycji..."));


			}else{

				 
			}
			
			$template->assign('item', new Item());
			$template->assign('products', $products);
			$template->assign('sizes', $sizes);
			$template->assign('CONTENT','admin/item');


}//edit
function home(){

	global $template; 

	$item= new Item();  
	$product = new Product();
	$media = new Media();
	$size = new Size();

	$products = $product->getProducts();
	$items= $item->getItems();	
	$sizes = $size->getSizes();

	foreach($products as $product) {			
			$medias = $media->getByColumna("product_id", $product->product_id);
			$product->url = isset($medias[0]->file_path)?$medias[0]->file_path:"";
	}

	$items2 = array();
	if(isset($_GET['product'])){
		$pid = $_GET['product'];		
		foreach ($items as $key => $value) {			
			if($value->product_id === $pid){
				$items2[] = $value;
			}
		}

	}

	
 	$template->assign('sizes', $sizes);
	$template->assign('items', $items2);
	$template->assign('products', $products);
	$template->assign('CONTENT','admin/items');
}
//=========================================================================================
	global $template;
	$template->assign("current", "items");

	if(isset($_POST["price"])){
		$price = $_POST["price"];
		$price2 = $_POST["price2"];
		
		$price = Validator::parseNumber($price);
		$price2 = Validator::parseNumber($price2);


		if(!$price){
			$template->assign('alert', new Alert("danger", "Dziwna cena. Kliknij <a href=\"".$template->getConfigVariable('BASE_URL')."/admin/items\">tutaj</a>,
						 aby przejść do działu 'Buty'"));
			$template->assign('CONTENT','admin/item');
			$template->assign('PAGE_TITLE','admin');
			$template->display('admin_template.tpl');
			return;
		}else{
			if($_POST["price2"] == ""){
				$price2 = 'null';
			}else{
				if(!$price2){
					$template->assign('alert', new Alert("danger", "Dziwna cena. Kliknij <a href=\"".$template->getConfigVariable('BASE_URL')."/admin/items\">tutaj</a>,
								 aby przejść do działu 'Buty'"));
					$template->assign('CONTENT','admin/item');
					$template->assign('PAGE_TITLE','admin');
					$template->display('admin_template.tpl');
					return;
				}
			}

		}
echo $price.' # '.$price2;
		$_POST["price2"] = $price2;
		$_POST["price"] = $price;
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

	$template->assign('PAGE_TITLE','admin');
	$template->display('admin_template.tpl');

?>