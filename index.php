<?php
ob_start();
// Define root dir and root path
define( 'DX_DS', '/' );
define( 'DX_ROOT_DIR', dirname( __FILE__ ) . DX_DS );
define( 'DX_ROOT_PATH', basename( dirname( __FILE__ ) ) . DX_DS );
define( 'DX_ROOT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/blogsystem/' );

// Bootstrap
include 'config/db.php';

// Define the request home that will always persist in REQUEST_URI
$request_home = DX_DS . DX_ROOT_PATH;

// Read the request
$request = $_SERVER['REQUEST_URI'];
$components = array();
$controller = 'Base';
$method = 'index';
$admin_routing = false;
$param = array();

include_once 'lib/database.php';
include_once 'lib/auth.php';
include_once 'lib/View.php';

include_once 'controllers/BaseController.php';

$baseController = new \Controllers\BaseController();


if (!empty($request)) {
    if(strpos($request,$request_home) === 0) {
        // Clean the request
        $request = substr($request,strlen($request_home));
        
        // Switch to admin routing
        if(strpos($request,'admin') === 0) {
            $admin_routing = true;
            include_once 'controllers/admin/admin_controller.php';
            $request = substr( $request, strlen( 'admin/' ) );
        }

        // Fetch the controller, method and params if any
        $components = explode(DX_DS,$request,3);

        // Get controller and such
        if (count($components) > 1) {
            list( $controller, $method ) = $components;

            $param = isset( $components[2] ) ? $components[2] : array();
        }
    }
}

// If the controller is found
if (isset($controller) && file_exists('controllers/' . $controller . 'Controller.php')) {
    $admin_folder = $admin_routing ? 'admin/' : '';
    include_once 'controllers/' . $admin_folder . $controller . 'Controller.php';

    // Is admin controller?
    $admin_namespace = $admin_routing ? '\Admin' : '';

    // Form the controller class
    $controller_class = $admin_namespace . '\Controllers\\' . ucfirst( $controller ) . 'Controller';

    $instance = new $controller_class();

    // Call the object and the method
    if( method_exists( $instance, $method ) ) {
            call_user_func_array(array($instance,$method),array($param));
    } else {
        // fallback to index
        call_user_func_array(array($instance,'index'), array());
    }
} else {
    $baseController->index();
}