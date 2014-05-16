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
		echo 'Brak producenta';
	}	
}else{
	$template->assign('currentManufacturer', null);
}



}
//=========================================================================================
	global $template;
	$template->assign("current", "sizes");


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