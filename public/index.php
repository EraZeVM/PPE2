<?php
define('ROOT', dirname(__DIR__));
require ROOT . '/app/App.php';
App::load();

if(isset($_GET['view'])){
  $view = $_GET['view'];
}else{
  $view = 'app.index';
}

$view = explode('.', $view);
if($view[0] == 'admin'){
  $controller = '\App\Controllers\Admin\\' . ucfirst($view[1]) . 'Controller';
  $action = $view[2];
}else{
  $controller = '\App\Controllers\\' . ucfirst($view[0]) . 'Controller';
  $action = $view[1];
}
$controller = new $controller();
$controller->$action();
