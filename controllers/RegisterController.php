<?php

namespace Controllers;
class RegisterController extends BaseController {
    
    public function __construct() {
        parent::__construct( get_class(), 'register', '/views/register/' );
    }
    
    public function index() {
        
        if(isset($_GET['error'])){
            $login_text = $_GET['error'];
        }
        
        $template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';
        
        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
    }
    
    public function register(){
        $result = array();
        
        $username = addslashes($_POST['Username']);
        $password = addslashes($_POST['Password']);
        $confirmPassword = addslashes($_POST['ConfirmPassword']);
        
        $auth = \Lib\Auth::get_instance();
        $login_text = '';
        $user = $auth->get_logged_user();
        //var_dump($username);
        //echo '<pre>'.print_r($username, true).'</pre>';
        //exit;
        if (empty($user) && !empty($username) && !empty($password) && !empty($confirmPassword) && $password == $confirmPassword) {
            
            $register = $this->model->register($username,$password);

            if (!$register) {
                $login_text = 'Register not successful.';
                header('Location: ' . DX_ROOT_URL . 'register/index?error='.$login_text);
                exit();
            } else {
                header('Location: ' . DX_ROOT_URL . 'posts/index');
                exit();
            }
        }else{
            $login_text = 'Data is missing or the passwords do not match.';
            header('Location: ' . DX_ROOT_URL . 'register/index?error='.$login_text);
            exit(); 
        }
        
    }
    
}

