<?php

namespace MyApp\Exception;

class EmptyEmailOrPassword extends \Exception {
  protected $message = 'Fill both Email and Password!!!';
}