<?php
namespace App\Models\Entity;

use Core\Models\Entity\Entity;

class ProductEntity extends Entity{

  public function getUrl(){
    return 'index.php?view=shop.product&id=' . $this->id;
  }

  public function getExtract(){
    $html = '<p>' . number_format($this->price, 2, ',', ' ') . '€</p>';
    $html .= '<p>' . substr($this->description, 0, 100) . '...</p>';
    $html .= '<p><a href="' . $this->getUrl() . '">Voir la suite</a></p>';
    return $html;
  }

  public function getFormat_title(){
    return $this->getSubstr($this->title, 20);
  }

  public function getFormat_price(){
    return number_format($this->price, 2, ',', ' ') . '	EUR';
  }

  public function getFormat_category(){
    return $this->getSubstr($this->category, 40);
  }

  public function getSubstr($text, $length){
   if(strlen($text) <= $length){
     return $text;
   }
   return substr($text, 0, $length).'...';
  }

}
