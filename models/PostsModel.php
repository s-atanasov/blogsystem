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
    
}