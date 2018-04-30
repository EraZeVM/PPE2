<?php
namespace App\Controllers;

use \App;
use Core\Models\HTML\Form;
use Core\Models\Auth\DatabaseAuth;

class UsersController extends AppController{

  public function index(){
    $this->render('users.index');
  }

  public function signin(){
    if(!empty($_POST)){
      $auth = new DatabaseAuth(App::getInstance()->getDatabase());
      if($auth->signin($_POST['username'], $_POST['password'])){
        header('Location: index.php?view=users.index');
      }
    }
    $form = new Form($_POST);
    $this->render('users.signin', compact('form'));
  }

  public function signup(){
    $errors = false;
    if(!empty($_POST)){
      $auth = new DatabaseAuth(App::getInstance()->getDatabase());
      if($auth->signup($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_confirm'])){
        $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte';
        header('Location: index.php?view=users.signin');
      }else{
        $errors = true;
      }
    }
    $form = new Form($_POST);
    $this->render('users.signup', compact('form', 'errors'));
  }

  public function confirm(){
    if(!empty($_GET)){
      $auth = new DatabaseAuth(App::getInstance()->getDatabase());
      if($auth->confirm($_GET['id'], $_GET['token'])){
        header('Location: index.php?view=app.index');
      }else{
        header('Location: index.php?view=users.signup');
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
