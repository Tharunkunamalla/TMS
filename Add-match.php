<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Delete Matches</title>
    <link rel="stylesheet" href="assets/style1.css">
    <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(to right, #6bc1ff, #ff6b6b); /* Stylish gradient from blue to red */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Form container styling remains the same */
.form-container {
    background-color: rgba(255, 255, 255, 0.9); /* White background with slight transparency */
    color: black;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
    width: 400px;
}

.form-container h2 {
    margin-bottom: 20px;
    font-size: 24px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.form-group button {
    width: 100%;
    padding: 10px;
    background-color: #6bc1ff;
    border: none;
    color: black;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
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
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
}

.delete-mode {
    background-color: #ff6b6b;
}

/* Table styling */
table {
    width: 100%; /* Full width of the container */
    border-collapse: collapse; /* Remove gaps between table cells */
}

th, td {
    padding: 12px; /* Padding for table cells */
    text-align: left; /* Align text to the left */
    border: 1px solid #ccc; /* Light border for table cells */
}

/* Header styling */
th {
    background-color: rgba(107, 193, 255, 0.9); /* Slightly transparent header background */
    color: black; /* Header text color */
    font-size: 18px; /* Increase font size */
}

/* Table cell hover effect */
tr:hover td {
    background-color: rgba(107, 193, 255, 0.3); /* Light background on row hover */
}

/* Striped rows for better readability */
tr:nth-child(even) {
    background-color: rgba(0, 0, 0, 0.05); /* Light grey for even rows */
}

/* Focused cell effect */
td:focus {
    outline: 2px solid #6bc1ff; /* Outline effect when focused */
    background-color: rgba(107, 193, 255, 0.5); /* Change background color */
}



/* Additional styling for responsive design */
@media (max-width: 600px) {
    .form-container {
        width: 90%; /* Responsive width */
    }

    table {
        font-size: 14px; /* Adjust table font size */
    }

    th, td {
        padding: 10px; /* Adjust padding for smaller screens */
    }
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
        <h2 id="form-title">Add New Match</h2>
        
        <div class="action-buttons">
            <button id="add-btn" onclick="switchMode('add')">Add</button>
            <button id="delete-btn" class="delete-mode" onclick="switchMode('delete')">Delete</button>
        </div>

        <form action="" method="POST" id="match-form">
            <div class="form-group" id="match-id-group">
                <label for="match_id">Match ID:</label>
                <input type="number" id="match_id" name="match_id" min="0" required>
            </div>
            <div class="form-group" id="event-id-group">
                <label for="event_id">Event:</label>
                <select id="event_id" name="event_id" required>
                    <?php
                    // Database connection
                    $conn = new mysqli('localhost', 'root', 'tharun701', 'SM_Tournament_management_system');

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch events for the dropdown
                    $result = $conn->query("SELECT Event_id, Event_name FROM EVENT");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['Event_id'] . "'>" . $row['Event_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group" id="game-stage-id-group">
                <label for="game_stage_id">Game Stage:</label>
                <select id="game_stage_id" name="game_stage_id" required>
                    <?php
                    // Fetch game stages for the dropdown
                    $result = $conn->query("SELECT stage_id, stage_name FROM GAME_STAGE");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['stage_id'] . "'>" . $row['stage_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group" id="sport-id-group">
                <label for="sport_id">Sport:</label>
                <select id="sport_id" name="sport_id" required>
                    <?php
                    // Fetch sports for the dropdown
                    $result = $conn->query("SELECT Sport_id, Sport_name FROM SPORT");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['Sport_id'] . "'>" . $row['Sport_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" id="submit-btn" name="submit_add">Add Match</button>
                <button type="submit" id="submit-delete-btn" name="submit_delete" style="display:none;">Delete Match</button>
            </div>
        </form>
    </div>

    <script>
        // JavaScript to switch between Add and Delete modes
        function switchMode(mode) {
            const formTitle = document.getElementById('form-title');
            const matchIdGroup = document.getElementById('match-id-group');
            const eventIdGroup = document.getElementById('event-id-group');
            const gameStageIdGroup = document.getElementById('game-stage-id-group');
            const sportIdGroup = document.getElementById('sport-id-group');
            const addButton = document.getElementById('submit-btn');
            const deleteButton = document.getElementById('submit-delete-btn');

            if (mode === 'add') {
                formTitle.textContent = 'Add New Match';
                matchIdGroup.style.display = 'block';
                eventIdGroup.style.display = 'block';
                gameStageIdGroup.style.display = 'block';
                sportIdGroup.style.display = 'block';
                addButton.style.display = 'inline-block';
                deleteButton.style.display = 'none';
            } else {
                formTitle.textContent = 'Delete Match';
                matchIdGroup.style.display = 'block'; // Show Match ID for deletion
                eventIdGroup.style.display = 'block'; // Show Event ID for deletion
                gameStageIdGroup.style.display = 'block'; // Show Game Stage ID for deletion
                sportIdGroup.style.display = 'block'; // Show Sport ID for deletion
                addButton.style.display = 'none';
                deleteButton.style.display = 'inline-block';
            }
            document.getElementById('match-form').reset(); // Reset form
        }
    </script>

    <?php
    // Add Match
    if (isset($_POST['submit_add'])) {
        // Get the form data
        $match_id = $_POST['match_id'];
        $event_id = $_POST['event_id'];
        $game_stage_id = $_POST['game_stage_id'];
        $sport_id = $_POST['sport_id'];

        // Ensure match_id is non-negative
        if ($match_id < 0) {
            echo "<script>alert('Match ID must be non-negative.');</script>";
        } else {
            // Check if match_id already exists
            $check_stmt = $conn->prepare("SELECT Match_id FROM MATCHS WHERE Match_id = ?");
            $check_stmt->bind_param("i", $match_id);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            if ($check_result->num_rows > 0) {
                echo "<script>alert('Match ID already exists.');</script>";
            } else {
                // Prepare and bind
                $stmt = $conn->prepare("INSERT INTO MATCHS (Match_id, Event_id, Game_stage_id, Sport_id) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiii", $match_id, $event_id, $game_stage_id, $sport_id);

                // Execute the query
                if ($stmt->execute()) {
                    echo "<script>alert('New match added successfully!');</script>";
                } else {
                    echo "<script>alert('Error: " . $stmt->error . "');</script>";
                }

                // Close the statement
                $stmt->close();
            }

            // Close the check statement
            $check_stmt->close();
        }
    }

    // Delete Match
    if (isset($_POST['submit_delete'])) {
        // Get Match ID and other details from the form
        $match_id = $_POST['match_id'];
        $event_id = $_POST['event_id'];
        $game_stage_id = $_POST['game_stage_id'];
        $sport_id = $_POST['sport_id'];

        // Prepare and bind the delete query
        $stmt = $conn->prepare("DELETE FROM MATCHS WHERE Match_id = ? AND Event_id = ? AND Game_stage_id = ? AND Sport_id = ?");
        $stmt->bind_param("iiii", $match_id, $event_id, $game_stage_id, $sport_id);

        // Execute the delete query
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Match deleted successfully!');</script>";
            } else {
                echo "<script>alert('No match found with the specified details.');</script>";
            }
        } else {
            echo "<script>alert('Error deleting match: " . $stmt->error . "');</script>";
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
    ?>
    <script src="assets/app1.js"></script>
</body>
</html>
