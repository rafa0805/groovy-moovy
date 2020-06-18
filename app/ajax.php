<?php

require('../config/config.php');

$app = new \MyApp\Controller\Index();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $res = $app->driver();
    header('Content-type: application/json');
    echo json_encode($res);
    exit;
  } catch (\Exception $e) {
    header($_SERVER['SERVER_PROTOCOL']. '500 Internal Server Error', true, 500);
    echo $e->getMessage();
    exit;
  }
}