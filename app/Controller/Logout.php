<?php

namespace MyApp\Controller;

class Logout extends \MyApp\Controller
{
  public function run() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $_SESSION['me'] = "";

      header('Location:http://' . SITE_URL . '/login.php');
    }
  }

}