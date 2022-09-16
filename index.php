<?php
use NalikCo\NalikNet\App\Bootstrap;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/configs/routes.php';

$bootstrap = new Bootstrap();
$bootstrap->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);