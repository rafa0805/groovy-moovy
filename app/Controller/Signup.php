<?php

namespace MyApp\Controller;

class Signup extends \MyApp\Controller
{
  public function run() {
    if ($this->isLoggedIn()) {
      header('Location:' . SITE_URL);
      exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->_signup_process();
    }
  }

  private function _signup_process() {
    $this->_validate();
    $this->_keep_posted_values();
 
    if($this->hasError()) {
      return;
    }else {
      try {
        $user = new \MyApp\Model\User;
        // 新ユーザーの登録
        $user->create_user();
      } catch (\MyApp\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }
      
      header('Location: http://' . SITE_URL . '/login.php');
    }
  }

  private function _keep_posted_values() {
    $this->setValues('user_id', $_POST['user_id']);
    $this->setValues('email', $_POST['email']);
  }


  private function _validate() {
    try {
      $this->_validationRules();
    } catch(\MyApp\Exception\InvalidUserId $e) {
      $this->setErrors('user_id', $e->getMessage());
    } catch(\MyApp\Exception\InvalidEmail $e) {
      $this->setErrors('email', $e->getMessage());
    } catch(\MyApp\Exception\InvalidPassword $e) {
      $this->setErrors('password', $e->getMessage());
    }
  }

  private function _validationRules() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "Invalid Token";
      exit;
    }
    if (!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['user_id'])) {
      throw new \MyApp\Exception\InvalidUserId();
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      throw new \MyApp\Exception\InvalidEmail();
    }
    if (!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['password'])) {
      throw new \MyApp\Exception\InvalidPassword();
    }
  }
}