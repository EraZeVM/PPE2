<?php
namespace App\Models\Entity;

use Core\Models\Entity\Entity;

class OrderEntity extends Entity{

  public function getUrl(){
    return 'index.php?view=user.order&id=' . $this->id;
  }

  public function getFormat_reference(){
    return 'REF'.number_format($this->reference, 0, '', '');
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
