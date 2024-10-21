<?php
include 'db_connect.php';

// Fetch event matches for Olympics 2024 (Event ID 1)
$sqlMatches = "SELECT * from sport";

try {
    // Use PDO to prepare and execute the statement
    $stmt = $pdo->query($sqlMatches);
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS - Olympics 2024</title>
    <link rel="stylesheet" href="assets/style2.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="assets/img/logo1.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        /* Add styles for the table */
        .table-container {
            font-family: "Nunito", sans-serif;
            width: 80%; /* Adjust the width as needed */
            margin: 0 auto; /* Center the table */
            overflow-x: auto; /* Enable horizontal scrolling if needed */
        }

        table {font-family: "Nunito", sans-serif;
            width: 100%; /* Full width of container */
            border-collapse: collapse; /* Merge borders */
            margin-top: 20px; /* Space above table */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Add shadow */
        }

        th, td {
            font-family: "Roboto", sans-serif;
            padding: 15px; /* Add padding to cells */
            text-align: left; /* Align text to the left */
            border: 1px solid #ddd; /* Border for cells */
        }

        th {
            background: linear-gradient(135deg, #0d47a1, #42a5f5); /* Header gradient background */
            color: white; /* Header text color */
            font-weight: bold; /* Bold text for headers */
            font-size: 20px; /* Increase font size for headers */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Zebra striping for rows */
        }

        tr:hover {
            background-color: #e0e0e0; /* Highlight row on hover */
        }

        .table_items {
            color: #007BFF; /* Link color */
            text-decoration: none; /* Remove underline */
            display: block; /* Make the link a block element */
            padding: 10px; /* Add padding for better click area */
            border-radius: 4px; /* Rounded corners */
            font-size: 1.5rem;
            transition: transform 0.2s; /* Animation for hover */
        }

        .table_items:hover {
            text-decoration: underline; /* Underline on hover */
            transform: translateY(-3px); /* Move up on hover */
            background: linear-gradient(135deg, #e3f2fd, #bbdefb); /* Gradient background on hover */
        }
    </style>
</head>
<body>
    <div class="scrolling-bar"></div>
    <header>
            <h2 class="logo"><img src="assets/img/logo.png"
                    alt="Website logo"></h2>
            <ul>
                <li><i class="fa-solid fa-house"></i><a
                        href="index2.html">Home</a></li>
                <li class="events-dropdown">
                    <i class="fa-solid fa-calendar-days"></i>
                    <a href="#view">View <i
                            class="fa-solid fa-chevron-down dropdown-arrow"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="olympics_2024.php">Olympics 2024</a></li>
                        <li><a href="#wimbledon">Wimbledon 2024</a></li>
                        <li><a href="#badminton">World Badminton Championship
                                2018</a></li>
                        <li><a href="#archery">Archery World Cup 2021</a></li>
                        <li><a href="#shooting">Shooting World Cup 2019</a></li>
                        <li><a href="#table">Table Tennis World Cup
                                2021</a></li>
                    </ul>
                </li>
                <li><a href="edit.html">Edit</a></li>
                <li><a href="sponsors.html">Sponsors</a></li>
                <li class="user-dropdown">
                    <a href="javascript:void(0);" id="user-icon"><i
                            class="fa-regular fa-user"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#username">Hi, <span
                                    id="display-username">Admin</span>
                                👋</a></li>
                        <li><a href="help.html">Help</a></li>
                        <li><button id="logout-button">Log Out</button></li>
                    </ul>
                </li>
            </ul>
        </header>

    <section class="main">
        <div class="text-center">
            <h1 class="banner-heading">Olympics 2024 Matches</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Sport</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($stmt->rowCount() > 0): ?>
                            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                <tr>
                                    <td>
                                        <a class="table_items" href="players_admin.php?sport_id=<?= htmlspecialchars($row['Sport_id']) ?>">
                                            <?= htmlspecialchars($row['Sport_name']) ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="1">No matches found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script src="/assets/app1.js"></script>
</body>
</html>

<?php
// No need to call close() on PDO; it's automatically done when the script ends.
?>
