<?php

namespace Models;
class RegisterModel extends \Models\BaseModel {
    
    public function __construct( $args = array() ) {
        parent::__construct( array(
            'table' => 'users'
        ) );
    }
   
    
    
    
}
