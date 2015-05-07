<?php

namespace Controllers;
class RegisterController extends BaseController {
    
    public function __construct() {
        parent::__construct( get_class(), 'register', '/views/register/' );
    }
    
    public function index() {
        
        $template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';
        
        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
    }
    
    public function register(){
        $result = array();
        
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
    
}

