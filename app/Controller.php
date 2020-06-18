<?php

namespace MyApp;

use stdClass;

class Controller
{
  private $_values;
  private $_errors;

  public function __construct() {
    $this->_generate_token();
    $this->_values = new \stdClass;
    $this->_errors = new \stdClass;
  }

  protected function isLoggedIn() {
    return isset($_SESSION['me']) && !empty($_SESSION['me']) ? true : false;
  }

  protected function _generate_token() {
    if (!isset($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }
  }

  protected function setValues($key, $value) {
    $this->_values->$key = $value;
  }
  public function getValues($key) {
    return isset($this->_values->$key) ? $this->_values->$key : '';
  }
  protected function setErrors($key, $error) {
    $this->_errors->$key = $error;
  }
  public function getErrors($key) {
    return isset($this->_errors->$key) ? $this->_errors->$key : '';
  }

  protected function hasError() {
    return !empty(get_object_vars($this->_errors)) ? true : false;
  }
}