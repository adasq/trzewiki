<?php

include('../lib/init.php');
include(LIB_DIR.'Alert.class.php');
include(LIB_DIR.'Type.class.php');
include(LIB_DIR.'Product.class.php');
include(LIB_DIR.'ProductType.class.php');


function edit(){

	global $template;

	if(isset($_GET["id"])){
		$id = $_GET["id"];

			$type = new Type();
			$type= $type->getTypeById($id);
			if($type){

			if( isset($_POST["type_id"]) ){ 
 					$type->setData($_POST); 
					$type->save();
					$type= $type->getTypeById($id);
					$template->assign('alert', new Alert("success", "Pomyślnie zaktualizowano dane"));

			}else{
			}
			$template->assign('type', $type);		

			}else{
				goHomePage();

			}//!content
		}//GET id
	$template->assign('CONTENT','admin/type');
 
	
}//edit
function neww(){

	global $template, $DB;
			$type = new Type();
			if( isset($_POST["type_id"]) ){

 					$type->setData($_POST); 				 
 					$type->type_id = null;
 					$type->deleted = 0;
					$type->save(); 
							
					$template->assign('alert', new Alert("success", "Pomyślnie dodano typ. Kliknij 
						<a href=\"".$template->getConfigVariable('BASE_URL')."/admin/types/edit/".$DB->getLastId()."\">tutaj</a>,
						 aby przejść do edycji..."));

			}else{

			}
			$template->assign('type', $type);		
 
	$template->assign('CONTENT','admin/type');
 
	
}//edit
function home(){
	global $template; 
	$type= new Type();   
	$template->assign('types', $type->getTypes());
	$template->assign('CONTENT','admin/types');

}
function add(){
	global $template; 

	$productId = $_GET["pid"];
	$typeId = $_GET["tid"];
 	

 	$pt = new ProductType();
 	$pt->deleted = 0;
	$pt->type_id= $typeId;
	$pt->product_id= $productId;
	$pt->save();
	header('Location: '.$_SERVER["HTTP_REFERER"]);

}
function remove(){
	global $template; 

	$productId = $_GET["pid"];
	$typeId = $_GET["tid"];
 	
	$pt = new ProductType();
	$pt = $pt->getByColumna("product_id", $productId);
	if($pt){
			foreach ($pt as $productType) {
					 echo $productType->toString();
					 if($typeId === $productType->type_id){
					 	$productType->delete();
					 }
				} 
	}else{
		goHomePage();
	}

	header('Location: '.$_SERVER["HTTP_REFERER"]);

}
//=======================================================================================================
	global $template;
	$template->assign("current", "types");
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
	case "add":
		add();
		break;	
	case "remove":
		remove();		
	break;		
	};
	$template->assign('PAGE_TITLE','admin');
	$template->display('admin_template.tpl');


?>