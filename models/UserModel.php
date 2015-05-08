<?php

namespace Models;
class UserModel extends \Models\BaseModel {

    public function __construct( $args = array() ) {
        parent::__construct( array(
            'table' => 'users'
        ) );
    }
    
    public function getPostByUserId($id){
        $stmt = $this->dbconn->prepare('SELECT Id,Title,Text,UserId,CreateDate FROM posts WHERE UserId=:id');
        $stmt->execute(array('id' => $id));
        
        $results = $this->process_results($stmt);

        return $results;
    }
    
    
    public function getUser($username,$password){
        $stmt = $this->dbconn->prepare('SELECT id,username,password,email,role FROM '. $this->table .' 
                                        WHERE username=:name AND password = :pass');
        $stmt->execute(array('name' => $username, 'pass' => md5($password)));
        
        $results = $this->process_results($stmt);
        
        return $results;
    }
    
    public function updateUserPassword($userId,$password){
        $stmt = $this->dbconn->prepare('UPDATE '. $this->table .' 
                                        SET password = :pass WHERE id = :id');
        $stmt->execute(array('pass' => md5($password), 'id' => $userId));
        
        return $stmt->RowCount();
    }
    
}