<?php

require __DIR__ . '/../controllers/UserController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/') ?: '/';
$method = $_SERVER['REQUEST_METHOD'];

$routes = [

	"GET" => [
		"/" => __DIR__ . '/../views/user/home.php',
		"/arrays" => __DIR__ . '/../views/topics/arrays.php',
		"/functions" => __DIR__ . '/../views/topics/functions.php',
		"/users" => [UserController::class, "index"],
		"/register" => __DIR__ . '/../views/user/register.php',
		"/edit-user" => __DIR__ . '/../views/user/edit-user.php',
	],

	"POST" => [
		"/register" => __DIR__ . '/../controllers/register.php',
		"/delete-user" => __DIR__ . '/../controllers/delete-user.php',
		"/update-user" => __DIR__ . '/../controllers/update-user.php',
	]
];

$route = $routes[$method][$uri] ?? null;

if (!$route) {
	$content = __DIR__ . '/../views/errors/404.php';
	return;
}

if (is_array($route)) {
	[$class, $action] = $route;
	$result = (new $class)->$action();
} else {
	$result = $route;
}

if (is_array($result)) {
	extract($result["data"]);
	$content = $result["view"];
} else {
	$content = $result;
}
