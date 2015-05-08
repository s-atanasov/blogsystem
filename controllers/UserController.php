<?php

namespace Controllers;
class UserController extends BaseController {
    
    public function __construct() {
        parent::__construct( get_class(), 'user', '/views/user/' );
    }

    public function profile() {
        
        if(empty($this->logged_user)){
            echo 'Not Logged in';
            exit;
        }
        
        $userPosts = $this->model->getPostByUserId($_SESSION['userId']);
        
        //echo '<pre>'.print_r($userPosts, true).'</pre>';
        
        
        $template_file = DX_ROOT_DIR . $this->views_dir . 'profile.php';
        
        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;

    }
    
    public function changepassword(){
        
        if(isset($_POST['Submit'])){
            
            $oldPassword = $_POST['oldPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmNewPassword'];
            
            $user = $this->model->getUser($_SESSION['username'],$oldPassword);
            //echo '<pre>'.print_r($user, true).'</pre>';
            
            if(empty($user)){
                $error_text = 'Invalid old password.';
            }else{
                if($newPassword != $confirmPassword){
                    $error_text = 'The passwords do not match.';
                }else{
                    
                    $update = $this->model->updateUserPassword($_SESSION['userId'],$confirmPassword);
                    
                    if($update == 1){
                        $error_text = 'The password is updated successfully.';
                    }else{
                        $error_text = 'The password update fail.';
                    }
                    
                }
            }
            
            
        }
        
        $template_file = DX_ROOT_DIR . $this->views_dir . 'changepassword.php';
        
        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
    }
    
}