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
    
    public function getTags() {
        $stmt = $this->dbconn->prepare('SELECT Id,Name FROM Tags');
        $stmt->execute();

        $results = $this->process_results($stmt);

        return $results;
    }
}