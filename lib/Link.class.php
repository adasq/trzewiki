<?php
class Link
{
	//stałe
	const FAVICON_SYS = 'http://fvicon.com/';
	const UPLOAD_INTERVAL="+30 sec";

	public $link_id;
	public $url;
	public $description;

	public function __construct()
	{
			
	}//__construct

	
	public function addToCatalog($catalogId){
		global $DB;
		$sql= "INSERT INTO links_owners VALUES (".$this->link_id.", (select user_id from catalogs where catalog_id = ".$catalogId."), ".$catalogId." , null, '".date("Y-m-d H:i:s")."'   )";
		$DB->execute($sql);	
	}
	
	
	public static function getLinkById($id){
		global $DB;
		$DB->execute("SELECT * FROM Links where link_id = ".$id."");
		if($DB->getNumRows() == null){
			return null;
		}
		$obj = $DB->getNextObject();
		$link=new Link();
		$link->link_id = $obj->link_id;
		$link->url = $obj->url;
		$link->description = $obj->description;
		return $link;		
	}
	
	
	
	public static function getLinkByUrl($url){	
		global $DB;
		
		if(substr($url, -1) == '/'){
			$DB->execute("SELECT * FROM links where url = '".$url."' or url= '".substr($url, 0, -1)."' limit 1");
		}else{
			$DB->execute("SELECT * FROM links where url = '".$url."' or url = '".$url."/' limit 1");
		}
		
		
		if($DB->getNumRows() == null){
			return null;
		}
		$obj = $DB->getNextObject();
		//link_id	url	description	favicon
		$link=new Link();
		$link->link_id = $obj->link_id;
		$link->url = $obj->url;
		$link->description = $obj->description;
		return $link;
	}
	
	
	
	//share
	public function share($author, $target, $mode){

		global $DB;
		$DB->execute("SELECT * FROM links_sub where link_id=".$this->link_id." and target=".$target."  and mode=".$mode."  ");
		
		if($DB->getNumRows() == null){
			//nie udostępniał tego linku wcześniej
			$DB->execute("INSERT INTO links_sub VALUES (null, ".$this->link_id.", ".$author.", ".$target.", ".$mode.", '".datetime()."'  )");
			return true;
		}else{
		//wcześniej udostęniał ten link
		
			
			$row= $DB->getNextObject();
	
			$now = new DateTime(datetime());
			
			$linktime = new DateTime($row->last_activity);
			$linktime->modify(Link::UPLOAD_INTERVAL);

			
			if($now > $linktime){
					//mozna dodawac
				$id= $row->ls_id;
				$sql= "UPDATE links_sub set last_activity= '".datetime()."' where ls_id= ".$id."";
				$DB->execute($sql);
				return true;
			}else{
				return false;	
				
			}
			
	

				
		}
	}
	


	
	
	
	
	public static function getFaviconByUrl($url){		
		return Link::FAVICON_SYS . Link::getDomain($url);	
	}
	
	
	
	public static function getDomain($url){
		$url2 = preg_replace("/www\\./","",$url);
		$domain = parse_url($url2);
		if(!empty($domain["host"]))
		{
			if($domain['scheme'] == "http" || $domain['scheme'] == "https")return $domain['scheme'].'://'.$domain["host"];else return null;
		} else
		{
			return null;
		}
	}
	
	
	
	public static function getWatchLaterLinks(User $user){
		
		global $DB;
		$sql= "select l.*, w.date, w.wl_id from watch_later as w,links as l where l.link_id = w.link_id and w.user_id=".$user->user_id." order by w.date desc";
		$DB->execute($sql);
		if($DB->getNumRows() == 0){
			return null;
		}else{
			$arr=array();
			while($row = $DB->getNextArray()){			
				
				$row["date"]= formatDate($row["date"]);
				$row["favicon"]=Link::getFaviconByUrl($row["url"]);
				$row["server"]=Link::getDomain($row["url"]);
				$arr[]=$row;
			}
			return $arr;	
		}		
	}
	
	
	
	
	public static function deleteWtachlaterLink(User $user, $wlid){
		global $DB;
		$sql= "delete from watch_later where wl_id=".$wlid." and user_id=".$user->user_id."   ";
		return $DB->execute($sql);
	}
	
	
	
	
	public function save(){
		global $DB;
		if($this->link_id){
			$this->description = Validator::clean($this->description);
			
			$sql= "UPDATE links SET description='".$this->description."' where link_id= ".$this->link_id;
			$DB->execute($sql);
		}else{
			$this->description = Validator::clean($this->description);
			$this->url = mysql_real_escape_string($this->url);		
			
			$sql= "INSERT INTO LINKS VALUES (null, '".$this->url."', ".(($this->description === null)? "NULL" : "'".$this->description."'"  )." )";		 		
			$DB->execute($sql);		
			$id=$DB->getLastId();
			return $this->link_id=($id>0)?$id:null;
		}
	}//save
	
	
	
	
	public function __toString(){
		return "<p>Link:<table>
		<tr><td>link_id:</td><td>$this->link_id</td></tr>
		<tr><td>url:</td><td>$this->url</td></tr>
		<tr><td>description:</td><td>$this->description</td></tr>
		</table></p>";
	}//__toString
	//----------------------------------------------------------------------------------------------------------------------
}//class
?>
