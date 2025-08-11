<?php
declare(strict_types=1);

session_start();

define('BASE_PATH', dirname(__DIR__));
define('DATA_PATH', BASE_PATH . '/app/data');

spl_autoload_register(function ($class) {
    $path = BASE_PATH . '/app/classes/' . $class . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});
