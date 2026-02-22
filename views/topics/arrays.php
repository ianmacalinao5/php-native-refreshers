<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Array</title>
</head>

<body class="max-w-6xl mx-auto px-5 py-3">
	<h1 class="text-3xl font-medium">Arrays</h1>

	<?php
	$colors = ["blue", "black", "white", "yellow", "orange"];

	foreach ($colors as $color) {
		echo $color . "<br>";
	}

	?>

	<h2 class="text-3xl font-medium mt-5">Associative Arrays</h2>

	<?php
	$names = [
		[
			"first_name" => "Ian",
			"last_name" => "Macalinao",
		],

		[
			"first_name" => "John",
			"last_name" => "Doe",
		],

		[
			"first_name" => "Barry",
			"last_name" => "Allen",
		],
	];

	echo "<pre>";
	echo htmlspecialchars('
		$names = [
			[
				"first_name" => "Ian",
				"last_name" => "Macalinao",
			],
		];
	');
	echo "</pre>";


	foreach ($names as $name) {
		echo $name['first_name'] . " " . $name['last_name'] . "<br>";
	}
	?>


</body>

</html>