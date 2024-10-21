<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Match Details</title>
    <link rel="stylesheet" href="assets/style1.css">
    <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background-color: #f5f5f5; */
            background: rgb(11,0,36);
background: linear-gradient(90deg, rgba(11,0,36,1) 0%, rgba(9,120,121,1) 41%, rgba(0,212,255,1) 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
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
            width: 48%;
            padding: 10px;
            background-color: #6bc1ff;
            border: none;
            color: black;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            margin-right: 2%;
        }

        .form-group button:last-child {
            margin-right: 0;
        }

        .checkbox-group {
            display: flex;
            justify-content: space-between;
        }

        .checkbox-group label {
            display: flex;
            align-items: center;
        }
        /* Custom Radio Button Styles */
    input[type="radio"] {
        display: none; /* Hide the default radio button */
    }

    .radio-custom {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 2px solid #6bc1ff;
        border-radius: 50%;
        position: relative;
        margin-right: 10px;
        transition: background-color 0.3s ease;
    }

    input[type="radio"]:checked + .radio-custom {
        background-color: #6bc1ff; /* Color for checked state */
    }

    .radio-custom:after {
        content: '';
        position: absolute;
        width: 10px;
        height: 10px;
        background: white; /* Inner circle */
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    input[type="radio"]:checked + .radio-custom:after {
        opacity: 1; /* Show inner circle when checked */
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
    <script>
        // Function to fetch players based on selected sport
        async function fetchPlayers(sportId) {
            const response = await fetch(`fetch_players.php?sport_id=${sportId}`);
            const players = await response.json();
            const player1Select = document.getElementById('player1_id');
            const player2Select = document.getElementById('player2_id');
            
            player1Select.innerHTML = '';
            player2Select.innerHTML = '';

            players.forEach(player => {
                const option = document.createElement('option');
                option.value = player.Player_id;
                option.textContent = player.Player_name;
                player1Select.appendChild(option);
                player2Select.appendChild(option.cloneNode(true));
            });
        }
    </script>
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
        <h2>Add Match Details</h2>
        
        <form action="" method="POST" id="match-form">
            <div class="form-group">
                <label for="match_id">Match ID:</label>
                <input type="number" id="match_id" name="match_id" min="0" required>
            </div>
            <div class="form-group">
                <label for="sport_id">Sport:</label>
                <select id="sport_id" name="sport_id" required onchange="fetchPlayers(this.value)">
                    <option value="" disabled selected>Select a sport</option>
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
            <div class="form-group">
                <label for="player1_id">Player 1:</label>
                <select id="player1_id" name="player1_id" required>
                    <!-- Players will be populated based on selected sport -->
                </select>
            </div>
            <div class="form-group">
                <label for="player2_id">Player 2:</label>
                <select id="player2_id" name="player2_id" required>
                    <!-- Players will be populated based on selected sport -->
                </select>
            </div>
            <div class="form-group checkbox-group">
    <label>
        <input type="radio" name="winner" value="player1" required>
        <span class="radio-custom"></span>
        Player 1 Wins
    </label>
    <label>
        <input type="radio" name="winner" value="player2" required>
        <span class="radio-custom"></span>
        Player 2 Wins
    </label>
</div>

            <div class="form-group">
                <button type="submit" id="submit-btn" name="submit_add">Save</button>
                <button type="reset" id="reset-btn">Reset</button>
            </div>
        </form>
    </div>

    <?php
    // Add Match
    if (isset($_POST['submit_add'])) {
        // Get the form data
        $match_id = $_POST['match_id'];
        $player1_id = $_POST['player1_id'];
        $player2_id = $_POST['player2_id'];

        // Determine winner
        $winner = $_POST['winner'] == 'player1' ? $player1_id : $player2_id;

        // Ensure match_id is non-negative
        if ($match_id < 0) {
            echo "<script>alert('Match ID must be non-negative.');</script>";
        } else {
            // Check if match_id already exists
            $check_stmt = $conn->prepare("SELECT Match_id FROM MATCHS WHERE Match_id = ?");
            if (!$check_stmt) {
                die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            }
            $check_stmt->bind_param("i", $match_id);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            // if ($check_result->num_rows > 0) {
            //     echo "<script>alert('Match ID already exists.');</script>";
            // } else {
                // Prepare and bind for inserting into MATCH_DETAILS
                $stmt = $conn->prepare("INSERT INTO MATCH_DETAILS (Match_detail_id, Match_id, Player_id, Is_winner) VALUES (?, ?, ?, ?)");
                if (!$stmt) {
                    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
                }

                // Ensure unique Match_detail_id
                $max_detail_id_result = $conn->query("SELECT MAX(Match_detail_id) AS max_id FROM MATCH_DETAILS");
                $max_detail_id = $max_detail_id_result->fetch_assoc()['max_id'];
                $match_detail_id = $max_detail_id ? $max_detail_id + 1 : 1; // Start from 1 if no records exist

                // First insert for the winner
                $is_winner = 1; // TRUE for winner
                $stmt->bind_param("iiii", $match_detail_id, $match_id, $winner, $is_winner);
                if (!$stmt->execute()) {
                    echo "<script>alert('Error inserting winner: " . $stmt->error . "');</script>";
                }

                // Increment match_detail_id for the loser
                $match_detail_id++;

                // Second insert for the loser
                $loser = $winner == $player1_id ? $player2_id : $player1_id; // Get the loser
                $is_winner = 0; // FALSE for loser
                $stmt->bind_param("iiii", $match_detail_id, $match_id, $loser, $is_winner);
                if (!$stmt->execute()) {
                    echo "<script>alert('Error inserting loser: " . $stmt->error . "');</script>";
                } else {
                    echo "<script>alert('Match details added successfully!');</script>"; // Popup for success
                }

                // Close the statement
                $stmt->close();
            // }

            // Close the check statement
            $check_stmt->close();
        }
    }

    // Close the database connection
    $conn->close();
    ?>
    <script src="assets/app1.js"></script>
</body>
</html>
