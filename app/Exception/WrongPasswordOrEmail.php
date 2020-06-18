<?php

namespace MyApp\Exception;

class WrongPasswordOrEmail extends \Exception {
  protected $message = 'Your Email or Password is wrong!!!';
}