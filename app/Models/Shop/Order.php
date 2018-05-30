<?php
namespace App\Models\Shop;

use Core\Models\Database\Database;

class Order{

  private $database;

  public function __construct(Database $database){
    $this->database = $database;
  }

  protected function str_random($length){
    $alphabet = "123456789QWERTYUIOPASDFGHJKLZXCVBNM";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
  }

  public function addOrder($ids, $user_id, $cart){
    $reference_id = 'REF'.date('ymd').$this->str_random(6);
    $total_price = $cart->total();
    if(!empty($ids)){
      foreach($ids as $id){
        $quantity = $_SESSION['cart'][$id]['quantity'];
        $this->database->prepare('INSERT INTO orders_item SET product_id = ?, quantity = ?, reference_id = ?', [$id, $quantity, $reference_id]);
      }
      $this->database->prepare('INSERT INTO orders SET reference = ?, date = NOW(), statement = 1, total_price = ?, user_id = ?', [$reference_id, $total_price, $user_id]);
    }
  }

  public function confirmOrder(){

  }
}
