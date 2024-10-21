<?php
// Database connection (make sure it's defined before any query)
$host = 'localhost';
$dbname = 'sm_tournament_management_system';
$username = 'root';
$password = 'tharun701';

try {
    // Establish PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

// Now you can query the database
$sqlMatches = "SELECT * FROM SPORT";
try {
    // Use PDO to prepare and execute the statement
    $stmt = $pdo->query($sqlMatches);
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
}
?>
