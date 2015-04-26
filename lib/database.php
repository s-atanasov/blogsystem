<?php

namespace Lib;

class Database {
	
    private static $db = null;

    private function __construct() {
        // Read the config/db.php db settings
        $host = DB_HOST;
        $username = DB_USERNAME;
        $password = DB_PASSWORD;
        $database = DB_DATABASE;
        
        try {
            $db = new \PDO("mysql:host=".$host.";dbname=".$database, $username, $password);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            echo '<p style="color:red;">'.$e->getMessage().'</p>';
            exit;
        }

        //$db = new \mysqli( $host, $username, $password, $database );

        self::$db = $db;
    }

    public static function get_instance() {
        static $instance = null;

        if( null === $instance ) {
            $instance = new static();
        }

        return $instance;
    }

    public static function get_db() {
        return self::$db;
    }
}
