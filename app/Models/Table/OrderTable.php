<?php
namespace App\Models\Table;

use Core\Models\Table\Table;

class OrderTable extends Table{

  public function allOrders($user_id){
      return $this->query('
        SELECT *
        FROM orders
        JOIN user ON orders.user_id = user.id
        WHERE orders.user_id = ?
      ', [$user_id]);
  }

}
