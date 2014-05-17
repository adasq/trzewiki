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

function home(){

	global $template;  
	$template->assign('CONTENT','admin/profile');
}

//=========================================================================================
	global $template;
	$template->assign("current", "profile");
	switch($_GET['action']){
	case "edit":
		edit();
	break;
	case "home":
		home();
	break;	

	};

	$template->assign('PAGE_TITLE','profil');
	$template->display('admin_template.tpl');

?>