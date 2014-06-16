<?php

include('../lib/init.php');
include(LIB_DIR.'Alert.class.php');
include(LIB_DIR.'Product.class.php');
include(LIB_DIR.'Manufacturer.class.php');
include(LIB_DIR.'Size.class.php');


function edit(){

	global $template;


	$manufacturer = new Manufacturer();
	$manufacturers= $manufacturer->getManufacturers();


	if(isset($_GET["id"])){
		$id = $_GET["id"];

			$size= new Size();  
			$size= $size->getSizeById($id);
			if($size){

			if( isset($_POST["size_id"]) ){

					$size->setData($_POST);				 
					$size->save();
					$size= $size->getSizeById($id);
					$template->assign('alert', new Alert("success", "Pomyślnie zaktualizowano dane"));

			}else{

			}
			
			$template->assign('manufacturers', $manufacturers);
			$template->assign('size', $size);
			$template->assign('CONTENT','admin/size');

			}else{
				goHomePage();
			}//!content

		}//GET id

}//edit
function neww(){

global $template, $DB;


	$manufacturer = new Manufacturer();
	$manufacturers= $manufacturer->getManufacturers();
  	
			$size= new Size();   
	
			if( isset($_POST["size_id"]) ){

					$size->setData($_POST);	
					$size->size_id=null;
					$size->deleted=0;	

					$size->save();

			$template->assign('alert', new Alert("success", "Pomyślnie dodano rozmiar. Kliknij 
						<a href=\"".$template->getConfigVariable('BASE_URL')."/admin/sizes/edit/".$DB->getLastId()."\">tutaj</a>,
						 aby przejść do edycji..."));


			}else{
				 
			}
			
			$template->assign('manufacturers', $manufacturers);
			$template->assign('size', $size);
			$template->assign('CONTENT','admin/size');


}//edit
function home(){


	global $template; 

	$size= new Size();  

$manufacturer = new Manufacturer();
$manufacturers= $manufacturer->getManufacturers();

$sizes = $size->getSizes();

	$template->assign('sizes', $sizes);
	$template->assign('manufacturers', $manufacturers);

	$template->assign('CONTENT','admin/sizes');

if(isset($_GET['manu'])){

	$manufacturer2 = $manufacturer->getManufacturerById($_GET['manu']);
	if($manufacturer2){
		//echo $manufacturer2->toString();
		$template->assign('currentManufacturer', $manufacturer2);
	}else{
	
	}	
}else{
	$template->assign('currentManufacturer', null);
}



}
//=========================================================================================
	global $template;
	$template->assign("current", "sizes");

// głęboka walidacja!!!!!!! ==================================================
	if(sizeof($_POST) > 0){
		
		if(isset($_POST["size_id"]) && isset($_POST["us"]) && isset($_POST["uk"]) && isset($_POST["cm"]) && isset($_POST["euro"]) && isset($_POST["sex"])){
			 //deleted!
			if(isset($_POST["deleted"])){
				$_POST["deleted"]= intval($_POST["deleted"]);
				if($_POST["deleted"] === 1 || $_POST["deleted"] === 0){
				}else{
					echo "ptaszek lub jego brak, innej mozliwosci nie ma!";		
					return;
				}
			}			 
			 $_POST["size_id"]= intval($_POST["size_id"]);
			 $_POST["manufacturer_id"]= intval($_POST["manufacturer_id"]);			 
			 $_POST["us"]= intval($_POST["us"]);
			 $_POST["uk"]= intval($_POST["uk"]);
			 $_POST["cm"]= intval($_POST["cm"]);
			 $_POST["euro"]= intval($_POST["euro"]);

				$manufacturer = new Manufacturer();
				$manufacturer= $manufacturer->getManufacturerById($_POST["manufacturer_id"]);
				if(!$manufacturer){
					return;
				}
				

			if( !($_POST["sex"] === "male" || $_POST["sex"] === "female")) {
				echo "szkoda ze w podanym zakresie nie ma Twojej plci... :(";		
				return;
			}
			if($_POST["manufacturer_id"] > 0 && $_POST["us"] > 0 && $_POST["uk"] > 0 && $_POST["cm"] > 0 && $_POST["euro"] > 0) {				
			}else{				
				return;
			}

		}else{
			echo ":(";
			return;
		}		
	}
// głęboka walidacja!!!!!!! ==================================================

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