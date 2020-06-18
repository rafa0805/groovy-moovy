<?php

namespace MyApp\Exception;

class DuplicateEmail extends \Exception {
  protected $message = 'This Email is already registered!!!';
}