<?php
namespace App\Models\Table;

use Core\Models\Table\Table;

class CartTable extends Table{

  public function findAllCart($ids){
      return $this->query('
        SELECT product.id, product.title, product.img, product.price, product.description, category.title as category
        FROM product
        LEFT JOIN category ON category_id = category.id
        WHERE product.id IN ('.implode(',', $ids).')
      ');
  }

}
