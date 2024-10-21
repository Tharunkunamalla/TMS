<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Delete Tournament</title>
    <link rel="stylesheet" href="assets/style1.css">
    <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
            body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(to right, #d299c2, #fef9d7); /* Soft rose to gold */
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
        <h2 id="form-title">Add New Tournament</h2>
        
        <div class="action-buttons">
            <button id="add-btn" onclick="switchMode('add')">Add</button>
            <button id="delete-btn" class="delete-mode" onclick="switchMode('delete')">Delete</button>
        </div>

        <!-- Form for adding or deleting tournaments -->
        <form action="Add-tournaments.php" method="POST" id="tournament-form">
            <div class="form-group" id="event-id-group">
                <label for="event_id">Event ID:</label>
                <input type="number" id="event_id" name="event_id" min="0" required>
            </div>
            <div class="form-group" id="event-name-group">
                <label for="event_name">Event Name:</label>
                <input type="text" id="event_name" name="event_name" required>
            </div>
            <div class="form-group" id="year-group">
                <label for="year">Year:</label>
                <input type="number" id="year" name="year" required>
            </div>
            <div class="form-group" id="location-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
            </div>
            <div class="form-group" id="sponsor-group">
                <label for="sponsors">Sponsor:</label>
                <input type="text" id="sponsor" name="sponsor" required>
            </div>
            <div class="form-group">
                <button type="submit" id="submit-btn" name="submit_add">Add Tournament</button>
                <button type="submit" id="submit-delete-btn" name="submit_delete" style="display:none;">Delete Tournament</button>
            </div>
        </form>
    </div>

    <script>
        function switchMode(mode) {
            const formTitle = document.getElementById('form-title');
            const eventIdGroup = document.getElementById('event-id-group');
            const eventNameGroup = document.getElementById('event-name-group');
            const yearGroup = document.getElementById('year-group');
            const locationGroup = document.getElementById('location-group');
            const sponsorGroup = document.getElementById('sponsor-group');
            const addButton = document.getElementById('submit-btn');
            const deleteButton = document.getElementById('submit-delete-btn');

            if (mode === 'add') {
                formTitle.textContent = 'Add New Tournament';
                eventIdGroup.style.display = 'block';
                eventNameGroup.style.display = 'block';
                yearGroup.style.display = 'block';
                locationGroup.style.display = 'block';
                sponsorGroup.style.display = 'block';
                addButton.style.display = 'inline-block';
                deleteButton.style.display = 'none';
            } else {
                formTitle.textContent = 'Delete Tournament';
                eventIdGroup.style.display = 'block';
                eventNameGroup.style.display = 'none';
                yearGroup.style.display = 'none';
                locationGroup.style.display = 'none';
                sponsorGroup.style.display = 'none';
                addButton.style.display = 'none';
                deleteButton.style.display = 'inline-block';
            }
            document.getElementById('tournament-form').reset(); // Reset form
        }

        // Validate sponsor input to allow only alphabetic characters
        document.getElementById('tournament-form').addEventListener('submit', function(event) {
            const sponsorInput = document.getElementById('sponsor').value;
            const regex = /^[A-Za-z\s]+$/; // Alphabetic characters and spaces only

            if (!regex.test(sponsorInput)) {
                alert('Sponsor name must contain alphabetic characters only.');
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>

    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', 'tharun701', 'SM_Tournament_management_system');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Add Tournament
    if (isset($_POST['submit_add'])) {
        $event_id = $_POST['event_id'];
        $event_name = $_POST['event_name'];
        $year = $_POST['year'];
        $location = $_POST['location'];
        $sponsor = $_POST['sponsor'];

        // Insert query
        $stmt = $conn->prepare("INSERT INTO EVENT (Event_id, Event_name, Year, Location, Sponsor) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isiss", $event_id, $event_name, $year, $location, $sponsor);

        if ($stmt->execute()) {
            echo "<script>alert('New tournament added successfully!');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    // Delete Tournament
    if (isset($_POST['submit_delete'])) {
        $event_id = $_POST['event_id'];

        $stmt = $conn->prepare("DELETE FROM event WHERE Event_id = ?");
        $stmt->bind_param("i", $event_id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Tournament deleted successfully!');</script>";
            } else {
                echo "<script>alert('No tournament found with that ID.');</script>";
            }
        } else {
            echo "<script>alert('Error deleting tournament: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    }

    // Close connection
    $conn->close();
    ?>

<script src="assets/app1.js"></script>
</body>
</html>