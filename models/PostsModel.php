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
}