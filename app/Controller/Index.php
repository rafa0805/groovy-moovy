<?php

namespace MyApp\Controller;

class Index extends \MyApp\Controller
{
  private $_todoModel;
  private $_TMDbModel;

  public function run() {
    if (!$this->isLoggedIn()) {
      header('Location: http://' . SITE_URL . '/login.php');
    }
  }
  
  public function getData() {
    $this->_todoModel = new \MyApp\Model\Todo();
    return $this->_todoModel->getAll();
  }
  public function getMovies() {
    $this->_TMDbModel = new \MyApp\Model\TMDb();
    return $this->_TMDbModel->getWeekly();
  }
  
  public function driver() {
    $this->_todoModel = new \MyApp\Model\Todo();
    if($_POST['token'] !== $_SESSION['token']){
      return;
    }

    switch($_POST['mode']) {
      case('done_todo'):
        return $this->_todoModel->done_todo();
      case('create_todo'):
        return $this->_todoModel->create_todo();
      case('delete_todo'):
        return $this->_todoModel->delete_todo();
      case('create_pad'):
        return $this->_todoModel->create_pad();
      case('delete_pad'):
        return $this->_todoModel->delete_pad();
      default:
        return;
    }   
  }

}