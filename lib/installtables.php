<?php

include 'DataBase.class.php';
include 'functions.php';





function installTables(){

	//połączenie do BD:
	$DB = new DataBase();
		
	//USUWAMY:
	
	//widoki
	$sql = "DROP VIEW IF EXISTS groupsView;";
	$DB->execute($sql);
	$sql = "DROP VIEW IF EXISTS friendsView;";
	$DB->execute($sql);
	
	//triggery
	$sql = "DROP trigger delete_tags";
	$DB->execute($sql);
	$sql = "DROP trigger delete_links";
	$DB->execute($sql);


	//tabele:
	$sql = "DROP TABLE IF EXISTS users_config;";
	$DB->execute($sql);
	$sql = "DROP TABLE IF EXISTS friends;";
	$DB->execute($sql);
	$sql = "DROP TABLE IF EXISTS groups_membership;";
	$DB->execute($sql);
	$sql = "DROP TABLE IF EXISTS links_sub;";
	$DB->execute($sql);
	$sql = "DROP TABLE IF EXISTS watch_later;";
	$DB->execute($sql);
	$sql = "DROP TABLE IF EXISTS link_tags;";
	$DB->execute($sql);
	$sql = "DROP TABLE IF EXISTS links_owners;";
	$DB->execute($sql);
	$sql = "DROP TABLE IF EXISTS tags;";
	$DB->execute($sql);
	$sql = "DROP TABLE IF EXISTS catalogs;";
	$DB->execute($sql);
	$sql = "DROP TABLE IF EXISTS groups;";
	$DB->execute($sql);
	$sql = "DROP TABLE IF EXISTS users;";
	$DB->execute($sql);
	$sql = "DROP TABLE IF EXISTS links;";
	$DB->execute($sql);
	
	//TWORZYMY:
	//----------------------------------------------------------------
	$sql = "CREATE TABLE users(
			user_id 		int(20) NOT NULL auto_increment,
			username	varchar(32)  NOT NULL default '',
			mail		varchar(128) NOT NULL default '',
			password	varchar(64) NOT NULL default '',
			avatar		varchar(64) NOT NULL default '',
			reg_date 	datetime NOT NULL,
			is_active tinyint(1) NOT NULL default '0',
			PRIMARY KEY  (user_id),
			UNIQUE KEY (username)
			)ENGINE = InnoDB;
			";

	echo '<br/>users: '.$DB->execute($sql);
	//----------------------------------------------------------------
	$sql = "CREATE TABLE users_config(
			uc_id 		int(20) NOT NULL auto_increment,
			user_id 		int(20) NOT NULL,
			hash	varchar(64) NOT NULL,
			activation_token	varchar(32) NULL,
			last_visit 	datetime NOT NULL,
			PRIMARY KEY uc_id (uc_id),
			UNIQUE KEY user_id (user_id),
			FOREIGN KEY (user_id) REFERENCES users (user_id)
			)ENGINE = InnoDB;
			";
	echo '<br/>users_config: '.$DB->execute($sql);
	//----------------------------------------------------------------
	$sql = "CREATE TABLE friends(
			friend_id		int(20) NOT NULL auto_increment,
			user1 		int(20) NOT NULL,
			user2 		int(20) NOT NULL,
			mode		int(20) NOT NULL,
			last_activity	datetime NOT NULL,
			PRIMARY KEY friend_id (friend_id),
			UNIQUE KEY user_id (user1, user2),
			FOREIGN KEY (user1) REFERENCES users (user_id),
			FOREIGN KEY (user2) REFERENCES users (user_id)			
			)ENGINE = InnoDB;
			";

	echo '<br/>friends: '.$DB->execute($sql);
	//----------------------------------------------------------------
	$sql = "CREATE TABLE groups(
			group_id 		int(20) NOT NULL auto_increment,
			group_name 		varchar(32) NOT NULL,
			author_id		 int(20) NOT NULL,
			description		varchar(160) NULL,
			image			varchar(40) NULL,
			create_date		datetime NOT NULL,
			PRIMARY KEY group_id (group_id),
			UNIQUE KEY group_name (group_name),
			FOREIGN KEY (author_id) REFERENCES users (user_id)	
			)ENGINE = InnoDB;
			";

	echo '<br/>groups: '.$DB->execute($sql);
	//----------------------------------------------------------------

	$sql = "CREATE TABLE groups_membership(
			gm_id 		int(20) NOT NULL auto_increment,
			user_id 		int(20) NOT NULL,
			group_id 		int(20) NOT NULL,
			mode			int(20) NOT NULL,
			last_activity		datetime NOT NULL,
			PRIMARY KEY gm_id (gm_id),
			UNIQUE KEY groupUser (user_id, group_id),
			FOREIGN KEY (user_id) REFERENCES users (user_id),
			FOREIGN KEY (group_id) REFERENCES groups (group_id)	
			)ENGINE = InnoDB;
			";
	
	echo '<br/>groups_membership: '.$DB->execute($sql);
	
	//----------------------------------------------------------------
	$sql = "CREATE TABLE links(
			link_id 		int(20) NOT NULL auto_increment,
			url 		varchar(255) NOT NULL,
			description varchar(255) NULL,
			UNIQUE KEY same (url),
			PRIMARY KEY (link_id)
			)ENGINE = InnoDB;
			";

	echo '<br/>links: '.$DB->execute($sql);
	//----------------------------------------------------------------
	$sql = "CREATE TABLE links_sub(
			ls_id 		int(20) NOT NULL auto_increment,
			link_id		int(20) NOT NULL,
			author_id	int(20) NOT NULL,
			target		int(20) NULL,
			mode		int(20) NOT NULL,
			last_activity		datetime NOT NULL,	
			PRIMARY KEY (ls_id),
			UNIQUE KEY same (link_id, author_id, target, mode),
			FOREIGN KEY (link_id) REFERENCES links (link_id),
			FOREIGN KEY (author_id) REFERENCES users (user_id)		
			)ENGINE = InnoDB;
			";

	echo '<br/>links_sub: '.$DB->execute($sql);
	//----------------------------------------------------------------

	$sql = "CREATE TABLE watch_later(
			wl_id 		int(20) NOT NULL auto_increment,
			user_id 		int(20) NOT NULL,
			link_id 		int(20) NOT NULL,
			date			datetime NOT NULL,
			PRIMARY KEY wl_id (wl_id),
			FOREIGN KEY (link_id) REFERENCES links (link_id),
			FOREIGN KEY (user_id) REFERENCES users (user_id)	
			)ENGINE = InnoDB;
			";
	
	echo '<br/>watch_later: '.$DB->execute($sql);
	//----------------------------------------------------------------
	
	$sql = "CREATE TABLE catalogs(
			catalog_id 		int(20) NOT NULL auto_increment,
			name 			varchar(32) NOT NULL,
			height 			int(10) NOT NULL,
			parent_id		int(20) NULL,
			user_id			int(20) NOT NULL,
			PRIMARY KEY  (catalog_id),
			UNIQUE KEY the_same (name, parent_id, user_id),
			FOREIGN KEY (user_id) REFERENCES users (user_id)	
			)ENGINE = InnoDB;
			";
	
	echo '<br/>catalogs: '.$DB->execute($sql);
	//----------------------------------------------------------------
	
	$sql = "CREATE TABLE links_owners(
			lo_id 			int(20) NOT NULL auto_increment,
			link_id 		int(20) NOT NULL,
			user_id 		int(20) NOT NULL,
			catalog_id 		int(20) NOT NULL,
			date			datetime NOT NULL,
			UNIQUE KEY same (link_id, catalog_id, user_id),
			PRIMARY KEY (lo_id),
			FOREIGN KEY (link_id) REFERENCES links (link_id),
			FOREIGN KEY (user_id) REFERENCES users (user_id),	
			FOREIGN KEY (catalog_id) REFERENCES catalogs (catalog_id)			
			)ENGINE = InnoDB;
			";

	echo '<br/>links_owners: '.$DB->execute($sql);
	//----------------------------------------------------------------
	$sql = "CREATE TABLE tags(
			tag_id 			int(20) NOT NULL auto_increment,
			tag_name		varchar(255) NOT NULL,
			PRIMARY KEY (tag_id),
			UNIQUE KEY tag_name (tag_name)
			)ENGINE = InnoDB;
			";

	echo '<br/>tags: '.$DB->execute($sql);
	//----------------------------------------------------------------
	$sql = "CREATE TABLE link_tags(
			tag_id 			int(20) NOT NULL,
			lo_id		int(20) NOT NULL,
			FOREIGN KEY (tag_id) REFERENCES tags (tag_id),
			FOREIGN KEY (lo_id) REFERENCES links_owners (lo_id)
			)ENGINE = InnoDB;
			";

	echo '<br/>link_tags: '.$DB->execute($sql);
	//----------------------------------------------------------------
	//TRIGGERY:
	//----------------------------------------------------------------
	$sql = "
			CREATE
			TRIGGER delete_tags
			BEFORE DELETE ON links_owners
			FOR EACH ROW
			BEGIN
			DELETE FROM link_tags
			WHERE (lo_id = OLD.lo_id);
			END
			";

	echo '<br/>trigger delete_tags: '.$DB->execute($sql);
	//----------------------------------------------------------------
	$sql = "
			CREATE
			TRIGGER delete_links
			BEFORE DELETE ON catalogs
			FOR EACH ROW
			BEGIN
			DELETE FROM links_owners
			WHERE (catalog_id = OLD.catalog_id) and (user_id = OLD.user_id);
			END
			";
	
	echo '<br/>trigger delete_links: '.$DB->execute($sql);
	//----------------------------------------------------------------
	$sql= "CREATE VIEW friendsView AS SELECT f.*, u1.username as user1n, u2.username as user2n 
			FROM friends as f, users as u1, users as u2 
			WHERE u1.user_id = user1 and u2.user_id=user2";
	echo '<br/>friendsView: '.$DB->execute($sql);
	//----------------------------------------------------------------
	$sql= "CREATE VIEW groupsView as
			SELECT g.*, u.username as author_name, (select COUNT(*) 
			FROM groups_membership as gm 
			WHERE gm.group_id = g.group_id and gm.mode=1) as count
			FROM groups as g, users as u
			WHERE u.user_id = g.author_id
			";
	echo '<br/>groupsView: '.$DB->execute($sql);
	//----------------------------------------------------------------	
	//----------------------------------------------------------------	
	//----------------------------------------------------------------
	echo '<br/><br/><br/>';
	
	//nowi użytkownicy
	echo 'user: '.$DB->execute("insert into users values (null, 'user1', 'user1@gmail.com', '".getPasswordHash("password")."', 'user_default_100x100.png','".datetime()."', '1')");
	echo 'config: '.$DB->execute("insert into users_config values ( null, ".$DB->getLastId().", '".getPasswordHash("user1".generateRandomString(5))."',null, '".datetime()."' )");

	echo 'user: '.$DB->execute("insert into users values (null, 'user2', 'user2@gmail.com', '".getPasswordHash("password")."', 'user_default_100x100.png', '".datetime()."', '1')");
	echo 'config: '.$DB->execute("insert into users_config values ( null, ".$DB->getLastId().", '".getPasswordHash("user2".generateRandomString(5))."',null, '".datetime()."' )");
	
	echo 'user: '.$DB->execute("insert into users values (null, 'user3', 'user3@gmail.com', '".getPasswordHash("password")."', 'user_default_100x100.png', '".datetime()."', '1')");
	echo 'config: '.$DB->execute("insert into users_config values ( null, ".$DB->getLastId().", '".getPasswordHash("user3".generateRandomString(5))."',null, '".datetime()."' )");
	
	echo 'user: '.$DB->execute("insert into users values (null, 'user4', 'user4@gmail.com', '".getPasswordHash("password")."', 'user_default_100x100.png', '".datetime()."', '1')");
	echo 'config: '.$DB->execute("insert into users_config values ( null, ".$DB->getLastId().", '".getPasswordHash("user4".generateRandomString(5))."',null, '".datetime()."' )");

	
	//katalogi user1
	//	catalog_id	name	height	parent_id	user_id
	echo 'catalogs '.$DB->execute("insert into catalogs values (null, 'informatyka', 0, null, 1)");
	echo 'catalogs '.$DB->execute("insert into catalogs values (null, 'chemia', 0, null, 1)");

	
	//group_id	group_name	author_id	description	image	create_date
	//gm_id	user_id	group_id	mode	last_activity
	
	//user1 autorem grupy1
	echo 'groups: '.$DB->execute("insert into groups values (null, 'grupa1', 1, 'to jest przykładowy opis grupy', 'groups_default_100x100.png', '".datetime()."')");
	echo 'groups_membership: '.$DB->execute("insert into groups_membership values (null,1, 1,1, '".date("Y-m-d H:i:s")."')");
	
	echo 'groups_membership: '.$DB->execute("insert into groups_membership values (null,2, 1,1, '".date("Y-m-d H:i:s")."')");
	echo 'groups_membership: '.$DB->execute("insert into groups_membership values (null,3, 1,1, '".date("Y-m-d H:i:s")."')");


	


}


installTables();






?>