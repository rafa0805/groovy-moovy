<?php
ini_set('display_errors', 1);

define('DSN', 'mysql:host=us-cdbr-east-05.cleardb.net;dbname=heroku_7bc3b6edd26e187');
define('DB_USERNAME', 'b6d8d042fe52ce');
define('DB_PASSWORD', '72076159');
define('SITE_URL', $_SERVER['HTTP_HOST']);

require_once(__DIR__ . '/autoload.php');
require_once(__DIR__ . '/../app/functions.php');

session_start();