<?php
namespace App\Controllers;

use \App;
use App\Models\Shop\Cart;

class ShopController extends AppController{

  public function __construct(){
    parent::__construct();
    $this->loadModel('Product');
    $this->loadModel('Category');

    if (!isset($_SESSION)) {
      session_start();
    }
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
    }
  }

  public function index(){
    $products = $this->Product->last();
    $categories = $this->Category->all();
    $this->render('shop.index', compact('products', 'categories'));
  }

  public function product(){
    $product = $this->Product->findWithCategory($_GET['id']);
    if($product === false){
      $this->notFound();
    }
    $this->render('shop.product', compact('product'));
  }

  public function category(){
    $category = $this->Category->find($_GET['id']);

    if($category === false){
      $this->notFound();
    }
    $products = $this->Product->lastByCategory($_GET['id']);
    $categories = $this->Category->all();

    $this->render('shop.category', compact('products', 'categories', 'category'));
  }

  public function cart(){
    $ids = array_keys($_SESSION['cart']);
    if (empty($ids)) {
      $products = array();
    }else {
      $products = App::getInstance()->getDatabase()->query('SELECT * FROM product WHERE id IN ('.implode(',', $ids).')');
    }
    $categories = $this->Category->all();
    $this->render('shop.cart', compact('products', 'categories'));
  }



  public function add(){
    if(!empty($_GET['id'])){
      $product = $this->Product->findWithCategory($_GET['id']);
      if($product === false){
        $_SESSION['flash']['danger'] = "Ce produit n'existe pas";
      }else{
        $cart = new Cart(App::getInstance()->getDatabase());
        $cart->add($product->id);
        $_SESSION['flash']['success'] = 'Le produit a bien été ajouté à votre panier';
      }
    }else{
      $_SESSION['flash']['danger'] = "Vous n'avez pas sélectionné de produit à ajouter au panier";
    }
    header("Location:" . $_SERVER['HTTP_REFERER']);
  }

  public function delete(){
    if(!empty($_GET['id'])){
      $product = $this->Product->findWithCategory($_GET['id']);
      if($product === false){
        $_SESSION['flash']['danger'] = "Ce produit n'existe pas";
      }else{
        $cart = new Cart(App::getInstance()->getDatabase());
        $cart->delete($product->id);
        $_SESSION['flash']['success'] = 'Le produit a bien été retiré de votre panier';
      }
    }else{
      $_SESSION['flash']['danger'] = "Vous n'avez pas sélectionné de produit à retirer du panier";
    }
    header("Location:" . $_SERVER['HTTP_REFERER']);
  }



}
