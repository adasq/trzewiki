<?php

include('../lib/init.php');
include(LIB_DIR.'Alert.class.php');
include(LIB_DIR.'Content.class.php');

function edit(){

	global $template;

	if(isset($_GET["id"])){
		$id = $_GET["id"];

			$content = new Content();
			$content= $content->getContentById($id);
			if($content){

			if(isset($_POST["content_key"]) && isset($_POST["content_value"])){

					$content->setData($_POST);
					$content->save();
					$content= $content->getContentById($id);
					if(!$content){
						goHomePage();
					}
					$template->assign('alert', new Alert("success", "Pomyślnie zaktualizowano dane"));

			}else{

			}

			$template->assign('content', $content);
			$template->assign('CONTENT','admin/content');

			}else{
				goHomePage();
			}
	}//GET id	
}//edit
function neww(){

	global $template, $DB;
			$content = new Content();
			if( isset($_POST["content_value"]) ){

 					$content->setData($_POST); 				 
 					$content->content_id = null;
 					$content->deleted = 0; 					
					$content->save(); 
												
					$template->assign('alert', new Alert("success", "Pomyślnie dodano treść. Kliknij 
						<a href=\"".$template->getConfigVariable('BASE_URL')."/admin/content/edit/".$DB->getLastId()."\">tutaj</a>,
						 aby przejść do edycji..."));

			}else{
				 
			}
			$template->assign('content', $content);		

	$template->assign('CONTENT','admin/content');
	
}//edit
function home(){

	global $template; 
	$content= new Content();  
	$template->assign('contents', $content->getContents());
	$template->assign('CONTENT','admin/contents');
}

//=========================================================================================
	global $template;
	$template->assign("current", "content");


// głęboka walidacja!!!!!!! ==================================================
	if(sizeof($_POST) > 0){		
		if(isset($_POST["content_value"]) && isset($_POST["content_key"])){
			 //deleted!			
			if(isset($_POST["deleted"])){
				$_POST["deleted"]= intval($_POST["deleted"]);
				if($_POST["deleted"] === 1 || $_POST["deleted"] === 0){
				}else{
					echo "ptaszek lub jego brak, innej mozliwosci nie ma!";		
					return;
				}
			}	
			if(strlen($_POST["content_value"]) > 0 && strlen($_POST["content_value"]) > 0){

			}else{
				echo "Oba pola wymagane";
				return;
			}
			$_POST["content_id"]= intval($_POST["content_id"]);
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