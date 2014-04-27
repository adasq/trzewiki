<?php


class Message{

	//stałe przesyłane z bookmarkletu

	const ACTION_WATCH_LATER="wl";
	const ACTION_SHARE="s";
	const SHARE_NO_ONE="n";
	const SHARE_ALL="a";


	const FRIENDS_INVITE=0;
	const FRIENDS_ACCEPT=1;
	const FRIENDS_REJECT=2;
	const FRIENDS_DELETE=3;

	const GROUPS_APPLY=0;
	const GROUPS_ACCEPT=1;
	const GROUPS_REJECT=2;
	const GROUPS_LEAVE=3;
	const GROUPS_DELETE=4;


	//odpowiednik mode z tabeli links_sub
	const LINKS_SHARE=0;
	const LINKS_WATCH_LATER=1;
	const LINKS_TO_CATALOG=2;

	
	public static $user_last_activity=null;
	
	
	function __construct() {

	}

	

	public static function getFriendMessagges(User $user, $date){
		
		global $DB, $template;
		$id = $user->user_id;
		$friends = $user->getFriends();
		
		$where= "(".
		(
				($friends)?	
				"(f.user1 in ".arrayToString($friends)." or f.user2 in ".arrayToString($friends).") and f.mode = ".Message::FRIENDS_ACCEPT
				:
				" 1=2 "
		).
		")";
		//zapytanie: pobiera wszystkie aktywności użytkownika oraz aktywność mode=1 (zostanie znajomymi) dla naszych znajomych
		$query= "SELECT f.*, u1.username as user1name, u2.username as user2name 
				FROM friends as f, users as u1, users as u2 
				where u1.user_id = f.user1 and u2.user_id = f.user2 and	f.last_activity > '".$date."'
						and
						(	$where 
						or
						((user1 = ".$id." or user2 = ".$id."))
						)
				";
		
		$DB->execute($query);
		$arr=array();
		if($DB->getNumRows()==0){
			return $arr;
		}
		
		$baseurl =$template->getConfigVariable('BASE_URL');
		while($row = $DB->getNextArray()){
	
			$row["user1name"]= "<a href='".$baseurl."/user/".$row["user1name"]."'>".$row["user1name"]."</a>";
			$row["user2name"]= "<a href='".$baseurl."/user/".$row["user2name"]."'>".$row["user2name"]."</a>";
			$arr[]= $row;
			
		}
		return $arr;
	}

	public static function getGroupMessagges(User $user, $date){

		$id = $user->user_id;
		$groups2=$user->getGroups();
		
		$groups = $groups2===null?"(null)":arrayToString($user->getGroups());
		//echo $groups;
		global $DB, $template;
		//echo '<br><br><br><br><br><br>';
		  $query= "select m.*, u2.username as who, g.author_id, g.group_name, u.username as author_name
				from groups as g, groups_membership as m, users as u, users as u2 
				where g.author_id = u.user_id and g.group_id = m.group_id and u2.user_id = m.user_id and
				last_activity > '".$date."'
					and
					(		
						(m.user_id = ".$id.")
						or
						(g.author_id = ".$id." and m.mode=".Message::GROUPS_APPLY.")
						or
						(m.group_id in ".$groups." and (mode=1 or mode=3 or mode=4))
					)";

		$DB->execute($query);

	//echo '<br><br><br>'.trim($query).'<br><br><br>';
		
		$arr = array();
		if($DB->getNumRows()==0){
			//echo '0 wynikow';
			return $arr;
		}
		$baseurl =$template->getConfigVariable('BASE_URL');
		while($row = $DB->getNextArray()){
			//print_r($row);
			$row["group_name"]= "<a href='".$baseurl."/group/".$row["group_name"]."'>".$row["group_name"]."</a>";
			$row["who"]= "<a href='".$baseurl."/user/".$row["who"]."'>".$row["who"]."</a>";
			
			$arr[]= $row;
		}
		return $arr;

	}
	
	
	
	public static function getLinkMessagges(User $user, $date){
		$id = $user->user_id;
			
		$friends= $user->getFriends();
		$groups= $user->getGroups();
 
		 $friendsPica=  '( ls.author_id in '.(($friends)?arrayToString($friends):"(null)").' and ls.target = 0)';
		
		
		 $groupsPica= 	'( ls.target    in '.(($groups )?arrayToString($groups ):"(null)").')';
	

		
		 
		global $DB, $template;
		$baseurl =$template->getConfigVariable('BASE_URL');
		
	 $query= "select l.*, null as group_name, u.username, ls.mode, ls.last_activity 
		from links as l, links_sub as ls, users as u
		where ls.link_id = l.link_id and ls.author_id = u.user_id and ".$friendsPica." and ls.author_id != ".$user->user_id." and ls.last_activity > '".$date."'
		";
		
		$query.="
				UNION
		select l.*, g.group_name as group_name, u.username, ls.mode, ls.last_activity 
		from links as l, links_sub as ls, users as u,  groups as g 
		where   ls.link_id = l.link_id and ls.target>0 and g.group_id = ls.target and ls.author_id = u.user_id and ".$groupsPica." and ls.author_id != ".$user->user_id." and ls.last_activity > '".$date."'
		";
		 
		$DB->execute($query);
		$arr = array();
		if($DB->getNumRows()==0){
			return $arr;
		}
	
		while($row = $DB->getNextArray()){
			$row["favicon"]=Link::getFaviconByUrl($row["url"]);	
			$row["description"]= 	stripslashes($row["description"]);
			
			
			if($row["group_name"] !== null){
				$row["group_name"]="<a href='".$baseurl."/group/".$row["group_name"]."'>".$row["group_name"]."</a>";
			}else{
				$row["group_name"]="<a href='".$baseurl."/user/friends/".$user->username."'>znajomi</a>";
			}
			
			$row["username"]="<a href='".$baseurl."/user/".$row["username"]."'>".$row["username"]."</a>";
			$arr[] =  $row;
		}
		 
		return $arr;	
	}

	


}//class
?>