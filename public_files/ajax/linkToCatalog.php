<?php

session_start();

define('LIB_DIR', '../../lib/');
define('CONFIG_DIR', '../../config/');
define('SMARTY_DIR', LIB_DIR.'Smarty-3.1.11/');


include(LIB_DIR.'DataBase.class.php');
include(LIB_DIR.'functions.php');
include(LIB_DIR.'Catalog.class.php');
include (LIB_DIR.'User.class.php');
include (LIB_DIR.'Friend.class.php');
include (LIB_DIR.'Message.class.php');
include(LIB_DIR.'Link.class.php');
include(LIB_DIR.'Tag.class.php');
include(LIB_DIR.'Validator.class.php');
include(LIB_DIR.'Group.class.php');


$DB = new DataBase();
$user=getUser(false);


$status= array();




if(isset($_POST["cid"]) && isset($_POST["lid"]) && $user){
	
	
	$cid= $_POST["cid"];
	$lid= $_POST["lid"];
	$tags= $_POST["tags"];
	
	
	
	$cid= Validator::parseNumber($cid);
	$lid= Validator::parseNumber($lid);

	
		if($lid !== null && $cid !== null && $user->hasCatalog($cid)){
		
		$link= Link::getLinkById($lid);	
		if($link){		
			if($tags !== null){
				
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
				
				
				if(sizeof($tags_name_arr) == 0){
					$tags_name_arr=null;
				}	
				 
			}
			
			
			$user->addLinkToCatalog($link, $cid, $tags_name_arr);
			
			echo json_encode(	array('obj'=> $tags_name_arr2, 'error' => false, 'info' => 'Pomyślnie dodano.')		);
			$DB->disconnect();
			return;
		}
			
		
	
		}

	
	
}
$DB->disconnect();
echo json_encode(	array('error' => true, 'info' => 'Nie udało się dodać linku do katalogu.')	);
return;




?>