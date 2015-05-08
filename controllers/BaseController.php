<?php

namespace Controllers;

class BaseController {
	
    protected $layout = 'default.php';

    protected $views_dir =  '/views/base/';

    protected $model = null;

    protected $class_name = null;

    protected $logged_user = array();

    public function __construct( $class_name = '\Controllers\BaseController', $model = 'Base', $views_dir = '/views/base/' ) {
        // Get caller classes
        $this->class_name = $class_name;

        $this->model = $model;
        $this->views_dir = $views_dir;

        include_once DX_ROOT_DIR . "models/" . ucfirst($model) . "Model.php";
        $model_class = "\Models\\" . ucfirst($model) . "Model";  

        $this->model = new $model_class( array( 'table' => 'none' ) );

        $logged_user = \Lib\Auth::get_instance()->get_logged_user();
        $this->logged_user = $logged_user;
        //echo '<pre>'.print_r($this->logged_user, true).'</pre>';
    }

    public function index() {
        $template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';

        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
    }
	
}