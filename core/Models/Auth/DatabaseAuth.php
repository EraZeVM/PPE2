<?php
namespace Core\Models\Auth;

use Core\Models\Database\Database;

class DatabaseAuth{

  private $database;

  public function __construct(Database $database){
      $this->database = $database;
  }

  public function str_random($length){
    $alphabet = "0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
  }

  public function getUserID(){
    if($this->signed()){
      return $_SESSION['auth'];
    }
    return false;
  }

  public function signin($username, $password){
    $user = $this->database->prepare('SELECT * FROM users WHERE (username = :username OR email = :email)', ['username' => $username, 'email' => $username], null, true);
    if($user){
      if(password_verify($password, $user->password)){
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
        return true;
      }
    }
    return false;
  }

  public function signup($username, $email, $password, $password_confirm){
    if (empty($username) || !preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
      $errors = $_SESSION['errors']['username'] = "Votre pseudo n'est pas valide";
    } else {
      $username_exists = $this->database->prepare('SELECT id FROM users WHERE username = ?', [$username], null, true);
      if ($username_exists){
        $errors = $_SESSION['errors']['username'] = "Ce pseudo est déjà pris";
      }
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors = $_SESSION['errors']['email'] = "Votre email n'est pas valide";
    } else {
      $email_exists = $this->database->prepare('SELECT id FROM users WHERE email = ?', [$email], null, true);
      if ($email_exists){
        $errors = $_SESSION['errors']['email'] = "Cet email est déjà pris pour un autre compte";
      }
    }
    if (empty($password) || $password != $password_confirm) {
      $errors = $_SESSION['errors']['password'] = "Vous devez rentrer un mot de passe valide";
    }
    if (empty($errors)) {
      $password = password_hash($password, PASSWORD_BCRYPT);
      $token = $this->str_random(60);
      $user = $this->database->prepare("INSERT INTO users SET username = ?, email = ?, password = ?, confirmation_token = ?", [$username, $email, $password, $token], null, true);
      $user_id = $this->database->lastInsertID();
      mail($email, "Confirmation de votre compte", "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttp://127.0.0.1/account/confirm.php?id={$user_id}&token={$token}");
      $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte';
      return true;
    }
    return false;
  }

  public function confirm($user_id, $token){
    $user = $this->database->prepare('SELECT * FROM users WHERE id = ?', [$user_id], null, true);

    if ($user && $user->confirmation_token == $token){
      $this->database->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?', [$user_id], null, true);
      $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
      $_SESSION['auth'] = $user;
      return true;
    }else{
      $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
      return false;
    }
  }

  public function signed(){
    return isset($_SESSION['auth']);
  }

}
