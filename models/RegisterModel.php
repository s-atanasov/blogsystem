<?php

namespace Models;
class RegisterModel extends \Models\BaseModel {
    
    public function __construct( $args = array() ) {
        parent::__construct( array(
            'table' => 'users'
        ) );
    }
    
    public function register($username,$password){
        
        if($this->get_user_info($username)){
            try {
                $stmt = $this->dbconn->prepare('INSERT INTO users (username,password,role) VALUES (:username,:password,"1")');
                $stmt->execute(array('username' => $username, 'password' => md5($password)));

                if($stmt->rowCount() == 1){
                    $_SESSION['username'] = $username;
                    $_SESSION['userId'] = $this->dbconn->lastInsertId();
                
                    return true;
                }

                return false;

            } catch(PDOException $e) {
                echo '<p>'.$e->getMessage().'</p>';
            }
        }
        return false;
    }
    
    private function get_user_info($username){	

        try {
            $stmt = $this->dbconn->prepare('SELECT * FROM users WHERE username = :username');
            $stmt->execute(array('username' => $username));
            
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if(empty($row)){
                return true;
            }
            return false;

        } catch(PDOException $e) {
            echo '<p>'.$e->getMessage().'</p>';
        }
    }
    
}
