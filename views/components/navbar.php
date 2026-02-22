<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$defaultClass = "px-5 py-2 font-medium rounded text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition-colors duration-300 ease-in-out";

function active($uri, $path)
{
	return $uri === $path
		? "bg-gray-100 text-gray-800"
		: "";
}
?>

<nav class="py-2 flex items-center gap-3 mb-5">
	<a href="/" class="<?= $defaultClass . ' ' . active($uri, '/') ?>">Home</a>
	<a href="/users" class="<?= $defaultClass . ' ' . active($uri, '/users') ?>">Users</a>
	<a href="/arrays" class="<?= $defaultClass . ' ' . active($uri, '/arrays') ?>">Arrays</a>
	<a href="/functions" class="<?= $defaultClass . ' ' . active($uri, '/functions') ?>">Functions</a>
</nav>