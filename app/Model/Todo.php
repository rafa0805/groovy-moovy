<?php

namespace MyApp\Model;

class Todo extends \MyApp\Model
{
  public function getAll() {
    $data = [];
    $sql = 'select * from pads where user_id = :user_id';
    $stmt = $this->db->prepare($sql);
    $stmt->execute([
      'user_id' => $_SESSION['me']['id']
      ]);
    $pads = $stmt->fetchAll(\PDO::FETCH_OBJ);

    foreach($pads as $pad) {
      $sql = 'select * from todos where pad_id = :pad_id';
      $stmt = $this->db->prepare($sql);
      $stmt->execute([
        'pad_id' => $pad->id
        ]);
      $todos = $stmt->fetchAll(\PDO::FETCH_OBJ);
      $pad->todos = $todos;
      $data[] = $pad;
    }
    return $data;
  }
  
  public function done_todo() {
    $sql = 'update todos set done = (done + 1) % 2  where id = :todo_id';
    $stmt = $this->db->prepare($sql);
    $stmt->execute([
      'todo_id' => $_POST['todo_id']
    ]);
    return;
  }
  
  public function create_pad() {
    $sql = 'insert into pads (title, user_id, created_at, updated_at) values (:title, :user_id, now(), now());';
    $stmt = $this->db->prepare($sql);
    $stmt->execute([
      'title' => 'New Pad',
      'user_id' => $_POST['user_id']
    ]);

    $sql = 'select * from pads where id = last_insert_id()';
    $stmt = $this->db->query($sql);
    return $stmt->fetchObject();    
  }

  public function delete_pad() {
    $sql = 'delete from todos where pad_id = :pad_id;';
    $stmt = $this->db->prepare($sql);
    $stmt->execute([
      'pad_id' => $_POST['pad_id']
    ]);
    $sql = 'delete from pads where id = :pad_id;';
    $stmt = $this->db->prepare($sql);
    $stmt->execute([
      'pad_id' => $_POST['pad_id']
    ]);
    return;    
  }

  public function create_todo() {
    $sql = 'insert into todos (content, pad_id, created_at, updated_at) values (:content, :pad_id, now(), now());';
    $stmt = $this->db->prepare($sql);
    $stmt->execute([
      'content' => $_POST['content'],
      'pad_id' => $_POST['pad_id']
    ]);

    $sql = 'select * from todos where id = last_insert_id()';
    $stmt = $this->db->query($sql);
    return $stmt->fetchObject();    
  }

  public function delete_todo() {
    $sql = 'delete from todos where id = :todo_id';
    $stmt = $this->db->prepare($sql);
    $stmt->execute([
      'todo_id' => $_POST['todo_id']
    ]);
    return;    
  }

  // public function login() {
  //   $sql = 'select * from users where email = :email';
  //   $stmt = $this->db->prepare($sql);
  //   $stmt->execute([
  //     'email' => $_POST['email']
  //   ]);
  //   $user = $stmt->fetchObject();
  //   if (empty($user)) {
  //     throw new \MyApp\Exception\WrongPasswordOrEmail();
  //   }
  //   if (!password_verify($_POST['password'], $user->password)) {
  //     throw new \MyApp\Exception\WrongPasswordOrEmail();
  //   }
  //   return $user;

  // }
}