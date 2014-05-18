<?php

/**
 * USER
 */
class Customer extends Base {

    public $id = "customer_id";
    public $table = "customers";
    public $fields = array(
        "customer_id" => "int",
        "login" => "string",
        "password" => "string",
        "salt" => "string",
        "email" => "string",
        "first_name" => "string",
        "last_name" => "string",
        "street" => "string",
        "street_additional" => "string",
        "zip_code" => "string",
        "city" => "string",
        "status" => "string",
        "deleted" => "int"
    );
    public $customer_id;
    public $login;
    public $password;
    public $salt;
    public $email;
    public $first_name;
    public $last_name;
    public $street;
    public $street_additional;
    public $zip_code;
    public $city;
    public $status;
    public $deleted = 0;

    const STATUS_ACTIVE = 'active';

    public function getCustomers() {

        return $this->get();
    }

    public function getCustomerById($id) {

        return $this->getById($id);
    }

    public function __construct($obj = null) {
        parent::__construct($obj);
    }

//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
    public function last_activity($date = null) {
        global $DB;
        if (!$date) {
            $DB->execute("SELECT last_visit from users_config where user_id = " . $this->user_id);
            $row = $DB->getNextObject();
            return $this->last_mess_activity = $row->last_visit;
        } else {
            $DB->execute("update users_config set last_visit= '" . $date . "' where user_id = " . $this->user_id);
        }
    }

    public function addLinkToCatalog(Link $link, $cat_id, $tags_name_arr = null) {


        global $DB;

        if ($tags_name_arr !== null) {
            $tags_ids_arr = Tag::getIdsByTags($tags_name_arr, true);
        }


        //nie dodajemy linku do katalogu w ktorym istnieje juz link o danym url
        //zmieniamy tylko date
        $sql = "select lo.lo_id from links_owners as lo, links as l
				where lo.user_id = " . $this->user_id . " and
						lo.link_id = l.link_id and
						l.url = '" . $link->url . "' and
								lo.catalog_id = " . $cat_id . " ";
        $DB->execute($sql);

        if ($DB->getNumRows() > 0) {
            //ma ten link w katalogu, zmieniamy tylko date
            $row = $DB->getNextObject();
            $id = $row->lo_id;
            if ($tags_name_arr !== null) {
                Tag::removeTagsFromLink($id);
                Tag::addTagsToLink($tags_ids_arr, $id);
            }
            $sql = "UPDATE links_owners set date='" . date("Y-m-d H:i:s") . "' where lo_id = " . $id;
            $DB->execute($sql);
            return false;
        } else {
            //nie ma linku w tym katalogu
            $DB->execute("INSERT into links_owners values (null, " . $link->link_id . ", " . $this->user_id . ", " . $cat_id . ", '" . date("Y-m-d H:i:s") . "')");
            $lo_id = $DB->getLastId();

            if ($tags_name_arr !== null) {
                Tag::addTagsToLink($tags_ids_arr, $lo_id);
            }
            return true;
        }
    }

    public function addLinkToWatchLater(Link $link) {

        global $DB;

        $DB->execute("SELECT wl_id FROM watch_later as w, links as l WHERE w.user_id = " . $this->user_id . " and w.link_id = l.link_id and l.url = '" . $link->url . "' ");
        if ($DB->getNumRows() == 0) {
            return $DB->execute("insert into watch_later values ( null, " . $this->user_id . " , " . $link->link_id . ", '" . date("Y-m-d H:i:s") . "' )");
        } else {

            $row = $DB->getNextObject();
            $id = $row->wl_id;
            $DB->execute("update watch_later set date='" . date("Y-m-d H:i:s") . "' where wl_id=" . $id);
            return null;
        }
    }

    public static function exists($val, $mail = false) {

        global $DB;
        $DB->execute("SELECT user_id from USERS where " . (($mail) ? "mail" : "username") . " = '" . $val . "'");
        return ($DB->getNumRows() == 0) ? false : true;
    }

//exists

    public static function getIdByUsername($name) {

        if (User::validateUsername($name)) {

            global $DB;
            $DB->execute("SELECT user_id FROM USERS where username = '" . $name . "'");
            if ($DB->getNumRows() == 1) {
                return $DB->getNextObject()->user_id;
            }
        }
        return null;
    }

    public static function getUserById($id) {

        global $DB;
        $DB->execute("SELECT * FROM USERS where user_id = '" . $id . "'  and is_active = 1");

        if ($DB->getNumRows() == null) {
            return null;
        }

        $obj = $DB->getNextObject();
        $user = new User();
        $user->convert($obj);
        return $user;
    }

//getUserById

    public static function getUsers($find = null) {

        global $DB;


        if ($find === null) {
            $sql = "SELECT * FROM USERS where is_active = 1 order by username";
        } else {
            $sql = "SELECT * FROM USERS where username LIKE '" . $find . "%'  and is_active = 1 order by username";
        }

        $DB->execute($sql);

        if ($DB->getNumRows() == null) {
            return null;
        }
        $usersarray = array();
        while ($obj = $DB->getNextObject()) {
            $usersarray[] = $obj;
        }

        return $usersarray;
    }

    public static function getUserByName($name, $mail = false) {



        if (($mail && !Validator::validMail($name)) or ( !$mail && !Validator::validUsername($name))) {
            return null;
        }

        global $DB;
        $sql = "SELECT * FROM USERS where " . (($mail) ? "mail" : "username") . " = '" . $name . "'";
        $DB->execute($sql);

        if ($DB->getNumRows() == null) {
            return null;
        }

        $obj = $DB->getNextObject();
        $user = new User();
        $user->convert($obj);
        return $user;
    }

//getUserByName

    public function getFriendStatusByUser(User $user) {

        global $DB;
        $arr = array();
        $sql = "select * from friendsView where
				(user1 = " . $this->user_id . " and user2= " . $user->user_id . ")
						or
						(user2 = " . $this->user_id . " and user1= " . $user->user_id . ")";

        $DB->execute($sql);
        if ($DB->getNumRows() == 0) {
            return null;
        } else if ($DB->getNumRows() == 1) {
            $row = $DB->getNextObject();
            return $row;
        } else {
            echo 'user->getFriendStatusByUser->193';
        }
    }

    //need
    public static function getFriendsByUserId($id) {
        global $DB;
        $arr = array();

        $sql = "SELECT user2 as f FROM friends WHERE user1=" . $id . " and mode=" . Group::MODE_MEMBER . "
				union
				SELECT user1 as f  FROM friends WHERE user2=" . $id . " and mode=" . Group::MODE_MEMBER . "";

        $DB->execute($sql);
        if ($DB->getNumRows() == 0) {
            return null;
        }
        while ($row = $DB->getNextObject()) {
            $arr[] = $row->f;
        }
        return $arr;
    }

//getFriendsByUserId
    //need
    public function getFriendsList() {
        global $DB;

        $sql = "SELECT u.* FROM friends as f, users as u WHERE f.user1=" . $this->user_id . " and f.mode=1 and u.user_id = f.user2" .
                " union " .
                "SELECT u.* FROM friends as f, users as u WHERE f.user2=" . $this->user_id . " and f.mode=1 and u.user_id = f.user1";

        $arr = array();
        $DB->execute($sql);
        if ($DB->getNumRows() == 0) {
            return null;
        }

        while ($row = $DB->getNextObject()) {
            $arr[] = $row;
        }
        return $arr;
    }

    //need
    public function getFriendsActions(User $user, $mode) {

        global $DB;
        $arr = array();
        switch ($mode) {
            case Friend::FRIENDS_MODE_REQUEST:
                $sql = "select f.user2, f.mode, u.username, u.avatar from friends as f, users as u where u.user_id = f.user2 and f.mode!=1 and  f.user1=" . $user->user_id . " order by f.last_activity desc	";
                break;
            case Friend::FRIENDS_MODE_RESPONSE:
                $sql = "select f.user1, f.mode, u.username, u.avatar from friends as f, users as u where u.user_id = f.user1 and f.mode!=1 and  f.user2=" . $user->user_id . "	order by f.last_activity desc";
                break;
            default:
                $sql = "";
                break;
        }
        $DB->execute($sql);
        if ($DB->getNumRows() == 0) {
            return null;
        }
        while ($row = $DB->getNextObject()) {
            $arr[] = $row;
        }
        return $arr;
    }

    //need
    public function getGroupStatus(Group $group) {
        global $DB;

        $sql = "select * from groups_membership where user_id=" . $this->user_id . " and group_id=" . $group->group_id;

        $DB->execute($sql);
        if ($DB->getNumRows() == 0) {
            return null;
        } else if ($DB->getNumRows() == 1) {
            $row = $DB->getNextObject();
        } else {
            echo "user->getGroupStatus zwróciło więcej niż 1 wynik";
            return null;
        }

        return $row;
    }

    public function updateGroupStatus(Group $group, $newStatus, User $targetUser = null) {
        $sql = null;
        if (!$targetUser) {
            //ustalamy sobie
            $currStatus = $this->getGroupStatus($group);
            if (!$currStatus) {
                //brak wpisu w bd, czyli mozemy tylko dolaczyc
                if ($newStatus == 0) {
                    $sql = "insert into groups_membership values (null, " . $this->user_id . ", " . $group->group_id . ", 0, '" . date("Y-m-d H:i:s") . "')";
                }
            } else {
                //jest wpis w bd
                if (
                        (($currStatus->mode == Group::MODE_REJECT || $currStatus->mode == Group::MODE_KICK || $currStatus->mode == Group::MODE_LEAVE) && $newStatus == Group::MODE_APPLY) ||
                        ($currStatus->mode == Group::MODE_MEMBER && $newStatus == Group::MODE_LEAVE)
                ) {



                    $sql = "update groups_membership set last_activity= '" . datetime() . "', mode=" . $newStatus . " where gm_id=" . $currStatus->gm_id;
                }
            }
        } else {
            //ustalamy komus

            if ($this->user_id == $group->author_id) {
                //jestesmy autorem grupy, mozemy nadawac status
                $currStatus = $targetUser->getGroupStatus($group);
                if ($currStatus) {

                    //wpis w db
                    if (
                            ($currStatus->mode == Group::MODE_APPLY && ($newStatus == Group::MODE_MEMBER || $newStatus == Group::MODE_REJECT)) ||
                            ($currStatus->mode == Group::MODE_MEMBER && $newStatus == Group::MODE_KICK)
                    ) {
                        $sql = "update groups_membership set last_activity= '" . datetime() . "', mode=" . $newStatus . " where gm_id=" . $currStatus->gm_id;
                    }
                } else {
                    //brak wpisu w db
                }
            } else {
                //nie jestesmy autorem grupy
            }
        }
        global $DB;
        $DB->execute($sql);
    }

//func

    public function getHash() {
        global $DB;
        $sql = "select * from users_config where user_id = " . $this->user_id . " ";
        $DB->execute($sql);
        $row = $DB->getNextObject();

        if ($DB->getNumRows() == 1) {
            return $row->hash;
        } else {
            return null;
        }
    }

    public static function getUserByHash($hash) {

        global $DB;
        $sql = " select * from users where user_id = (select user_id from users_config where hash = '" . $hash . "') ";
        $DB->execute($sql);


        if ($DB->getNumRows() == 1) {
            $obj = $DB->getNextObject();
            $user = new User();
            $user->convert($obj);
            return $user;
        } else {
            return null;
        }
    }

    public static function getGroupsIdByUserId($id) {
        global $DB;
        $arr = array();
        $sql = "SELECT m.group_id, g.group_name FROM groups_membership as m, groups as g WHERE g.group_id=m.group_id and m.user_id = " . $id . " and m.mode=" . Group::MODE_MEMBER;
        $DB->execute($sql);
        if ($DB->getNumRows() == 0) {
            return null;
        }

        while ($row = $DB->getNextObject()) {
            $arr[] = $row->group_id;
        }
        return $arr;
    }

//getGroupsByUserId

    public static function getGroupsByUserId($id) {
        global $DB;
        $arr = array();
        $sql = "SELECT m.group_id, g.group_name, g.author_name, g.description FROM groups_membership as m, groupsview as g WHERE g.group_id=m.group_id and m.user_id = " . $id . " and m.mode=" . Group::MODE_MEMBER;
        $DB->execute($sql);
        if ($DB->getNumRows() == 0) {
            return null;
        }

        while ($row = $DB->getNextObject()) {
            $arr[] = $row;
        }
        return $arr;
    }

//getGroupsByUserId

    public static function getCatalogsByUserId($id) {
        global $DB;
        $arr = array();
        $sql = "SELECT catalog_id, name FROM catalogs WHERE user_id = " . $id . " ";
        $DB->execute($sql);
        if ($DB->getNumRows() == 0) {
            return null;
        }

        while ($row = $DB->getNextObject()) {
            $arr[] = array("catalog_id" => $row->catalog_id, "name" => $row->name);
        }
        return $arr;
    }

//getCatalogsByUserId

    public static function isUserBelongToGroup($userId, $groupId) {
        global $DB;
        $arr = array();
        $sql = "SELECT group_id FROM groups_membership  WHERE user_id = " . $userId . "  and group_id=" . $groupId . "  and mode=1";
        $DB->execute($sql);
        if ($DB->getNumRows() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function hasUserCatalog($userId, $catalogId) {
        global $DB;
        $arr = array();
        $sql = "SELECT * FROM catalogs  WHERE user_id = " . $userId . "  and catalog_id=" . $catalogId . " ";
        $DB->execute($sql);
        if ($DB->getNumRows() == 0) {
            return false;
        } else {
            return true;
        }
    }

//hasUserCatalog
    //----------------------------------------------------------------------------------------------------------------------
    public function hasCatalog($catalogId) {
        return User::hasUserCatalog($this->user_id, $catalogId);
    }

    public function getFriends() {
        return User::getFriendsByUserId($this->user_id);
    }

    public function getGroups() {
        return User::getGroupsIdByUserId($this->user_id);
    }

    public function belongsToGroup($groupId) {
        return User::isUserBelongToGroup($this->user_id, $groupId);
    }

    function getCatalogTree() {

        $catalogs = $this->getCatalogs();

        $main = array();
        $arr = array();
        $currentHeight = 0;

        for ($i = 0; $i < sizeof($catalogs); $i++) {
            if ($catalogs[$i]->height == $currentHeight) {
                $arr[] = $catalogs[$i];
            } else {
                $main[] = $arr;
                $currentHeight++;
                $arr = array();
                $arr[] = $catalogs[$i];
                if ($i + 1 == sizeof($catalogs))
                    $main[] = $arr;
            }
        }


        for ($i = sizeof($main) - 1; $i > 0; $i--) {

            foreach ($main[$i - 1] as $parent) {

                foreach ($main[$i] as $child) {
                    if ($child->parent_id == $parent->catalog_id) {
                        $parent->childCatalogs[] = $child;
                    }
                }//child loop
            }//parents loop
        }




        $mainCatalog = new Catalog();
        $mainCatalog->name = "Catalogs";
        $mainCatalog->catalog_id = 0;
        $mainCatalog->childCatalogs = $main[0];

        return $mainCatalog;
    }

//getCatalogTree

    public function getCatalogOrderedList() {

        $arr = array();
        $catalogs = $this->getCatalogs();
        if (!$catalogs)
            return null;

        foreach ($catalogs as $catalog) {

            if ($catalog->height == 0) {
                $arr[] = $catalog;
            } else {

                for ($i = 0; $i < sizeof($arr); $i++) {

                    if ($catalog->parent_id == $arr[$i]->catalog_id) {

                        $right = array_splice($arr, $i + 1);
                        $arr = array_merge(array_splice($arr, 0, $i + 1), array($catalog), $right);
                    }
                }
            }
        }


        return $arr;
    }

    public function getCatalogs() {
        global $DB;

        $sql = "SELECT * FROM catalogs where user_id=" . $this->user_id . " order by height asc";
        $DB->execute($sql);
        if ($DB->getNumRows() == 0) {
            return null;
        }

        $array = array();
        while ($row = $DB->getNextObject()) {

            $cat = new Catalog();
            $cat->catalog_id = $row->catalog_id;
            $cat->name = $row->name;
            $cat->height = $row->height;
            $cat->parent_id = $row->parent_id;
            $cat->user_id = $row->user_id;

            $array[] = $cat;
        }//while
        return $array;
    }

//getCatalogs

    public function convert($obj) {
        $this->user_id = $obj->user_id;
        $this->username = $obj->username;
        $this->mail = $obj->mail;
        $this->password = $obj->password;
        $this->avatar = $obj->avatar;
        $this->reg_date = $obj->reg_date;
        $this->is_active = $obj->is_active;
    }

//convert

    public function lastMessageVisit($date = null) {
        global $DB;

        if (!$date) {
            if ($this->user_id) {
                $sql = "select last_visit from users_config where user_id = " . $this->user_id . " ";
                $DB->execute($sql);
                if ($DB->getNumRows() == 1) {
                    $result = $DB->getNextObject();

                    return $result->last_visit;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        } else {
            $sql = "update users_config set last_visit='" . $date . "'  where user_id = " . $this->user_id . " ";
            $DB->execute($sql);
        }
    }

    public function setUserAsInactive() {
        global $DB;
        $this->is_active = 0;
        $this->save();
        $token = generateRandomString(20);
        $DB->execute("UPDATE users_config set activation_token='" . $token . "' where user_id=" . $this->user_id);

        return $token;
    }

//setUserAsInactive

    public function setUserAsActive($token) {
        global $DB;
        $DB->execute("SELECT * FROM users_config WHERE user_id= '" . $this->user_id . "' and activation_token= '" . $token . "'");


        if ($DB->getNumRows() == 1) {

            $DB->execute("UPDATE users_config set activation_token=null where user_id=" . $this->user_id . " and activation_token='" . $token . "' ");
            $this->is_active = 1;
            $this->save();

            return true;
        } else {
            return false;
        }
    }

    /*     * **** Z POZDROWIENIAMI DLA ADAMA ***** */

    public static function finder() {
        return new self ();
    }

//setUserAsActive
    //----------------------------------------------------------------------------------------------------------------------
}

//class
?>
