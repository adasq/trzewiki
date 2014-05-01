<?php

include('../lib/init.php');
include(LIB_DIR.'Alert.class.php');
include(LIB_DIR.'Product.class.php');
include(LIB_DIR.'Manufacturer.class.php');
include(LIB_DIR.'Media.class.php');

function delete(){

global $template, $DB;

	if(isset($_GET["id"])){
		$id = $_GET["id"];

		$media= new Media(); 
		$media= $media->getMediaById($id);
		if($media){
			$media->deleted=1;
			$media->save();
			header('Location: '.$_SERVER["HTTP_REFERER"]);


		}else{
			//no media
		}
	}else{
		//no ID
	}


}
function neww(){

	global $template, $DB;

	if(isset($_GET["id"])){
		$id = $_GET["id"];

			$manufacturers= (new Manufacturer())->getManufacturers();

		$product= new Product();  
		$media= new Media();  
		$product= $product->getProductById($id);
		if($product){
			//echo $product->toString();

			if( isset($_POST["product_id"]) ){

 					$media->setData($_POST); 				 
 					$media->media_id = null;
 					$media->deleted = 0; 
					$media->save();

					$template->assign('alert', new Alert("success", "Pomyślnie dodano media do produktu ".$product->name.". Kliknij
						<a href=\"".$template->getConfigVariable('BASE_URL')."/admin/products/edit/".$product->product_id."\">tutaj</a>,
						 aby przejść do edycji..."));

			}else{

			}
			$template->assign('product', $product);	
			$template->assign('manufacturers', $manufacturers);	



		}else{

		}

	}

	$template->assign('media', $media);	
	$template->assign('CONTENT','admin/media');
	
}//edit


//=========================================================================================
	global $template;
	$template->assign("current", "media");
	switch($_GET['action']){
	case "edit":
		edit();
	break;
	case "delete":
		delete();
	break;		
	case "new":
		neww();
	break;
	};

	$template->assign('PAGE_TITLE','admin');
	$template->display('admin_template.tpl');

?>