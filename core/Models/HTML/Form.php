<?php
namespace Core\Models\HTML;

class Form{

  private $data;
  public $surround = 'div';

  public function __construct($data = array()){
    $this->data = $data;
  }

  private function surround($html){
    return "<{$this->surround}>{$html}</{$this->surround}>";
  }

  private function getValue($index){
    if(is_object($this->data)){
      return $this->data->$index;
    }else{
      return isset($this->data[$index]) ? $this->data[$index] : null;
    }
  }

  public function input($name, $label, $options = []){
    $type = isset($options['type']) ? $options['type'] : 'text';
    $label = "<label>{$label}</label>";
    $value = $this->getValue($name);
    if($type === 'textarea'){
      $input = "<textarea name='{$name}'>{$value}</textarea>";
    }else{
      $input = "<input type='{$type}' name='{$name}' value='{$value}'>";
    }
    return $this->surround($label . $input);
  }

  public function select($name, $label, $options){
    $label = "<label>{$label}</label>";
    $input = "<select name='{$name}'>";
    foreach ($options as $k => $v) {
      $attributes = '';
      if($k == $this->getValue($name)){
        $attributes = 'selected';
      }
      $input .= "<option value='{$k}' {$attributes}>{$v}</option>";
    }
    $input .= "</select>";
    return $this->surround($label . $input);
  }

  public function submit($text){
    return $this->surround("<button type='submit'>{$text}</button>");
  }

}