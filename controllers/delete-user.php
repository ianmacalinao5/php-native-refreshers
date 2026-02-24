<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
	exit("Invalid request.");
}

$userId = $_POST["userId"] ?? null;

if (!$userId || !is_numeric($userId)) {
	exit("Invalid user ID.");
}

$stmt = $pdo->prepare("DELETE FROM users WHERE id = :userId");
$stmt->execute([":userId" => $userId]);

header("Location: /users");
exit;
