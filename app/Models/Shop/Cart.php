<?php
namespace App\Models\Shop;

use Core\Models\Database\Database;

class Cart{

  private $database;

  public function __construct(Database $database){
    $this->database = $database;
  }

  public function add($product_id){
    if (isset($_SESSION['cart'][$product_id])) {
      $_SESSION['cart'][$product_id]++;
    }else {
      $_SESSION['cart'][$product_id] = 1;
    }
  }

  public function delete($product_id){
    unset($_SESSION['cart'][$product_id]);
  }

  public function recalc(){
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
      if (isset($_POST['cart']['quantity'][$product_id])){
        $_SESSION['cart'][$product_id] = $_POST['cart']['quantity'][$product_id];
      }
    }
  }

  public function count(){
    return array_sum($_SESSION['cart']);
  }

  public function total(){
    $total = 0;
    $ids = array_keys($_SESSION['cart']);
    if (empty($ids)) {
      $products = array();
    }else {
      $products = $this->database->query('SELECT id, price FROM product WHERE id IN ('.implode(',',$ids).')');
    }
    foreach ($products as $product) {
      $total += $product->price * $_SESSION['cart'][$product->id];
    }
    return $total;
  }

}
