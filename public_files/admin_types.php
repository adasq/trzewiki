<?php

include('../lib/init.php');
include(LIB_DIR.'Alert.class.php');
include(LIB_DIR.'Type.class.php');


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
				$template->assign('alert', new Alert("danger", "Taki typ nie istnieje"));

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
	};
	$template->assign('PAGE_TITLE','admin');
	$template->display('admin_template.tpl');


?>