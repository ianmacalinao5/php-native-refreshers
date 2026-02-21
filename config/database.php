<?php

require_once __DIR__ . '/env.php';

$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$db   = $_ENV['DB_DATABASE'];
$user = $_ENV['DB_USERNAME'];
$pass = $_ENV['DB_PASSWORD'];

try {
	$pdo = new PDO(
		"mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4",
		$user,
		$pass,
		[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
	);
} catch (PDOException $e) {
	die("Database connection failed: " . $e->getMessage());
}
