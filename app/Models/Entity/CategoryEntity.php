<?php
namespace App\Models\Entity;

use Core\Models\Entity\Entity;

class CategoryEntity extends Entity{

  public function getUrl(){
    return 'index.php?view=shop.category&id=' . $this->id;
  }

}
