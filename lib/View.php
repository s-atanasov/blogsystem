<?php

namespace Lib;
class View {

    private static $instance = null;
    private $data = array();
    protected $layout = 'default.php';

    private function __construct() {
        
    }

    public function render($template, $data=array()) {
        if (is_array($data)) {
            extract($data);
        }
        $template_file = $template;
        include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
    }

    /**
     * 
     * @return View
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new View();
        }
        return self::$instance;
    }

}
