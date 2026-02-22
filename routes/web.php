<?php

require __DIR__ . '/../controllers/UserController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$view = null;

if ($uri === '/') $view = __DIR__ . '/../views/user/home.php';
if ($uri === '/arrays') $view = __DIR__ . '/../views/topics/arrays.php';
if ($uri === '/users') $view = (new UserController())->index();
if (!$view) $view = __DIR__ . '/../views/errors/404.php';
