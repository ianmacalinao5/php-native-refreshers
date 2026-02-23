<?php

class UserController
{
	public function index()
	{
		global $pdo;

		$stmt = $pdo->prepare("SELECT * FROM users ORDER BY created_at DESC");
		$stmt->execute();

		return [
			"view" => __DIR__ . '/../views/user/create-user.php',
			"data" => [
				"users" => $stmt->fetchAll()
			]
		];
	}
}
