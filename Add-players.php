<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Delete Players</title>
    <link rel="stylesheet" href="assets/style1.css">
    <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
            <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(to right, #ff6a00, #ee0979); /* Bright orange to pink */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form-container {
        background-color: rgba(255, 255, 255, 0.9);
        color: black;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        width: 400px;
        transition: transform 0.3s ease;
    }

    .form-container:hover {
        transform: scale(1.02);
    }

    .form-container h2 {
        margin-bottom: 20px;
        font-size: 28px;
        text-align: center;
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #6bc1ff;
        outline: none;
    }

    .form-group button {
        width: 100%;
        padding: 12px;
        background-color: #6bc1ff;
        border: none;
        color: white;
        border-radius: 8px;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .form-group button:hover {
        background-color: #5ca8e6;
        transform: translateY(-2px);
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .action-buttons button {
        width: 48%;
        padding: 10px;
        background-color: #6bc1ff;
        border: none;
        color: white;
        border-radius: 8px;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .action-buttons button:hover {
        background-color: #5ca8e6;
    }

    .delete-mode {
        background-color: #ff6b6b;
    }

    .delete-mode:hover {
        background-color: #ff3d3d;
    }

    
</style>
</head>
<body>
<div class="scrolling-bar"></div>
<header>
        <h2 class="logo"><img src="assets/img/logo.png" alt="Website logo"></h2>
        <ul>
            <li><i class="fa-solid fa-house"></i><a href="index2.html">Home</a></li>
            <li class="events-dropdown">
                <i class="fa-solid fa-calendar-days"></i>
                <a href="#view">View <i class="fa-solid fa-chevron-down dropdown-arrow"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="olympics_2024.php">Olympics 2024</a></li>
                    <li><a href="#wimbledon">Wimbledon 2024</a></li>
                    <li><a href="#badminton">World Badminton Championship 2018</a></li>
                    <li><a href="#archery">Archery World Cup 2021</a></li>
                    <li><a href="#shooting">Shooting World Cup 2019</a></li>
                    <li><a href="#table">Table Tennis World Cup 2021</a></li>
                </ul>
            </li>
            <li><a href="edit.html">Edit</a></li>
            <li><a href="sponsors.html">Sponsors</a></li>
            <li class="user-dropdown">
                <a href="javascript:void(0);" id="user-icon"><i class="fa-regular fa-user"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#username">Hi, <span id="display-username">Admin</span> 👋</a></li>
                    <li><a href="help.html">Help</a></li>
                    <li><button id="logout-button">Log Out</button></li>
                </ul>
            </li>
        </ul>
    </header>
    <div class="form-container">
        <h2 id="form-title">Add New Player</h2>
        
        <div class="action-buttons">
            <button id="add-btn" onclick="switchMode('add')">Add</button>
            <button id="delete-btn" class="delete-mode" onclick="switchMode('delete')">Delete</button>
        </div>

        <form action="Add-players.php" method="POST" id="player-form">
            <div class="form-group" id="player-id-group">
                <label for="player_id">Player ID:</label>
                <input type="number" id="player_id" name="player_id" min="0" required>
            </div>
            <div class="form-group" id="player-name-group">
                <label for="player_name">Player Name:</label>
                <input type="text" id="player_name" name="player_name" required>
            </div>
            <div class="form-group" id="sport-id-group">
                <label for="sport_id">Sport:</label>
                <select id="sport_id" name="sport_id" required>
                    <?php
                    // Database connection
                    $conn = new mysqli('localhost', 'root', 'tharun701', 'SM_Tournament_management_system');

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch sports for the dropdown
                    $result = $conn->query("SELECT Sport_id, Sport_name FROM SPORT");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['Sport_id'] . "'>" . $row['Sport_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group" id="region-id-group">
                <label for="region_id">Region:</label>
                <select id="region_id" name="region_id" required>
                    <?php
                    // Fetch regions for the dropdown
                    $result = $conn->query("SELECT Region_id, Region_name FROM REGION");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['Region_id'] . "'>" . $row['Region_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" id="submit-btn" name="submit_add">Add Player</button>
                <button type="submit" id="submit-delete-btn" name="submit_delete" style="display:none;">Delete Player</button>
            </div>
        </form>
    </div>

    <script>
        // JavaScript to switch between Add and Delete modes
        function switchMode(mode) {
            const formTitle = document.getElementById('form-title');
            const playerIdGroup = document.getElementById('player-id-group');
            const playerNameGroup = document.getElementById('player-name-group');
            const sportIdGroup = document.getElementById('sport-id-group');
            const regionIdGroup = document.getElementById('region-id-group');
            const addButton = document.getElementById('submit-btn');
            const deleteButton = document.getElementById('submit-delete-btn');

            if (mode === 'add') {
                formTitle.textContent = 'Add New Player';
                playerIdGroup.style.display = 'block';
                playerNameGroup.style.display = 'block';
                sportIdGroup.style.display = 'block';
                regionIdGroup.style.display = 'block';
                addButton.style.display = 'inline-block';
                deleteButton.style.display = 'none';
                document.getElementById('player-form').reset(); // Reset form
            } else {
                formTitle.textContent = 'Delete Player';
                playerIdGroup.style.display = 'none'; // Hide Player ID for deletion
                playerNameGroup.style.display = 'block'; // Show Player Name for deletion
                sportIdGroup.style.display = 'none'; // Hide Sport ID
                regionIdGroup.style.display = 'none'; // Hide Region ID
                addButton.style.display = 'none';
                deleteButton.style.display = 'inline-block';
                document.getElementById('player-form').reset(); // Reset form
            }
        }
    </script>

    <?php
    // Add Player
    if (isset($_POST['submit_add'])) {
        // Get the form data
        $player_id = $_POST['player_id'];
        $player_name = $_POST['player_name'];
        $sport_id = $_POST['sport_id'];
        $region_id = $_POST['region_id'];

        // Ensure player_id is non-negative
        if ($player_id < 0) {
            echo "<script>alert('Player ID must be non-negative.');</script>";
        } else {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO PLAYERS (Player_id, Player_name, Sport_id, Region_id) VALUES (?, ?, ?, ?)");
            
            // Check if the statement was prepared successfully
            if ($stmt === false) {
                die("MySQL prepare error: " . $conn->error);
            }

            $stmt->bind_param("isii", $player_id, $player_name, $sport_id, $region_id);

            // Execute the query
            if ($stmt->execute()) {
                echo "<script>alert('New player added successfully!');</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }

            // Close the statement
            $stmt->close();
        }
    }

    // Delete Player
    if (isset($_POST['submit_delete'])) {
        // Get Player Name from the form
        $player_name = $_POST['player_name'];

        // Check if player exists
        $check_stmt = $conn->prepare("SELECT Player_name FROM PLAYERS WHERE Player_name = ?");
        
        // Check if the statement was prepared successfully
        if ($check_stmt === false) {
            die("MySQL prepare error: " . $conn->error);
        }

        $check_stmt->bind_param("s", $player_name);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            // Prepare and bind the delete query
            $stmt = $conn->prepare("DELETE FROM PLAYERS WHERE Player_name = ?");
            
            // Check if the statement was prepared successfully
            if ($stmt === false) {
                die("MySQL prepare error: " . $conn->error);
            }

            $stmt->bind_param("s", $player_name);

            // Execute the delete query
            if ($stmt->execute()) {
                echo "<script>alert('Player deleted successfully!');</script>";
            } else {
                echo "<script>alert('Error deleting player: " . $stmt->error . "');</script>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<script>alert('Player name does not exist.');</script>";
        }

        // Close the check statement
        $check_stmt->close();
    }

    // Close the database connection
    $conn->close();
    ?>

<script src="assets/app1.js"></script>
</body>
</html>
