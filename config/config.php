<?php
ini_set('display_errors', 1);

define('DSN', 'mysql:dbhost=localhost;dbname=groovymoovy_db');
define('DB_USERNAME', 'app_user');
define('DB_PASSWORD', 'aaaaaa');
define('SITE_URL', $_SERVER['HTTP_HOST']);

require_once(__DIR__ . '/autoload.php');

session_start();



