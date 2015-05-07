<?php

namespace Controllers;
class LoginController extends BaseController {
    
    public function __construct() {
        parent::__construct( get_class(), 'login', '/views/login/' );
    }
    
    public function index() {
       
        $result = array();
        if(isset($_POST['submit'])){
            $result['Username'] = $_POST['Username'];
            $result['Password'] = $_POST['Password'];
        }
        
        $template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';
        //echo '<pre>'.print_r($result, true).'</pre>';
        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
    }
    
    public function login(){
        $result = array();
        //echo '<pre>'.print_r($_POST, true).'</pre>';
        //if(!isset($_POST['submit'])){
        //    echo 'dsdsa';
         //   exit;            
        //}
        
        $auth = \Lib\Auth::get_instance();
	//session_destroy();
        $login_text = '';
        $user = $auth->get_logged_user();
        //echo '<pre>'.print_r($user, true).'</pre>';
        if (empty($user) && isset($_POST['Username']) && isset($_POST['Password'])) {

            $logged_in = $auth->login($_POST['Username'], $_POST['Password']);

            if (!$logged_in) {
                $login_text = 'Login not successful.';
            } else {
                $login_text = 'Login was successful! Hi ' . $_POST['Username'];
                header('Location: ' . DX_ROOT_URL . 'posts/index');
                exit();
            }
        }

        $template_file = DX_ROOT_DIR . $this->views_dir . 'login.php';

        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
    }
    
    public function logout() {
        $auth = \Lib\Auth::get_instance();

        $auth->logout();

        header('Location: ' . DX_ROOT_URL);
        exit();
    }
    
    public function register(){
        
        
        $template_file = DX_ROOT_DIR . $this->views_dir . 'register.php';

        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
    }
    
}

