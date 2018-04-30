<?php
namespace Core\Models\Database;

use \PDO;

class MySQLDatabase extends Database{

  private $db_name;
  private $db_host;
  private $db_user;
  private $db_pass;
  private $pdo;

  public function __construct($db_name, $db_host, $db_user, $db_pass){
    $this->db_name = $db_name;
    $this->db_host = $db_host;
    $this->db_user = $db_user;
    $this->db_pass = $db_pass;
  }

  private function getPDO(){
    if($this->pdo === null){
      $pdo = new PDO('mysql:dbname='. $this->db_name .';host='. $this->db_host .'', $this->db_user, $this->db_pass);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
      $this->pdo = $pdo;
    }
    return $this->pdo;
  }

  public function query($statement, $class_name = null, $one = false){
    $req = $this->getPDO()->query($statement);
    if(
      strpos($statement, 'UPDATE') === 0 ||
      strpos($statement, 'INSERT') === 0 ||
      strpos($statement, 'DELETE') === 0
    ){
      return $req;
    }
    if($class_name === null){
      $req->setFetchMode(PDO::FETCH_OBJ);
    }else{
      $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
    }
    if($one){
      $data = $req->fetch();
    }else{
      $data = $req->fetchAll();
    }
    return $data;
  }

  public function prepare($statement, $options, $class_name = null, $one = false){
    $req = $this->getPDO()->prepare($statement);
    $res = $req->execute($options);
    if(
      strpos($statement, 'UPDATE') === 0 ||
      strpos($statement, 'INSERT') === 0 ||
      strpos($statement, 'DELETE') === 0
    ){
      return $res;
    }
    if($class_name === null){
      $req->setFetchMode(PDO::FETCH_OBJ);
    }else{
      $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
    }
    if($one){
      $data = $req->fetch();
    }else{
      $data = $req->fetchAll();
    }
    return $data;
  }

  public function lastInsertID(){
    return $this->getPDO()->lastInsertId();
  }

}
