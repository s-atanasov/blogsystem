<?php

namespace Lib;

class Auth {
	
    private static $session = null;

    private function __construct() {
        // Session lifetime = 30min
        session_set_cookie_params(1800,"/");
        session_start();
    }

    public static function get_instance() {
        static $instance = null;

        if ( null === $instance ) {
            $instance = new static();
        }

        return $instance;
    }

    public function is_logged_in() {
        if ( isset( $_SESSION['username'] ) ) {
            return true;
        }
        return false;
    }

    public function login($username, $password) {
        $db = \Lib\Database::get_instance();
        $dbconn = $db->get_db();
        
        try {
            $stmt = $dbconn->prepare('SELECT * FROM users WHERE username = :username AND password = :password LIMIT 1');
            $stmt->execute(array('username' => $username, 'password' => $password));
            
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            if($row != null){
                //echo '<pre>'.print_r($row, true).'</pre>';
                $_SESSION['username'] = $username;
                $_SESSION['userId'] = $row['Id'];

                return true;
            }

        } catch(PDOException $e) {
            echo '<p>'.$e->getMessage().'</p>';
        }

        return false;
    }

    public function logout( ) {
            session_destroy();
    } 

    public function get_logged_user() {
        if ( ! isset( $_SESSION['username'] )  ) {
            return array();
        }

        return array( 
            'username' => $_SESSION['username'], 
            'userId' => $_SESSION['userId'] 
        );

    }
}