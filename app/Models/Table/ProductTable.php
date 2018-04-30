<?php
namespace App\Models\Table;

use Core\Models\Table\Table;

class ProductTable extends Table{

  public function last(){
      return $this->query("
        SELECT product.id, product.title, product.img, product.price, product.description, category.title as category
        FROM product
        LEFT JOIN category ON category_id = category.id
        ORDER BY product.date DESC
      ");
  }

  public function findWithCategory($id){
      return $this->query("
        SELECT product.id, product.title, product.img, product.price, product.description, category.title as category
        FROM product
        LEFT JOIN category ON category_id = category.id
        WHERE product.id = ?
      ", [$id], true);
  }

  public function lastByCategory($category_id){
    return $this->query("
      SELECT product.id, product.title, product.img, product.price, product.description, category.title as category
      FROM product
      LEFT JOIN category ON category_id = category.id
      WHERE product.category_id = ?
      ORDER BY product.date DESC
    ", [$category_id]);
  }

}
