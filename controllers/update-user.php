<?php

$userId = $_POST["userId"] ?? null;

$_SESSION["errors"] = [];

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
	exit("Invalid request.");
}

$firstName = trim($_POST["firstName"] ?? "");
$lastName  = trim($_POST["lastName"] ?? "");
$email     = trim($_POST["email"] ?? "");

if ($firstName === "") {
	$_SESSION["errors"]["edit"]["firstName"] = "First name required.";
} elseif (preg_match('/\d/', $firstName)) {
	$_SESSION["errors"]["edit"]["firstName"] = "First name cannot contain numbers.";
}

if ($lastName === "") {
	$_SESSION["errors"]["edit"]["lastName"] = "Last name required.";
} elseif (preg_match('/\d/', $lastName)) {
	$_SESSION["errors"]["edit"]["lastName"] = "Last name cannot contain numbers.";
}

if ($email === "")
	$_SESSION["errors"]["edit"]["email"] = "Email required.";
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
	$_SESSION["errors"]["edit"]["email"] = "Invalid email format.";

if (!empty($_SESSION["errors"])) {
	header("Location: /edit-user?userId=" . $userId);
	exit;
}

try {

	$stmt = $pdo->prepare("
        UPDATE users SET first_name = :firstName, last_name = :lastName, email = :email WHERE id = :userId
    ");

	$stmt->execute([
		":firstName" => $firstName,
		":lastName"  => $lastName,
		":email"     => $email,
		":userId" => $userId,
	]);

	$_SESSION["success"]["update"] = "User updated successfully!";
	header("Location: /edit-user?userId=" . $userId);
	exit;
} catch (PDOException $e) {
	$_SESSION["errors"]["database"] = "Database error: " . $e->getMessage();
	header("Location: /edit-user?userId=" . $userId);
	exit;
}
