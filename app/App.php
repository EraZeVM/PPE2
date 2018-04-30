<?php
use Core\Config;
use Core\Models\Database\MySQLDatabase;

class App{

  public $title = 'Lagger.fr';
  private static $_instance;
  private $database_instance;

  public static function getInstance(){
    if(is_null(self::$_instance)){
      self::$_instance = new App();
    }
    return self::$_instance;
  }

  public static function load(){
    session_start();
    require ROOT . '/app/Autoloader.php';
    App\Autoloader::register();
    require ROOT . '/core/Autoloader.php';
    Core\Autoloader::register();
  }

  public static function getTitle(){
    return self::$title;
  }

  public static function setTitle($title){
    self::$title = $title . ' | ' . self::$title;
  }

  public function getTable($name){
    $class_name = '\\App\\Models\\Table\\' . ucfirst($name) . 'Table';
    return new $class_name($this->getDatabase());
  }

  public function getDatabase(){
    $config = Config::getInstance(ROOT . '/config/config.php');
    if(is_null($this->database_instance)){
      $this->database_instance = new MySQLDatabase($config->get('db_name'), $config->get('db_host'), $config->get('db_user'), $config->get('db_pass'));
    }
    return $this->database_instance;
  }

}