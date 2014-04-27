<?php
class Group
{
		
	//row:
	public $group_id;
	public $group_name;
	public $author_id;
	public $description;
	public $image;
	public $create_date;

	//groupsView:
	public $author_name;
	public $count;


	const GROUPS_MODE_BELONGTO=0;
	const GROUPS_MODE_OWN=1;

	const GROUPS_WHO_MEMBERS=2;
	const GROUPS_WHO_NOTMEMBERS=3;

	//odpowiednik kolumny mode:
	const MODE_APPLY=0;
	const MODE_MEMBER=1;
	const MODE_REJECT=2;
	const MODE_LEAVE=3;
	const MODE_KICK=4;


	public function __construct()
	{
		$this->create_date=datetime();
		$this->image= 'groups_default_100x100.png';
		$this->author_name=null;
		$this->count=null;
	}


	private static function getGroupByColumn($col_name, $col_value){

		global $DB;
		$sql= "SELECT * FROM groupsView WHERE ";
		$sql.= $col_name." = '".$col_value."'";

		$DB->execute($sql);
		if($DB->getNumRows() == 0){
			return null;
		}
		$group2 = $DB->getNextObject();
		$group= new Group();

		$group->group_id= $group2->group_id;
		$group->group_name=$group2->group_name;
		$group->author_id= $group2->author_id;
		$group->description= $group2->description;
		$group->image= $group2->image;
		$group->create_date=$group2->create_date;
		$group->author_name=$group2->author_name;
		$group->count=$group2->count;

		return $group;
	}

	public static function getGroupByName($name){
		return 	Group::getGroupByColumn("group_name", $name);
	}

	public static function getGroupById($id){
		return 	Group::getGroupByColumn("group_id", $id);
	}


	public static function getGroupMembersById($id, $mode){
		global $DB;
		$arr = array();


		if($mode === Group::GROUPS_WHO_NOTMEMBERS){
			$sql="SELECT * FROM groups_membership as gm, users as u WHERE gm.mode != 1 and gm.group_id = ".$id." and gm.user_id = u.user_id and u.user_id != (select author_id from groups where group_id = gm.group_id)";
		}else if ($mode === Group::GROUPS_WHO_MEMBERS){
			$sql="SELECT * FROM groups_membership as gm, users as u WHERE gm.mode = 1 and gm.group_id = ".$id." and gm.user_id = u.user_id and u.user_id != (select author_id from groups where group_id = gm.group_id)";
		}

		$DB->execute($sql);
		if($DB->getNumRows() == 0){
			return null;
		}

		while($row = $DB->getNextObject()){
			$arr[] =$row;
		}
		return $arr;

	}

	public function getGroupMembers($mode){
		return Group::getGroupMembersById($this->group_id, $mode);
	}


	private static function getGroupsQuery($sql){
		global $DB;
		$arr = array();
		$DB->execute($sql);
		if($DB->getNumRows() == 0){
			return null;
		}
		while($row = $DB->getNextObject()){
			$row->create_date=formatDate($row->create_date);
			$arr[] =$row;
		}
		return $arr;
	}




	public static function getGroups($tags=null){
		if($tags === null){
			$sql= "SELECT * from groupsView";
		}else{
				
			$sqlWhere='';
			foreach ($tags as $tag){
				if(Validator::validTag($tag)){
					$sqlWhere.= "group_name like '%".$tag."%' or group_name like '".$tag."%' or description like '%".$tag."%'  ";
					$sqlWhere.= 'or ';
				}
			}
			if($sqlWhere != ''){
				$sqlWhere=substr($sqlWhere, 0, -4);
				 $sql= "SELECT * from groupsView where ".$sqlWhere;
			}else{
				return null;
			}
				
		}
		return Group::getGroupsQuery($sql);
	}



	public static function getUserGroups(User $user, $mode){

		if($mode === Group::GROUPS_MODE_BELONGTO){
				
			$sql= "SELECT * from groupsView WHERE group_id in
					(select group_id from groups_membership where mode=1 and user_id=".$user->user_id.")
							";
				
		}else if($mode === Group::GROUPS_MODE_OWN){
			$sql= "SELECT * from groupsView where author_id = ".$user->user_id;
		}else{
			return null;
		}
		return Group::getGroupsQuery($sql);
	}


	public function save(){

		global $DB;
		if($this->group_id){
			$sql='';
			$DB->execute($sql);
		}else{
			$sql= "INSERT INTO GROUPS values (null, '".$this->group_name."', $this->author_id, ".(($this->description === null)?"NULL":"'".$this->description."'").", '".$this->image."', '".$this->create_date."' )";
			 
			if($DB->execute($sql)){
				$this->group_id= $DB->getLastId();
				if($this->group_id>0){
					$sql= "insert into groups_membership values (null, ".$this->author_id.", ".$this->group_id.", 1, '".$this->create_date."' )";
					$DB->execute($sql);
				}
				return true;
			}else{
				return false;
			}
				
				

				
		}


	}

	public function __toString(){
		return "<table>
		<tr><td>group_id:</td><td>$this->group_id</td></tr>
		<tr><td>group_name:</td><td>$this->group_name</td></tr>
		<tr><td>author_id:</td><td>$this->author_id</td></tr>
		<tr><td>description:</td><td>$this->description</td></tr>
		<tr><td>image:</td><td>$this->image</td></tr>
		<tr><td>tags:</td><td>$this->tags</td></tr>
		<tr><td>create_date:</td><td>$this->create_date</td></tr>

		<tr><td>author_name:</td><td>$this->author_name</td></tr>
		<tr><td>count:</td><td>$this->count</td></tr>
			


		</table>";
	}


}
?>
