<?php

// Composer autoload for Twig and other dependencies
$composerAutoload = __DIR__ . '/../vendor/autoload.php';
if (file_exists($composerAutoload)) {
    require_once $composerAutoload;
}

// Autoload for controllers and models
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/controllers/' . $class . '.php',
        __DIR__ . '/models/' . $class . '.php',
        __DIR__ . '/core/' . $class . '.php',
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Register error handler
$handler = new ErrorHandler(__DIR__ . '/../logs');
$handler->register();

// Start routing
Route::start();