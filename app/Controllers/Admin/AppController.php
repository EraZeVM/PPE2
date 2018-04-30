<?php
namespace App\Controllers\Admin;

use \App;
use Core\Models\Auth\DatabaseAuth;

class AppController extends \App\Controllers\AppController{

  public function __construct(){
    parent::__construct();
    $app = App::getInstance();
    $auth = new DatabaseAuth($app->getDatabase());
    if(!$auth->signed()){
      $this->forbidden();
    }
  }

}
