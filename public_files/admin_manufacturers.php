<?php

include('../lib/init.php');
include(LIB_DIR.'Alert.class.php');
include(LIB_DIR.'Manufacturer.class.php');


function edit(){

	global $template;

	if(isset($_GET["id"])){
		$id = $_GET["id"];

			$manufacturer = new Manufacturer();
			$manufacturer= $manufacturer->getManufacturerById($id);
			if($manufacturer){

			if( isset($_POST["manufacturer_id"]) ){

 					$manufacturer->setData($_POST);
					$manufacturer->save();
					$manufacturer= $manufacturer->getManufacturerById($id);
					$template->assign('alert', new Alert("success", "Pomyślnie zaktualizowano dane"));

			}else{
			}
			$template->assign('manufacturer', $manufacturer);		

			}else{
				goHomePage();

			}//!content
		}//GET id
	$template->assign('CONTENT','admin/manufacturer');
 
	
}//edit
function neww(){

	global $template, $DB;
			$manufacturer = new Manufacturer();
			if( isset($_POST["name"]) ){

 					$manufacturer->setData($_POST); 				 
 					$manufacturer->manufacturer_id = null;
 					$manufacturer->deleted = 0;
					$manufacturer->save(); 
							
					$template->assign('alert', new Alert("success", "Pomyślnie dodano producenta. Kliknij 
						<a href=\"".$template->getConfigVariable('BASE_URL')."/admin/manufacturers/edit/".$DB->getLastId()."\">tutaj</a>,
						 aby przejść do edycji..."));

			}else{

			}
			$template->assign('manufacturer', $manufacturer);		

//$template->assign('alert', new Alert("danger", "Taki producent nie istnieje"));


	$template->assign('CONTENT','admin/manufacturer');
 
	
}//edit
function home(){

	global $template; 
	$manufacturer= new Manufacturer();  
	$template->assign('manufacturers', $manufacturer->getManufacturers());
	$template->assign('CONTENT','admin/manufacturers');


}

//=======================================================================================================
	global $template;
	$template->assign("current", "manufacturers");

// głęboka walidacja!!!!!!! ==================================================
	if(sizeof($_POST) > 0){		
		if(isset($_POST["manufacturer_id"]) && isset($_POST["name"])){
			 //deleted!			
			if(isset($_POST["deleted"])){
				$_POST["deleted"]= intval($_POST["deleted"]);
				if($_POST["deleted"] === 1 || $_POST["deleted"] === 0){
				}else{
					echo "ptaszek lub jego brak, innej mozliwosci nie ma!";		
					return;
				}
			}	
			if(strlen($_POST["name"]) > 0){

			}else{
				echo "nazwe ustaw";
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