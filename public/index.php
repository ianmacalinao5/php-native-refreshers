<?php
require "../config/database.php";
require "../routes/web.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Php Native Refreshers</title>
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
	<?php require $view; ?>
</body>

</html>