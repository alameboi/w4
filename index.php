<?php
define('ROOT', '/var/www/html');
include_once ROOT . '/classes/Autoloader.php';
include_once ROOT . '/router/Router.php';

Router::run();