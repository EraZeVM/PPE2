<?php
namespace App\Controllers;

use \App;
use Core\Controllers\Controller;

class AppController extends Controller{

  protected $template = 'default';

  public function __construct(){
    $this->viewPath = ROOT . '/app/Views/';
    $this->loadModel('Product');
    $this->loadModel('Category');
    $this->loadModel('Order');
    $this->loadModel('Cart');
  }

  public function index(){
    $this->render('app.index');
  }

  protected function loadModel($model_name){
    $this->$model_name = App::getInstance()->getTable($model_name);
  }

}
