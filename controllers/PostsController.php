<?php

namespace Controllers;
class PostsController extends BaseController {
	
    

    public function __construct() {
        parent::__construct( get_class(), 'posts', '/views/posts/' );
    }

    public function index() {
        $posts = $this->model->find();

        $template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';
        
        \Lib\View::getInstance()->render($template_file, array('posts' => $posts));

    }
    
    public function view($id) {
        $post = $this->model->get($id);

        $template_file = DX_ROOT_DIR . $this->views_dir . 'view.php';
        
        \Lib\View::getInstance()->render($template_file, array('post' => $post));
        
        
    }
}