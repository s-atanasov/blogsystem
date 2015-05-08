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
        
        if(empty($post)){
            header('Location: ' . DX_ROOT_URL . 'posts/index');
            exit();
        }
        
        if(isset($_POST['Submit'])){
            
            $newComment = array();
            $newComment['AuthorName'] = $_POST['name'];
            $newComment['Text'] = $_POST['text'];
            $newComment['AuthorEmail'] = $_POST['email'];
            $newComment['PostId'] = $_POST['id'];
            
            $commentId = $this->model->addComment($newComment);
            
            $commentStatus = '';
            if($commentId > 0){
                $commentStatus = 'Comment added successfully';
            }else{
                $commentStatus = 'Comment fail';
            }
            
        }
        
        $username = $this->model->getUsername($post[0]['UserId']);
        
        $tags = $this->model->getTags($id);
        $comments = $this->model->getComments($id);
        
        $postTags = array();
        foreach ($tags as $tag) {
            $postTags[] = $tag['Name'];
        }
        
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
                $newPost['CreateDate'] = date("y.m.d");
                
                $tags = array();
                
                if(isset($_POST['tags'])){
                    $tagsPost = $_POST['tags'];
                    for($i = 0; $i < count($tagsPost) ;$i++) {
                        $tags[] = $tagsPost[$i];
                    }
                }

                $postId = $this->model->add($newPost,$tags);
                
                if($postId > 0){
                    header('Location: ' . DX_ROOT_URL . 'posts/index');
                    exit();
                }
                
            }else{
                $tags = $this->model->getTags();
            }
        }
        
        $template_file = DX_ROOT_DIR . $this->views_dir . 'post.php';
        
        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
    }

    public function edit($id) {
        
        if(isset($_POST['Submit'])){
            
            $updatePost = array();
            $updatePost['id'] = $_POST['Id'];
            $updatePost['title'] = $_POST['title'];
            $updatePost['text'] = $_POST['text'];
            
            $tags = array();
                
            if(isset($_POST['tags'])){
                $tagsPost = $_POST['tags'];
                for($i = 0; $i < count($tagsPost) ;$i++) {
                    $tags[] = $tagsPost[$i];
                }
            }
            
            $post = $this->model->update($updatePost,$tags);

            if($post > 0){
                header('Location: ' . DX_ROOT_URL . 'posts/index');
                exit();
            }
            $error = 'Cannot update post';
            
        }
        
        $result = '';
        if(empty($this->logged_user)){
            $result = 'Not Logged in';
        }else{
            $post = $this->model->get($id);
            $allTags = $this->model->getTags();
            $tags = $this->model->getTags($id);

            $postTags = array();
            foreach ($tags as $tag) {
                $postTags[] = $tag['Name'];
            }

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
                header('Location: ' . DX_ROOT_URL . 'posts/index');
                exit();
            }else{
                $result = 'Delete Fail';
            } 
        }
        
        
        $template_file = DX_ROOT_DIR . $this->views_dir . 'delete.php';
        
        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;

    }
}