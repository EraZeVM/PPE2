<?php
namespace Core\Models\Table;

use Core\Models\Database\Database;

class Table{

  protected $table;
  protected $database;

  public function __construct(Database $database){
    $this->database = $database;
    if(is_null($this->table)){
      $parts = explode('\\', get_class($this));
      $class_name = end($parts);
      $this->table = strtolower(str_replace('Table', '', $class_name));
    }
  }

  public function all(){
    return $this->query('SELECT * FROM ' . $this->table);
  }

  public function query($statement, $options = null, $one = false){
    if($options){
      return $this->database->prepare(
        $statement,
        $options,
        str_replace('Table', 'Entity', get_class($this)),
        $one
      );
    }else{
      return $this->database->query(
        $statement,
        str_replace('Table', 'Entity', get_class($this)),
        $one
      );
    }
  }

  public function find($id){
    return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
  }

  public function extract_list($key, $value){
    $records = $this->all();
    $return = [];
    foreach($records as $v){
      $return[$v->$key] = $v->$value;
    }
    return $return;
  }

  public function create($fields){
    $sql_parts = [];
    $attributes = [];
    foreach($fields as $k => $v){
      $sql_parts[] = "$k = ?";
      $attributes [] = $v;
    }
    $sql_part = implode(', ', $sql_parts);
    return $this->query("INSERT INTO {$this->table} SET $sql_part", $attributes, true);
  }

  public function update($id, $fields){
    $sql_parts = [];
    $attributes = [];
    foreach($fields as $k => $v){
      $sql_parts[] = "$k = ?";
      $attributes [] = $v;
    }
    $attributes[] = $id;
    $sql_part = implode(', ', $sql_parts);
    return $this->query("UPDATE {$this->table} SET $sql_part WHERE id = ?", $attributes, true);
  }

  public function delete($id){
    return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id], true);
  }

}