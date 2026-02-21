<?php
require '../config/database.php';

$migrationDir = __DIR__ . '/../migrations';
$files = glob($migrationDir . '/*.sql');
sort($files);

/*
|--------------------------------------------------------------------------
| Check if migrations table exists
|--------------------------------------------------------------------------
*/
$tableExists = $pdo->query("
    SELECT COUNT(*)
    FROM information_schema.tables
    WHERE table_schema = DATABASE()
    AND table_name = 'migrations'
")->fetchColumn();

$executed = [];

if ($tableExists) {
	$stmt = $pdo->query("SELECT filename FROM migrations");
	$executed = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

/*
|--------------------------------------------------------------------------
| Run migrations
|--------------------------------------------------------------------------
*/
foreach ($files as $file) {
	$name = basename($file);

	if (in_array($name, $executed)) {
		echo "Skipping: $name\n";
		continue;
	}

	echo "Running: $name\n";

	$sql = file_get_contents($file);

	try {
		$pdo->exec($sql);

		if ($tableExists) {
			$pdo->prepare("INSERT INTO migrations (filename) VALUES (?)")
				->execute([$name]);
		}

		echo "Done\n";

		// if first migration just created table
		if (!$tableExists && str_contains($name, '001')) {
			$tableExists = true;
		}
	} catch (PDOException $e) {
		echo "Failed: " . $e->getMessage() . "\n";
		exit;
	}
}
echo "All migrations completed.\n";
