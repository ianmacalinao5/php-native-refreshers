<?php

$userId = $_GET["userId"] ?? null;

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :userId");
$stmt->execute([':userId' => $userId]);
$user = $stmt->fetch();

if (!$user) {
	die("User not found");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit User</title>
</head>

<body class="max-w-6xl mx-auto px-5 py-3">
	<h1 class="text-3xl font-medium">Edit User</h1>

	<?php if (!empty($_SESSION["success"])): ?>
		<div class="text-green-500 bg-green-100 px-5 py-2 mt-5 w-fit rounded">
			<?= htmlspecialchars($_SESSION["success"]["update"]) ?>
		</div>
	<?php endif; ?>

	<form action="/update-user" class="mt-5" method="post">
		<div class="flex gap-2 flex-col mb-3">
			<label for="firstName">First Name:</label>
			<input type="text" name="firstName" id="firstName" placeholder="John" class="px-5 py-2 outline-none border border-gray-400 rounded w-fit"
				value="<?= htmlspecialchars($user["first_name"] ?? "") ?>">
			<span class="text-red-500 text-sm">
				<?= htmlspecialchars($_SESSION["errors"]["edit"]["firstName"] ?? "") ?>
			</span>
		</div>

		<div class="flex gap-2 flex-col mb-3">
			<label for="lastName">Last Name:</label>
			<input type="text" name="lastName" id="lastName" placeholder="Doe" class="px-5 py-2 outline-none border border-gray-400 rounded w-fit"
				value="<?= htmlspecialchars($user["last_name"] ?? "") ?>">

			<span class="text-red-500 text-sm">
				<?= htmlspecialchars($_SESSION["errors"]["edit"]["lastName"] ?? "") ?>
			</span>
		</div>

		<div class="flex gap-2 flex-col mb-3">
			<label for="email">Email:</label>
			<input type="text" name="email" id="email" placeholder="johndoe@email.com" class="px-5 py-2 outline-none border border-gray-400 rounded w-fit"
				value="<?= htmlspecialchars($user["email"] ?? "") ?>">

			<span class="text-red-500 text-sm">
				<?= htmlspecialchars($_SESSION["errors"]["edit"]["email"] ?? "") ?>
			</span>
		</div>

		<input type="hidden" name="userId" value="<?= htmlspecialchars($userId) ?>">

		<button type="submit" class="px-5 py-2 border border-gray-400 rounded hover:bg-gray-200">Update User</button>
	</form>

	<?php
	unset($_SESSION["errors"]);
	unset($_SESSION["success"]);

	?>
</body>

</html>