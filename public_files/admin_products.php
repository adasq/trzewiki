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
			$pt = null;
			if($product){

			$pt = new ProductType();
			$pt = $pt->getByColumna("product_id", $product->product_id);

			if( isset($_POST["product_id"]) ){

					$product->setData($_POST);				 
					$product->save();
					$product= $product->getProductById($id);

//==========================================





if (! empty ( $_FILES )) {
	
	$tempFile = $_FILES ['file'] ['tmp_name'];	
	$targetPath =  $template->getConfigVariable('BASE_URL_IMAGES')."/products/";	
	$targetFile = $targetPath . $_FILES ['file'] ['name'];
	
	$file = $targetFile;
	$i = 1;
	while ( is_file ( $file ) ) {
		$file = substr ( $targetFile, 0, strripos ( $targetFile, "." ) ) . "(" . $i . ")" . substr ( $targetFile, strripos ( $targetFile, "." ) );
		$i ++;
	}
	if (move_uploaded_file ( $tempFile, $file )) {
		$fileName = substr ( $file, strripos ( $file, "/" ) + 1 );
		$st = DB::get ()->prepare ( "INSERT INTO " . T_MEDIA . " (`ID` ,`nazwa`, `status`) VALUES (NULL, ?, 'aktywny')" );
		$st->bindParam ( 1, $fileName, PDO::PARAM_STR );
		if ($st->execute ()) {
			// TODO dodanie sie powiodlo
		}
	} else {
		// TODO nie powiodło sie dodanie
	}
}









//==============================================
					$template->assign('alert', new Alert("success", "Pomyślnie zaktualizowano dane"));

			}else{

			}
			

			$template->assign('manufacturers', $manufacturers);
			
			if($pt){
				$template->assign('productTypes', $pt);
			}
			$template->assign('types', $types);
			$template->assign('medias', $medias);
			$template->assign('product', $product);
			$template->assign('CONTENT','admin/product');

			}else{
				goHomePage();
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


//====================================================================================================================================================
	if(sizeof($_POST) > 0){
		//name product_no description manufacturer_id product_id
		if(isset($_POST["name"]) && isset($_POST["product_no"]) && isset($_POST["description"]) && isset($_POST["manufacturer_id"]) && isset($_POST["product_id"]) ){
			 //deleted!
			if(isset($_POST["deleted"])){
				$_POST["deleted"]= intval($_POST["deleted"]);
				if($_POST["deleted"] === 1 || $_POST["deleted"] === 0){
				}else{
					echo "ptaszek lub jego brak, innej mozliwosci niema!";		
					return;
				}
			}			 
			 $_POST["manufacturer_id"]= intval($_POST["manufacturer_id"]);	
			 $_POST["product_id"]= intval($_POST["product_id"]);			 
			

				$manufacturer = new Manufacturer();
				$manufacturer= $manufacturer->getManufacturerById($_POST["manufacturer_id"]);
				if(!$manufacturer){
					echo "producent taki nie istnieje!";
					return;
				}

		 
			if(strlen($_POST["product_no"]) > 0 && strlen($_POST["name"]) > 0 && strlen($_POST["description"]) > 0){	
			}else{				
				return;
			}


		}else{
			echo ":(";
			return;
		}		
	}
//====================================================================================================================================================



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