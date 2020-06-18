<?php

namespace MyApp\Model;

class User extends \MyApp\Model
{
  public function create_user() {
    $sql = 'insert into users (name, email, password, created_at, updated_at) values (:name, :email, :password, now(), now())';
    $stmt = $this->db->prepare($sql);
    $res = $stmt->execute([
      'name' => $_POST['user_id'],
      'email' => $_POST['email'],
      'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
      ]);
    if($res === false) {
      throw new \MyApp\Exception\DuplicateEmail();
    };
  }

  public function login() {
    $sql = 'select * from users where email = :email';
    $stmt = $this->db->prepare($sql);
    $stmt->execute([
      'email' => $_POST['email']
    ]);
    $user = $stmt->fetchObject();
    if (empty($user)) {
      throw new \MyApp\Exception\WrongPasswordOrEmail();
    }
    if (!password_verify($_POST['password'], $user->password)) {
      throw new \MyApp\Exception\WrongPasswordOrEmail();
    }
    return $user;

  }
}