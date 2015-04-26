<?php

namespace Controllers;
class PostsController extends BaseController {
    
    public function __construct() {
        parent::__construct( get_class(), 'posts', '/views/posts/' );
    }

    public function index() {
        $posts = $this->model->find();

        $template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';
        
        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;

    }
    
    public function view($id) {
        $post = $this->model->get($id);

        $template_file = DX_ROOT_DIR . $this->views_dir . 'view.php';
        
        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;

    }
    
    public function post(){
        
        $result = '';
        if(empty($this->logged_user)){
            $result = 'Not Logged in';
        }else{
            
            if(isset($_POST['title']) && isset($_POST['text'])){
                
                $newPost = array();
                $newPost['Title'] = $_POST['title'];
                $newPost['Text'] = $_POST['text'];
                $newPost['UserId'] = $_SESSION['userId'];
                //$newPost['CreateDate'] = date("m.d.y");
                
                $postId = $this->model->add($newPost);
                
                if($postId > 0){
                    header('Location: ' . DX_ROOT_URL . 'posts');
                    exit();
                }
                
            }
        }
        
        $template_file = DX_ROOT_DIR . $this->views_dir . 'post.php';
        
        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
    }

    public function edit($id) {
        
        $result = '';
        if(empty($this->logged_user)){
            $result = 'Not Logged in';
        }else{
            $post = $this->model->get($id);
        }
        

        $template_file = DX_ROOT_DIR . $this->views_dir . 'edit.php';
        
        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;

    }
    
    public function delete($id) {
        
        $result = '';
        if(empty($this->logged_user)){
            $result = 'Not Logged in';
        }else{
           $post = $this->model->delete($id);
        
            if($post > 0){
                $result = 'Delete successfull';
            }else{
                $result = 'Delete Fail';
            } 
        }
        
        
        $template_file = DX_ROOT_DIR . $this->views_dir . 'delete.php';
        
        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;

    }
}