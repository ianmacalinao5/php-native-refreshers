<?php

$_SESSION["errors"] = [];

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
	exit("Invalid request.");
}

$firstName = trim($_POST["firstName"] ?? "");
$lastName  = trim($_POST["lastName"] ?? "");
$email     = trim($_POST["email"] ?? "");

$_SESSION["old"] = $_POST;

if ($firstName === "") {
	$_SESSION["errors"]["register"]["firstName"] = "First name required.";
} elseif (preg_match('/\d/', $firstName)) {
	$_SESSION["errors"]["register"]["firstName"] = "First name cannot contain numbers.";
}

if ($lastName === "") {
	$_SESSION["errors"]["register"]["lastName"] = "Last name required.";
} elseif (preg_match('/\d/', $lastName)) {
	$_SESSION["errors"]["register"]["lastName"] = "Last name cannot contain numbers.";
}

if ($email === "")
	$_SESSION["errors"]["register"]["email"] = "Email required.";
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
	$_SESSION["errors"]["register"]["email"] = "Invalid email format.";

if (!empty($_SESSION["errors"])) {
	header("Location: /users");
	exit;
}

try {

	$stmt = $pdo->prepare("
        INSERT INTO users (first_name, last_name, email)
        VALUES (:firstName, :lastName, :email)
    ");

	$stmt->execute([
		":firstName" => $firstName,
		":lastName"  => $lastName,
		":email"     => $email
	]);

	$_SESSION["success"]["register"] = "User registered successfully!";
	$_SESSION["old"] = [];
	header("Location: /users");
	exit;
} catch (PDOException $e) {
	$_SESSION["errors"]["database"] = "Database error: " . $e->getMessage();
	header("Location: /users");
	exit;
}
