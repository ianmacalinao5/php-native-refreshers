<?php
session_start();

$_SESSION["errors"] = [];

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
	exit("Invalid request.");
}

// sanitize
$firstName = trim($_POST["firstName"] ?? "");
$lastName  = trim($_POST["lastName"] ?? "");
$email     = trim($_POST["email"] ?? "");

// store old input
$_SESSION["old"] = $_POST;


// validation
if ($firstName === "")
	$_SESSION["errors"]["firstName"] = "First name required.";

if ($lastName === "")
	$_SESSION["errors"]["lastName"] = "Last name required.";

if ($email === "")
	$_SESSION["errors"]["email"] = "Email required.";
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
	$_SESSION["errors"]["email"] = "Invalid email format.";


// if validation fails → back to form
if (!empty($_SESSION["errors"])) {
	header("Location: /users");
	exit;
}


// pretend database save success here
// $pdo->insert(...);


// success message
$_SESSION["success"] = "User registered successfully!";

// redirect to success page OR list page
header("Location: /users");
exit;
