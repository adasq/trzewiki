<?php
class Catalog
{

	public $catalog_id;
	public $name;
	public $height;
	public $parent_id;
	public $user_id;

	public $childCatalogs;

	public function __construct()
	{
		$childCatalogs=array();
	}


	public function deleteCatalog(){
			
		global $DB;
		$sql="select catalog_id from catalogs where parent_id=".$this->catalog_id;
		$DB->execute($sql);

		if($DB->getNumRows() > 0){
			return false;
		}else{

			$sql="delete from catalogs where catalog_id=".$this->catalog_id;
			$DB->execute($sql);
			return true;
		}

	}

	public function deleteLink($link_id){

		global $DB;
			
		$sql="select lo_id from links_owners where user_id=".$this->user_id." and catalog_id=".$this->catalog_id." and link_id=".$link_id;
		$DB->execute($sql);
		if($DB->getNumRows() == 0){
			return null;
		}else{
			$row= $DB->getNextObject();
			$sql="delete from links_owners where lo_id=".$row->lo_id;
			return $DB->execute($sql);
		}
	}


	public static function getCatalog(User $user, $catId){

		global $DB;
			
		$sql="select * from catalogs where user_id=".$user->user_id." and catalog_id=".$catId;
		$DB->execute($sql);
		if($DB->getNumRows() == 0){
			return null;
		}else if($DB->getNumRows() == 1){
			$row = $DB->getNextObject();

			$catalog = new Catalog();

			$catalog->catalog_id=$row->catalog_id;
			$catalog->name=$row->name;
			$catalog->height=$row->height;
			$catalog->parent_id=$row->parent_id;
			$catalog->user_id=$row->user_id;

			return $catalog;

		}else{
			return null;
		}
	}

	public function getLinks(){
		if($this->catalog_id){
			global $DB;

			$sql3="select * from (select null as tags, l.*, lo.lo_id, lo.date from links as l, links_owners as lo
					where l.link_id = lo.link_id and lo.user_id=".$this->user_id." and lo.catalog_id=".$this->catalog_id." and not exists (select * from link_tags where lo.lo_id = lo_id) group by lo.date
							UNION
							select  (group_concat(t.tag_name separator ','))  as tags, l.*, lo.lo_id, lo.date
							from links as l, links_owners as lo, link_tags as lt, tags as t
							where l.link_id = lo.link_id and lo.user_id=".$this->user_id." and lo.catalog_id=".$this->catalog_id." and lt.lo_id=lo.lo_id and lt.tag_id = t.tag_id group by lo.date) a group by date desc";



			$sql2= "select group_concat(t.tag_name separator ',') as tags, l.*, lo.lo_id, lo.date from
					links as l, links_owners as lo, link_tags as lt, tags as t
					where l.link_id = lo.link_id and lo.user_id=".$this->user_id." and lo.catalog_id=".$this->catalog_id." and lt.lo_id=lo.lo_id and lt.tag_id = t.tag_id
							group by lo.date desc";


			$sql="select l.*, o.date from links as l, links_owners as o where l.link_id = o.link_id  and  o.user_id=".$this->user_id." and o.catalog_id=".$this->catalog_id." order by o.date desc";
			$DB->execute($sql3);
			if($DB->getNumRows() == 0){
				return null;
			}
			$arr=array();
			while($row = $DB->getNextArray()){
					
				$row["date"]= formatDate($row["date"]);
				$row["description"]= 	stripslashes($row["description"]);
				$row["favicon"]=Link::getFaviconByUrl($row["url"]);
				$row["server"]=Link::getDomain($row["url"]);
					
				if($row["tags"]){
					$row["tags"]=explode(',', $row["tags"]);
				}
				$arr[]=$row;

			}
			return $arr;
		}

	}



	public function exists(){
		global $DB;
		$sql="select * from catalogs where user_id=".$this->user_id." and name='".$this->name."' and parent_id".(($this->parent_id === null)?" is NULL":"=".$this->parent_id)."";
		$DB->execute($sql);
		if($DB->getNumRows() == 0){
			return false;
		}else{
			return true;
		}
	}


	public function save(){
		global $DB;
		if($this->catalog_id){

		}else{
			$sql= "insert into catalogs values (NULL, '".$this->name."', ".$this->height.", ".(($this->parent_id === null)?"NULL":$this->parent_id).", ".$this->user_id.")";
			return $DB->execute($sql);
		}
	}

	public function __toString(){
		return "<table style=\"background-color: #aaa; margin:3px;\">
		<tr><td>catalog_id:</td><td>$this->catalog_id</td></tr>
		<tr><td>name:</td><td>$this->name</td></tr>
		<tr><td>height:</td><td>$this->height</td></tr>
		<tr><td>parent_id:</td><td>$this->parent_id</td></tr>
		<tr><td>user_id:</td><td>$this->user_id</td></tr>
		</table>";
	}

}
?>
