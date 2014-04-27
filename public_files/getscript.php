<?php
session_start();

define('LIB_DIR', '../lib/');
include(LIB_DIR.'DataBase.class.php');;
include (LIB_DIR.'User.class.php');
include (LIB_DIR.'Catalog.class.php');
include (LIB_DIR.'functions.php');
include (LIB_DIR.'Group.class.php');


$DB = new DataBase();

$user=null;
//kto jest zalogowany:
if(isset($_SESSION['access']) && isset($_SESSION['userId'])){

	$user = User::getUserById($_SESSION['userId']);
	if(!$user){
		$_SESSION = array();
		session_unset();
		session_destroy();
		$DB->disconnect();
		return;
	}
}

//style:


//global $BASE_URL;




$css='
#asher-topbar * {
letter-spacing: 0px !important;
background: none;
}
 
#asher-topbar a,#asher-topbar ul a {
	color: black;
}

#asher-info,#asher-info span {
		width:700px;
	font-family: "Arial", "Lucida Grande", "Lucida Sans Unicode",
		"Lucida Sans", Garuda, Verdana, Tahoma, sans-serif !important;
	font-weight: 500;
	text-decoration: none !important;
	text-align: left;
	display: inline-block;
	position: relative;
	height: 50px;
	line-height: 50px;
	color: black !important;
	white-space: nowrap;
	overflow: hidden;
	font-size: 25px;
	background: none;
	vertical-align: baseline;
}

#asher-topbar a:hover,.asher-submit a {
	color: orange !important;
}

#asher-function-ul, #asher-function-ul li
{ 
		list-style: none !important;
}	
		
		
#asher-topbar ul, #asher-topbar li {
	list-style: none !important;
	margin: 0;
	padding: 0;
}

#asher-topbar ul {
	z-inex: 99999999;
	padding: 0;
	margin: 0;
}

.asher-optionslist {
	margin: 0 !important
}

.asher-smalllist {
	visibility: hidden;
	margin-left: 5px !important;
	position: absolute;
	border-radius: 0px 0px 0px 0px !important
}

.asher-smalllist li {
	margin: 5px 0px !important;
	min-width: 150px;
	max-width: 150px;
	overflow: hidden;
	float: none;
	text-align: left !important
}

.asher-smallbutton {
	font-weight: normal !important;
	display: block;
	overflow: hidden !important;
	font-size: 12px !important;
	height: 20px !important;
	line-height: 20px !important;
	padding-left: 10px;
	text-align: left !important;
	padding: 0;
	line-height: 20px !important;
	font-family: "Arial", "Lucida Grande", "Lucida Sans Unicode",
		"Lucida Sans", Garuda, Verdana, Tahoma, sans-serif !important;
	text-indent: 0;
	text-align: left !important;
	text-decoration: none !important;
	vertical-align: baseline;
	color: black !important;
	white-space: nowrap;
	border: 0 !important;
	overflow: hidden !important
}

#asher-topbar {
	z-index: 999999;
	margin: 0;
	padding: 0;
	top: 0;
	left: 0;
	width: 100%;
	height: 60px;
	position: fixed;
	-webkit-box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.2);
	-moz-box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.2);
	box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.2);
	background-color: #ededed;
	border-bottom: 5px solid orange
}

#asher-inner {
	clear: both;
	margin: 0 auto;
	min-width: 960px;
	width: 960px;
	max-width: 1300px;
	height: 60px;
	position: relative
}

#asher-tags {
	font-family: "Arial", "Lucida Grande", "Lucida Sans Unicode",
		"Lucida Sans", Garuda, Verdana, Tahoma, sans-serif !important;
	margin: 10px 20px !important;
	padding: 1px !important;
	width: 210px !important;
	height: 30px !important;
	line-height: 30px !important;
	font-size: 12px !important;
	border: none !important;
	border-radius: 4px !important;
	background-color: white !important;
	box-shadow: none !important;
	overflow: hidden !important;
	position: relative
}

.asher-bigbutton:before {
	content: "" !important;
	position: absolute !important;
	background-repeat: no-repeat !important;
	width: 30px !important;
	height: 30px !important;
	display: block !important;
	top: 10px !important;
	left: 4px !important;
	background-image:
		url("'.$BASE_URL.'public_files/images/icons/icons.png")
		!important
}

a.asher-bigbutton {
	margin: 0px 5px 5px 0px !important;
	padding: 0;
	padding-left: 20px !important;
	padding-right: 5px !important;
	height: 50px !important;
	line-height: 50px !important;
	font-size: 15px !important;
	font-family: "Arial", "Lucida Grande", "Lucida Sans Unicode",
		"Lucida Sans", Garuda, Verdana, Tahoma, sans-serif !important;
	text-indent: 0;
	text-align: center !important;
	text-indent: 15px !important;
	text-decoration: none !important;
	vertical-align: baseline;
	font-weight: normal !important;
	white-space: nowrap;
	border-radius: 0px 0px 10px 10px !important;
	border: 0 !important;
	overflow: hidden !important;
	position: relative;
	display: inline-block;
	box-shadow: 0 1px 3px rgba(0, 0, 0, .15), inset 0 1px 0
		rgba(255, 255, 255, 1), inset -1px 0 0 rgba(248, 248, 248, 1), inset 0
		-1px 0 rgba(248, 248, 248, .5), inset 1px 0 0 rgba(248, 248, 248, 1)
		!important
}

.asher-bg {
	background: #fff !important;
	background:
		url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNlZmVmZWYiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+)
		!important;
	background: -moz-linear-gradient(top, #fff 0%, #efefef 100%) !important;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff),
		color-stop(100%, #efefef) ) !important;
	background: -webkit-linear-gradient(top, #fff 0%, #efefef 100%)
		!important;
	background: -o-linear-gradient(top, #fff 0%, #efefef 100%) !important;
	background: -ms-linear-gradient(top, #fff 0%, #efefef 100%) !important;
	background: linear-gradient(to bottom, #fff 0%, #efefef 100%) !important;
	filter: progid:DXImageTransform.Microsoft.gradient(  startColorstr="#fff",
		endColorstr="#efefef", GradientType=0 )
}

.asher-catalog:before {
	background-position: -60px -30px !important
}

.asher-watchlater:before {
	background-position: -30px -0px !important
}

.asher-share:before {
	background-position: -0px -30px !important
}

.asher-noone:before {
	background-position: -60px -0px !important
}

.asher-groups:before {
	background-position: -30px -30px !important
}

.asher-friends:before {
	background-position: -0px -0px !important
}

.asher-login:before {
	background-position: -0px -60px !important
}

.asher-fl {
	float: left
}

.asher-fr {
	float: right
}

#asher-logo {
	width: 150px;
	background-repeat: no-repeat;
	background-image:
		url("'.$BASE_URL.'public_files/images/icons/icons.png");
	background-position: -90px -0px;
	background-color: white
}

#asher-close,#asher-close a {
	line-height: 18px;
	font-family: arial, serif !important;
	text-decoration: none;
	font-size: 15px !important;
	top: 5px;
	right: 5px;
	position: absolute;
}		
';



 
$css= preg_replace( '/\s+/', ' ', $css);
$css="<style>".$css."</style>";



$str1='Zaloguj si&#281;, by udost&#281;pni&#263; t&#281; stron&#281;. ';
$str2='zaloguj si&#281;';
$str3='przejd&#378; do portalu';
$str4='dodaj tagi, oddzielone spacj&#261.';
$str5='dodaj do katalogu';
$str6='na potem';
$str7='znajomi';
$str8='nikt!';
$str9='grupa';
$str10='podziel si&#281;';
$str11='brak katalog&#243;w';
$str12='brak grup';

//plik interpretowany jako kod js
header("Content-Type: application/javascript");

if(!$user){
	//niezalogowany: 
	
	$notLoggedInDOM = '<div id="asher-topbar"><div id="asher-inner"><div id="asher-info" class="asher-fl"><span>'.$str1.'</span></div><a href="" id="asher-loginbtn" class="asher-fr asher-bg asher-friends asher-bigbutton">'.$str2.'</a><div class="asher-fl" id="asher-logo"></div></div><div id="asher-close" class="asher-fl"><a href="#">x</a></div></div>';

	//osobna przestrzeń nazw, by wyeliminować konflikty
	$jsDomObject="
	var ASHER_DOM = {
		base_url: '".$BASE_URL."',
		style_element:'".$css."',
		topbar_element:'".$notLoggedInDOM."',
									
		 createDom: function() {
				this.deleteDom();
				var newelem= document.createElement('div'); 
				newelem.id='asher';  
				newelem.innerHTML=this.style_element + this.topbar_element;
				document.body.appendChild(newelem);					
			return true;
			
    	},	

		deleteDom: function(){	
			var oldelem = document.getElementById('asher'); 
			return oldelem && document.body.removeChild(oldelem);	
		},			
		
		openLoginWindow: function(){	
			window.open(ASHER_DOM.base_url+'login','login','width=500,height=360,scrollbars=yes,resizable=yes,left='+(screen.availWidth/2-400)+',top='+(screen.availHeight/2-335)+'');	
		},			
		init: function(){			
	
					this.createDom();
					document.getElementById('asher-close').onclick=function(e){e.preventDefault(); ASHER_DOM.deleteDom();};	
					document.getElementById('asher-loginbtn').onclick=function(e){e.preventDefault(); ASHER_DOM.openLoginWindow(); ASHER_DOM.deleteDom();};	
					
		}				
					
					
					
	};
	";
	
	echo "(function(){";
	echo $jsDomObject;
	echo "ASHER_DOM.init(); ";
	echo '})();';
	$DB->disconnect();
	return;
	echo "(function(){ ";
	echo "var divs= '".$notLoggedInDOM."'; ";
	echo "var css= '".$css."'; ";	
	echo "var old = document.getElementById('asher');old && document.body.removeChild(old);var topbar= document.createElement('div');	topbar.id='asher';	topbar.innerHTML=css+divs;	document.body.appendChild(topbar); ";
	//dodanie akcji wyłączania:
	echo " document.getElementById('asher-close').onclick=function(e){ e.preventDefault(); var old = document.getElementById('asher'); old && document.body.removeChild(old);}; ";	
	//akcja przycisku login:
	echo "document.getElementById('asher-loginbtn').onclick=function(){window.open('".$BASE_URL."login','login','width=500,height=360,scrollbars=yes,resizable=yes,left='+(screen.availWidth/2-400)+',top='+(screen.availHeight/2-335)+'');	var old=document.getElementById('asher'); old && document.body.removeChild(old); return false;}; ";		
	echo "})();";

	
}else{
	//zalogowany:
 
	
		
	//pobierz katalogi:
	$catalogs= $user->getCatalogOrderedList();
	$catalogsTree='';
	if(!$catalogs){
		$catalogsTree.='<li><span class="asher-smallbutton" ><i>'.$str11.'</i></span></li>';
	}else{
		foreach ($catalogs as $catalog){
		 
			$catalog->name= convertChars($catalog->name);
			
			$catalogsTree.='<li name="asher-option"  id="action-'.$catalog->catalog_id.'"><a style="padding-left: '.($catalog->height*15).'px;" class="asher-smallbutton" href="#">'.$catalog->name.'</a></li>';
		}
	}
	
	//pobierz grupy:
	$groups = User::getGroupsByUserId($user->user_id);
	$groupsTree="";
	if(!$groups){
		$groupsTree.='<li><span class="asher-smallbutton" ><i>'.$str12.'</i></span></li>';
	}else{	
		foreach ($groups as $group){
			$group->group_name= convertChars($group->group_name);
		$groupsTree.='<li name="asher-option" id="share-'.$group->group_id.'"><a title="autor grupy: '.$group->author_name.', opis: '.addslashes($group->description).' " class="asher-smallbutton" href="#">'.$group->group_name.'</a></li>';
		}
	}
	
	//DOM:
	$loggedInDOM='<div id="asher-topbar">'.
			'<div style="background-color" id="asher-inner">'.
			'<ul class="asher-fl asher-optionslist">'.
			'<li id="asher-function" class="asher-fl"><a href="#" name="no-action" class="asher-bg asher-catalog asher-bigbutton">'.$str5.'</a> <ul id="asher-function-ul" class="asher-bg asher-smalllist" >'.$catalogsTree.'</ul></li><li name="asher-option" id="action-wl" class="asher-fl"><a href="#" class="asher-bg asher-watchlater asher-bigbutton">'.$str6.'</a></li><li name="asher-option" id="action-s" class="asher-fl"><a href="#" class="asher-bg asher-share asher-bigbutton">'.$str10.'</a></li></ul>'.
			'<input class="asher-fr" id="asher-tags" type="text" placeholder="'.$str4.'"/>'.
			'<ul class="asher-fr asher-optionslist"><li id="asher-share" class="asher-fl"><a href="#" name="no-action" class="asher-bg asher-groups asher-bigbutton">'.$str9.'</a> <ul id="asher-share-ul" class="asher-bg asher-smalllist">'.$groupsTree.'</ul></li><li name="asher-option" id="share-a" class="asher-fl"><a href="#" class="asher-bg asher-fl asher-friends asher-bigbutton">'.$str7.'</a></li><li name="asher-option" id="share-n" class="asher-fl"><a href="#" class="asher-bg asher-fl asher-noone asher-bigbutton">'.$str8.'</a></li></ul>'.
			'</div><div id="asher-close" class="asher-fl"><a href="#">x</a></div></div>';
	
	
	$logInElement='<div id="asher-info" style="asher-fl"><span>'.$str1.'</span></div><a href="'.$BASE_URL.'login" id="asher-loginbtn" class="asher-fr asher-bg asher-friends asher-bigbutton">'.$str2.'</a>';
	
	$infoElement1= '<div id="asher-info" class="asher-fl"><span style="font-size: 15px;">';
	$infoElement2=	'</span></div><a href="'.$BASE_URL.'home" class="asher-fr asher-bg asher-friends asher-bigbutton">'.$str3.'</a>';
	
	
	$w8_element= '<div style=" width: 960px; height: 60px; background-image:url("'.$BASE_URL.'public_files/images/icons/loader2.gif"); background-attachment:fixed; background-position:center; background-repeat:no-repeat; ">hhhhh</div>';
	
	
	
	
	
	
	
	
	$jsDomObject="
	var ASHER_DOM = {
		style_element:'".$css."',
		topbar_element:'".$loggedInDOM."',
		login_element:'".$logInElement."',
		hash: '".$user->getHash()."',			
		getInfoElement: function(txt) {
			return '".$infoElement1."'+txt+'".$infoElement2."';
		}
	};
	";
		
	$file = 'js/mainbm.js';
	$fh = fopen($file, 'r');
	$theData = fread($fh, filesize($file));
	fclose($fh);
	
	
	echo "(function(){";
	echo $jsDomObject;
	echo $theData;
	echo '})();';
	
	
	$DB->disconnect();
	return;
	
	


}


?>