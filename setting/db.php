<?php
// Define constants for database connection details
define('DB_HOST', '127.0.0.1'); // Changed to localhost
define('DB_USER', 'u510162695_pig');
define('DB_PASS', '1Pigdatabase');
define('DB_NAME', 'u510162695_pig');
define('DB_PORT', '3306'); // Note: Changed to DB_PORT to align with typical naming conventions

// Attempt to connect to the database
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT;
    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('<h4 style="color:red">Incorrect Connection Details</h4>');
}
?>
