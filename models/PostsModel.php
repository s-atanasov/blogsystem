<?php

namespace Models;
class PostsModel extends \Models\BaseModel {

    public function __construct( $args = array() ) {
        parent::__construct( array(
            'table' => 'posts'
        ) );
    }
	
    public function getPosts() {
        return parent::find();
    }
    
    public function getTags($id = 0) {
        if($id == 0){
            $stmt = $this->dbconn->prepare('SELECT Id,Name FROM Tags');
            $stmt->execute();
        }else{
            $stmt = $this->dbconn->prepare('SELECT tag.Name FROM Tags as tag
                                                INNER JOIN tagsposts as tp
                                                ON tag.Id = tp.tagId
                                                WHERE tp.postId=:id');
            $stmt->execute(array('id' => $id));
        }
        
        $results = $this->process_results($stmt);

        return $results;
    }
    
    public function getUsername($userId){
        $stmt = $this->dbconn->prepare('SELECT username FROM Users WHERE Id=:id');
        $stmt->execute(array('id' => $userId));
        
        $results = $this->process_results($stmt);

        return $results;
    }
    
    public function getComments($id){
        
        $stmt = $this->dbconn->prepare('SELECT Id,Text,AuthorName,AuthorEmail FROM Comments WHERE PostId=:id
                                        ORDER BY Id DESC');
        $stmt->execute(array('id' => $id));
        
        $results = $this->process_results($stmt);

        return $results;
    }
    
    public function addComment($pairs){
        
        // Get keys and values separately
        $keys = array_keys($pairs);
        $values = array();

        // Escape values, like prepared statement
        foreach($pairs as $key => $value) {
            $newKeys[] = $key;	
            $values[] = '"' . $value . '"';
        }

        $keys = implode($newKeys, ',');
        $values = implode($values, ',');

        $stmt = $this->dbconn->query("insert into comments (".$keys.") values(".$values.")");
        
        $postId = $this->dbconn->lastInsertId();
        
        if($stmt->rowCount() > 0){
            return $postId;
        }
        return 0;
    }
    
}