<?php
class Tag
{
		 

	
	public function __construct()
	{
		
	}//__construct


	public static function addTag($tag_name){
		
		global $DB;
		$sql= "insert into tags values (null, '".$tag_name."') ";
		$DB->execute($sql);
		$id=$DB->getLastId();
		return $id>0?$id:null;
	
	}
	
	
	public static function getLinksByTags($tags, User $user){
		global $DB;
		 
		
		
		if(sizeof($tags) > 0){
			$where= arrayToString($tags);
			
			$sql="select distinct l.*, lo.lo_id, lo.date, c.name as catalog_name, c.catalog_id
					from link_tags as lt, links_owners as lo, links as l, catalogs as c
					where lo.user_id=".$user->user_id." and lo.link_id=l.link_id and lt.lo_id=lo.lo_id and c.catalog_id= lo.catalog_id and lt.tag_id in ".$where;
	
			$DB->execute($sql);
			
			if($DB->getNumRows()  > 0 ){
				
				$links=array();
				while($link = $DB->getNextArray()){
					
					$link["date"]= formatDate($link["date"]);
					$link["favicon"]=Link::getFaviconByUrl($link["url"]);
					$link["server"]=Link::getDomain($link["url"]);
					
					$links[]=$link;
				}
				return $links;
			
			}else{
				return null;
			}
			
			
		}else{
			return null;
		}

	}
	
	
	
	
	public static function addTagsToLink($tag_ids, $lo_id){
		global $DB;
		foreach ($tag_ids as $tag_id){
			$sql= "INSERT INTO link_tags values ( ".$tag_id.", ".$lo_id."  )";
			$DB->execute($sql);
		}
	}
	
	public static function removeTagsFromLink($lo_id){
		global $DB;

			$sql= "DELETE from link_tags where lo_id= ".$lo_id."  ";
			$DB->execute($sql);
	
	}
	
	
	public static function getIdsByTags($arr, $insert=false){
		
		global $DB;
		
		$tag_ids= array();
		
		foreach ($arr as $tag){
			
			$sql= "select * from tags where tag_name= '".$tag."' ";
			$DB->execute($sql);
			
			if($DB->getNumRows() > 0){
				
				$tag_row=$DB->getNextObject();
				$tag_ids[] = $tag_row->tag_id;
				
			}else if($insert){
				
				$result= Tag::addTag($tag);
				if($result === null){
				}else{
					$tag_ids[]= $result;
				}
				
			}		
		}//foreach
		
		
		return $tag_ids;
	}
	
	
	
}//Tag
?>
