<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Delete Sport</title>
    <link rel="stylesheet" href="assets/style1.css">
    <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<style>
            body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(to right, #00c6ff, #0072ff); /* Light blue to deep blue */
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
        <h2 id="form-title">Add New Sport</h2>
        
        <div class="action-buttons">
            <button id="add-btn" onclick="switchMode('add')">Add</button>
            <button id="delete-btn" class="delete-mode" onclick="switchMode('delete')">Delete</button>
        </div>

        <!-- Form for adding or deleting sports -->
        <form action="Add-sports.php" method="POST" id="sport-form">
            <div class="form-group" id="sport-id-group">
                <label for="sport_id">Sport ID:</label>
                <input type="number" id="sport_id" name="sport_id" min="0" required>
            </div>
            <div class="form-group" id="sport-name-group">
                <label for="sport_name">Sport Name:</label>
                <input type="text" id="sport_name" name="sport_name" required>
            </div>
            <div class="form-group">
                <button type="submit" id="submit-btn" name="submit_add">Add Sport</button>
                <button type="submit" id="submit-delete-btn" name="submit_delete" style="display:none;">Delete Sport</button>
            </div>
        </form>
    </div>

    <script>
        // JavaScript to switch between Add and Delete modes
        function switchMode(mode) {
            const formTitle = document.getElementById('form-title');
            const sportIdGroup = document.getElementById('sport-id-group');
            const sportNameGroup = document.getElementById('sport-name-group');
            const addButton = document.getElementById('submit-btn');
            const deleteButton = document.getElementById('submit-delete-btn');

            if (mode === 'add') {
                formTitle.textContent = 'Add New Sport';
                sportIdGroup.style.display = 'block';
                sportNameGroup.style.display = 'block';
                addButton.style.display = 'inline-block';
                deleteButton.style.display = 'none';
                document.getElementById('sport-form').reset(); // Reset form
            } else {
                formTitle.textContent = 'Delete Sport';
                sportIdGroup.style.display = 'none'; // Hide Sport ID for deletion
                sportNameGroup.style.display = 'block'; // Show Sport Name for deletion
                addButton.style.display = 'none';
                deleteButton.style.display = 'inline-block';
                document.getElementById('sport-form').reset(); // Reset form
            }
        }
    </script>

    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', 'tharun701', 'SM_Tournament_management_system');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Add Sport
    if (isset($_POST['submit_add'])) {
        // Get the form data
        $sport_id = $_POST['sport_id'];
        $sport_name = $_POST['sport_name'];

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO SPORT (Sport_id, Sport_name) VALUES (?, ?)");
        $stmt->bind_param("is", $sport_id, $sport_name);

        // Execute the query
        if ($stmt->execute()) {
            echo "<script>alert('New sport added successfully!');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Delete Sport
    if (isset($_POST['submit_delete'])) {
        // Get Sport Name from the form
        $sport_name = $_POST['sport_name'];

        // Prepare and bind the delete query
        $stmt = $conn->prepare("DELETE FROM SPORT WHERE Sport_name = ?");
        $stmt->bind_param("s", $sport_name);

        // Execute the delete query
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Sport deleted successfully!');</script>";
            } else {
                echo "<script>alert('No sport found with that name.');</script>";
            }
        } else {
            echo "<script>alert('Error deleting sport: " . $stmt->error . "');</script>";
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
