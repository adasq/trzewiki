<?php

class PDODataBase {

    private static $singleton;
    private $dbObject;

    protected function __construct() {
        $this->dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        $this->dbObject->query('SET NAMES ' . DB_CHARSET . ' COLLATE ' . DB_COLLATE);
    }

    public static function instance() {
        if (!(self::$singleton instanceof self)) {
            self::$singleton = new self ();
        }
        return self::$singleton;
    }

    public static function get() {
        return self::instance()->dbObject;
    }

    public static function to_array($resultSet) {
        while (($row = $resultSet->fetch_assoc()) != null) {
            $result [] = $row;
        }
        return $result;
    }

}

?>
