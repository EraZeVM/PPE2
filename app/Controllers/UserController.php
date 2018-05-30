<?php
namespace App\Controllers;

use \App;
use Core\Models\HTML\Form;
use Core\Models\Auth\DatabaseAuth;

class UserController extends AppController{

  public function __construct(){
    parent::__construct();
  }

  public function account(){
    $auth = new DatabaseAuth(App::getInstance()->getDatabase());
    if($auth->signed()){
      $form = new Form($_POST);
      $this->render('user.account', compact('auth', 'form'));
    }
    else {
      header('Location: index.php?view=user.signin');
    }
  }

  public function myorders(){
    $auth = new DatabaseAuth(App::getInstance()->getDatabase());
    if($auth->signed()){
      $orders = $this->Order->allOrders($auth->getUserID()->id);

      $this->render('user.myorders', compact('auth', 'orders'));
    }
  }

  public function signin(){
    $auth = new DatabaseAuth(App::getInstance()->getDatabase());
    if($auth->signed()){
      header('Location: index.php?view=user.index');
    }
    if(!empty($_POST)){
      if($auth->signin($_POST['username'], $_POST['password'])){
        header('Location: index.php?view=user.index');
      }
    }
    $form = new Form($_POST);
    $this->render('user.signin', compact('form', 'auth'));
  }

  public function signup(){
    $errors = false;
    $auth = new DatabaseAuth(App::getInstance()->getDatabase());
    if($auth->signed()){
      header('Location: index.php?view=user.index');
    }
    if(!empty($_POST)){
      if($auth->signup($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_confirm'], $_POST['last_name'], $_POST['first_name'], $_POST['phone_number'])){
        $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte';
        header('Location: index.php?view=user.signin');
      }else{
        $errors = true;
      }
    }
    $form = new Form($_POST);
    $this->render('user.signup', compact('form', 'errors', 'auth'));
  }

  public function confirm(){
    $auth = new DatabaseAuth(App::getInstance()->getDatabase());
    if(!empty($_GET)){
      if($auth->confirm($_GET['id'], $_GET['token'])){
        header('Location: index.php?view=app.index');
      }else{
        header('Location: index.php?view=user.signup');
      }
    }
  }

  public function signout(){
    session_start();
    setcookie('remember', NULL, -1);
    unset($_SESSION['auth']);
    $_SESSION['flash']['success'] = 'Vous êtes maintenant déconnecté';
    header('Location: index.php?view=app.index');
  }

}
