<?php
// fetch_players.php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli('localhost', 'root', 'tharun701', 'SM_Tournament_management_system');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the sport_id from the request
$sport_id = isset($_GET['sport_id']) ? intval($_GET['sport_id']) : 0;

// Fetch players for the selected sport
$stmt = $conn->prepare("SELECT Player_id, Player_name FROM PLAYERS WHERE Sport_id = ?");
$stmt->bind_param("i", $sport_id);
$stmt->execute();
$result = $stmt->get_result();

$players = [];
while ($row = $result->fetch_assoc()) {
    $players[] = $row;
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Return the players as JSON
echo json_encode($players);
?>
