<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Functions</title>
</head>

<body class="max-w-6xl mx-auto px-5 py-3">
	<h1 class="text-3xl font-medium">Functions</h1>

	<?php
	$names = [
		[
			"firstName" => "Ian",
			"lastName" => "Macalinao",
			"favColor" =>  "Blue",
		],

		[
			"firstName" => "John",
			"lastName" => "Doe",
			"favColor" =>  "Blue",
		],

		[
			"firstName" => "Barry",
			"lastName" => "Allen",
			"favColor" =>  "Red",
		],
	];

	function filterByColor($names)
	{
		$filteredNames = [];

		foreach ($names as $name) {
			if ($name["favColor"] === "Blue") {
				$filteredNames[] = $name;
			}
		}


		return $filteredNames;
	}


	foreach (filterByColor($names) as $name) {
		echo $name['firstName'] . $name['lastName'] . $name['favColor'] . "<br>";
	}
	?>


</body>

</html>