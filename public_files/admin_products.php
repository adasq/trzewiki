<?php

include('../lib/init.php');
include(LIB_DIR.'Alert.class.php');
include(LIB_DIR.'Product.class.php');
include(LIB_DIR.'Manufacturer.class.php');
include(LIB_DIR.'Media.class.php');
include(LIB_DIR.'ProductType.class.php');
include(LIB_DIR.'Type.class.php');

function edit(){

	global $template;

	$manufacturer = new Manufacturer();
	$manufacturers= $manufacturer->getManufacturers();

	$type = new Type();
	$types= $type->getTypes();

	if(isset($_GET["id"])){
		$id = $_GET["id"];

				$media = new Media();
				$medias= $media->getByColumna("product_id", $id);				

			$product= new Product();  
			$product= $product->getProductById($id);
			if($product){

			$pt = new ProductType();
			$pt = $pt->getByColumna("product_id", $product->product_id);

			if( isset($_POST["product_id"]) ){

					$product->setData($_POST);				 
					$product->save();
					$product= $product->getProductById($id);
					$template->assign('alert', new Alert("success", "Pomyślnie zaktualizowano dane"));

			}else{

			}
			
			$template->assign('manufacturers', $manufacturers);
			$template->assign('productTypes', $pt);
			$template->assign('types', $types);
			$template->assign('medias', $medias);
			$template->assign('product', $product);
			$template->assign('CONTENT','admin/product');

			}else{
				echo "lipa";
			}//!content

		}//GET id

}//edit
function neww(){

	global $template, $DB;
			
			$product= new Product();  
			$manufacturer = new Manufacturer();
	$manufacturers= $manufacturer->getManufacturers();


			if( isset($_POST["product_id"]) ){

 					$product->setData($_POST); 				 
 					$product->product_id = null;
 					$product->deleted = 0;
 					//echo $product->toString();
					$product->save(); 
					//header('Location: '.$template->getConfigVariable('BASE_URL').'/admin');			
				
						
					$template->assign('alert', new Alert("success", "Pomyślnie dodano treść. Kliknij 
						<a href=\"".$template->getConfigVariable('BASE_URL')."/admin/products/edit/".$DB->getLastId()."\">tutaj</a>,
						 aby przejść do edycji..."));

			}else{

			}
			$template->assign('product', $product);	
			$template->assign('manufacturers', $manufacturers);		

	$template->assign('CONTENT','admin/product');
	
}//edit
function home(){

	global $template; 
	$product= new Product();  
	$template->assign('products', $product->getProducts());
	$template->assign('CONTENT','admin/products');
}
//=========================================================================================
	global $template;
	$template->assign("current", "products");
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