<?php
session_start();

define('LIB_DIR', '../lib/');
define('CONFIG_DIR', '../config/');
define('SMARTY_DIR', LIB_DIR.'Smarty-3.1.11/');


include(LIB_DIR.'DataBase.class.php');
include(LIB_DIR.'functions.php');
include(LIB_DIR.'Catalog.class.php');
include (LIB_DIR.'User.class.php');
include (LIB_DIR.'Friend.class.php');
include (LIB_DIR.'Message.class.php');
include(LIB_DIR.'Link.class.php');
include(LIB_DIR.'Validator.class.php');
include(LIB_DIR.'Group.class.php');
include(LIB_DIR.'Tag.class.php');
include(LIB_DIR.'Template.class.php');
include(LIB_DIR.'recaptchalib.php');
include(CONFIG_DIR.'config.php');


$DB = new DataBase();
$template = new Template();
$template->configLoad('lang.conf', null);


if(strpos( $_SERVER['REQUEST_URI'] , 'catalogs.php')){
	$DB->disconnect();
	header('Location: '.$template->getConfigVariable('BASE_URL').'/catalogs');
}


$user= getUser();
if(!$user){$DB->disconnect();
header('Location: '.$template->getConfigVariable('BASE_URL').'/login');}

 

$catalog=null;



if(isset($_GET["search"])){

	$tags= $_GET["search"];

	$tags= Validator::clean($tags);

	$tags_name_arr2 = explode(' ',  $tags);
	$tags_name_arr= array();


	if(sizeof($tags_name_arr2) > 0){
			
		foreach ($tags_name_arr2 as $tag_name){
			if(Validator::validTag($tag_name)){
				$tags_name_arr[]=$tag_name;
			}
		}
	}


	if(sizeof($tags_name_arr) > 0){

		$tags_ids_arr= Tag::getIdsByTags($tags_name_arr);
		$links = Tag::getLinksByTags($tags_ids_arr, $user);
		$template->assign('links',$links);

	}else{

	}


	$template->assign('search',$_GET["search"]);
}else{
	

	
	if(isset($_GET["catid"])){
	
		$currcat= $_GET["catid"];
		$catalog= Catalog::getCatalog($user, $currcat);
	
		if($catalog){
	
	
	
			if(isset($_POST["submitted"])){
	
	
				if(isset($_POST["dellink"])){
					$lid= Validator::parseNumber($_POST["dellink"]);
					if($lid !== null){
						echo $lid;
						$catalog->deleteLink($lid);
						$template->assign('catalog_msg', array("error" => false, "message" => 'Usunięto link.'));
						
					}else{
						//id niepoprawne
						$template->assign('catalog_msg', array("error" => true, "message" => 'Nie udało się usunąć linku.'));
					}
				}
					
					
				if(isset($_POST["delcat"])){
					//deleteCatalog
	
					$cid= Validator::parseNumber($_POST["delcat"]);
					if($cid !== null){
	
						if($cid == $catalog->catalog_id){
							$deleted =$catalog->deleteCatalog();
							if(!$deleted){
			
	$template->assign('catalog_msg', array("error" => true, "message" => 'Nie można usunąć katalogu, zawierającego inne katalogi.'));
					
							}else{
								//echo 'usunieto';								
								header('Location: '.$template->getConfigVariable('BASE_URL').'/catalogs');
							}
	
	
						}
							
					}else{
						//id niepoprawne
							
					}
	
	
				}
					
					
	
			}
	
	
			//echo $catalog;
			$template->assign('catalog_obj',$catalog);
	
	
			if($links= $catalog->getLinks()){
				$template->assign('catalog_links',$links);
				$template->assign('catalogs_links',true);
					
			}else{
				//echo 'brak linków';
			}
	
	
		}else{
			header('Location: '.$template->getConfigVariable('BASE_URL').'/catalogs');
			//echo "nie posiadasz takiego katalogu";
		}
	
	
	}else{
		// get catId nie ustawione
	}
	
	
	//create new catalog:
	
	if(isset($_GET["create"])){
	
	
		$template->assign('catalog_showform',true);
	
		if(isset($_POST["submitted"])){
			//wypelniono form
				
			if(isset($_POST["catalog_newname"])){
				$name= $_POST["catalog_newname"];
	
					
					
					
				if(!Validator::validCatalogName($name)){
					$template->assign('catalog_err_newname', 'Nazwa katalogu niepoprawna');
					
				}else{
	
					$newCatalog= new Catalog();
	
					$newCatalog->name=$name;
					$newCatalog->user_id=$user->user_id;
					$newCatalog->height=(($catalog)?($catalog->height+1):0);
					$newCatalog->parent_id=(($catalog)?$catalog->catalog_id:null);
									
					if($newCatalog->exists()){
						$template->assign('catalog_err_newname', 'Błąd. Możliwe, że już taki katalog istnieje.');
					}else{
						$result= $newCatalog->save();
						$template->assign('catalog_msg', array("error" => false, "message" => 'Dodano katalog.'));
					}
					
					
	
	
				}
					
					
					
			}
				
		}
	
	}
	
	
	
	
	
	
	
	
}














if($catalogs=$user->getCatalogOrderedList()){
	$template->assign('catalog_list',$catalogs);
}

$DB->disconnect();
$template->assign('PAGE_TITLE','Twoje katalogi');
$template->assign('CONTENT','catalogs');
$template->display('main_template.tpl');



?>