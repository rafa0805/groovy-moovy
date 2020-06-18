<?php

namespace MyApp\Controller;

class Login extends \MyApp\Controller
{
  public function run() {
    if ($this->isLoggedIn()) {
      header('Location:' . SITE_URL);
      exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->_login_process();
    }
  }
  
  private function _login_process() {
    $this->_validate();
    $this->_keep_posted_values();
    
    if($this->hasError()) {
      return;
    }else {
      try {
        $user = new \MyApp\Model\User;
        // 新ユーザーの登録
        $res = $user->login();
      } catch (\MyApp\Exception\WrongPasswordOrEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }
      
      session_regenerate_id(true);
      $_SESSION['me'] = [
        'id' => $res->id,
        'user_id' => $res->name,
        'email' => $res->email
      ];

      header('Location:http://' . SITE_URL);
    }
  }

  private function _keep_posted_values() {
    $this->setValues('email', $_POST['email']);
  }


  private function _validate() {
    try {
      $this->_validationRules();
    } catch(\MyApp\Exception\EmptyEmailOrPassword $e) {
      $this->setErrors('email', $e->getMessage());
    } catch(\MyApp\Exception\InvalidForm $e) {
      $this->setErrors('email', $e->getMessage());
    } 
  }

  private function _validationRules() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "Invalid Token";
      exit;
    }
    if (!isset($_POST['password']) | !isset($_POST['email'])) {
      throw new \MyApp\Exception\InvalidForm();
    }
    if (empty($_POST['password']) | empty($_POST['email'])) {
      throw new \MyApp\Exception\EmptyEmailOrPassword();
    }
  }
}