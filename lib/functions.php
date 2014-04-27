<?php


$BASE_URL= "http://localhost/testy/";

function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}


function formatDate($date){

	$date1 = new DateTime($date);
	$date2 = new DateTime();
	$diff = $date2->diff($date1);

	if($diff->y > 0){
		$out= ($diff->y==1? '1 rok' : $diff->y.' lata').' '.($diff->m>=1? $diff->m.' mies.':'');
	}elseif($diff->m > 0){
		$out= $diff->m.' mies.';
	}elseif($diff->d > 0){
		$tyg=round($diff->d/7);
		$out=  ($diff->d>=7) ? ($tyg==1? '1 tydz.':$tyg.' tyg.') : ($diff->d==1? '1 dzień '.($diff->h>0? $diff->h.' godz.':'') : $diff->d.' dni');
	}elseif($diff->h > 0){
		$out= $diff->h.' godz.';
	}elseif($diff->i > 0){
		$out= $diff->i.' min.';
	}else{
		$out= $diff->s.' sek.';
	}

	return $out.' temu.';
}



function getHtmlTreeByCatalogTree($catalog){
	$tree="";
	$tree.= "<p>".$catalog->name."<p>";
	$tree.= "<ul>";

	if($catalog->childCatalogs){
		foreach ($catalog->childCatalogs as $child){
			$tree.= "<li>";
			$tree.=getHtmlTreeByCatalogTree($child);
			$tree.= "</li>";
		}
	}

	$tree.= "</ul>";
	return $tree;
}


function arrayToString($arr){
	if(!$arr)return '()';
	$list='';
	foreach ($arr as $id){
		$list.=$id.',';
	}
	return '('.substr($list, 0, -1).')';
}




function compare($a, $b){
	if ($a["last_activity"] == $b["last_activity"]) {
		return 0;
	}
	return ($a["last_activity"] > $b["last_activity"]) ? -1 : 1;
}



function getUser($withSmarty=true){
	global $template,$DB;

	if(isset($_SESSION['access']) && isset($_SESSION['userId'])){

		$user = User::getUserById($_SESSION['userId']);
		if(!$user){
			$_SESSION = array();
			session_unset();
			session_destroy();
			header('Location: index.php');
		}else{
			if($withSmarty)$template->assign('user', $user);
			return $user;
		}
	}else{
		return null;
	}

}


function convertChars($input){

	$input= strtolower($input);
	$input = str_replace("ą", "&#261;",$input);
	$input = str_replace("ę", "&#281;",$input);
	$input = str_replace("ó", "&#243;",$input);
	$input = str_replace("ć", "&#263;",$input);
	$input = str_replace("ł", "&#322;",$input);
	$input = str_replace("ń", "&#324;",$input);
	$input = str_replace("ś", "&#347;",$input);
	$input = str_replace("ź", "&#378;",$input);
	$input = str_replace("ż", "&#380;",$input);
	return $input;

}

function getPasswordHash($input){
	//return md5($input);
	$salt= "hai";
	$toHash= $input.$salt;
	return hash('sha256', $toHash);
	
}

function datetime(){
	return date("Y-m-d H:i:s");
}






function putlink($a, $s, $u, $d, $t){
	
	include('simple_html_dom.php');
	global $user;
	
	$messages = array();
	
	//pobranie opisu strony:
	$opts = array('http' =>	array('user_agent' => 'Podzielsie/1.0 (http://www.podzielsie.pl/)')	);
	$context = stream_context_create($opts);
	$html = @file_get_html($u, FALSE, $context);
	
	
	if($html != false){	
		$d=$html->find('title', 0)->innertext;
	}else{
		$messages[]="Błąd podczas pobierania opisu strony.";
		return $messages;
	}
	
	
	
	if($t !== null){
	 $tags=$t;
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

	}else{
		$tags_name_arr=null;
	}

	//szukanie grupy docelowej
	$target='';
	switch ($s) {
		case Message::SHARE_NO_ONE:
			$target= null;
			break;
		case Message::SHARE_ALL:
			$target= 0;
			break;
		default:
			$id=Validator::parseNumber($s);
			
			if($id !== null && $user->belongsToGroup($id)){
				$target= $id;
			}else{
				$messages[]="Błąd. Nie należysz do tej grupy.";
				return $messages;
			}
			break;
	}

	//szukanie akcji:
	$message = null;
	switch ($a) {
		case Message::ACTION_SHARE:
			//share
			$mode = Message::LINKS_SHARE;
			break;
		case Message::ACTION_WATCH_LATER:
			//watch later
			$mode= Message::LINKS_WATCH_LATER;
			break;
		default:
			//id of catalog
			$id=Validator::parseNumber($a);
			if( $id !== null && $user->hasCatalog($id)){
				$mode= Message::LINKS_TO_CATALOG;
			}else{
				$messages[]=  'Błąd. Zły katalog.';
				return $messages;
			}
			break;
	}

	//zabezpieczenie: nie mozna udostepnic linku nikomu
	if($mode == Message::LINKS_SHARE && $target === null){
		$messages[]="Wybierz grupę docelową, by podzielić się tym linkiem."; return $messages;
	}


	//tworzenie nowego obiektu typu link:
	$link = new Link();
	$link->url=$u;
	$link->description=($d===null)?null:$d;


	//czy istnieje juz taki link:
	$old = Link::getLinkByUrl($link->url);

	if(!$old){
		//nie ma takiego linku w bd
		$messages[]="[nowy]";
		$link->save();
	}else{
		//link istnieje
		
		$newdesc= $link->description;	
		$link=$old;
		$link->description=$newdesc;
		$link->save();
		$messages[]="[istnieje]";
	}


	if($target !== null){
		//target nie jest null'em -> udostępniamy innym
		$result= $link->share($user->user_id, $target, $mode);
		if($result){
			$messages[]="[udostępniono]";
		}else{
			$messages[]="[nie udostępniono]";
		}


	}else{
		$messages[]="[nie udsotępniono]";
	}

	//realizacja akcji, którą wybrał użytkownik:
	if($mode == Message::LINKS_TO_CATALOG){

		if($user->addLinkToCatalog($link, (int)$a, $tags_name_arr)){
			$messages[]=  'Dodano link do katalogu';
		}else{
			$messages[]=   'Masz już ten link w tym katalogu';

		}

	}else if($mode == Message::LINKS_WATCH_LATER){

		if($user->addLinkToWatchLater($link)){
			$messages[]=  'Dodano link DPNP';
		}else{
			$messages[]=  'Masz już ten link w DPNP';
		}
	}else{
		$messages[]= 'Dodano link (tylko share)';
	}


	return $messages;
}







