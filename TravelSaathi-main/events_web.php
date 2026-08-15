<?php
include "db_connect.php";

if (isset($_GET['event_id'])) { 
    $event_id = intval($_GET['event_id']); 

    // SQL query to fetch the specific event by ID
    $sql = "SELECT event_id, event_name, event_date, event_location, event_description, event_image FROM events WHERE event_id = $event_id";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* General body styles */
        body {
            background-color: #111; /* Dark background to match the theme */
            color: #fff; /* White text for contrast */
            font-family: Arial, sans-serif; /* Font style */
            margin: 0;
            padding: 0;
        }

        /* Style for the section containing the event details */
        .events-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            max-width: 800px;
            margin: auto;
            border-radius: 8px;
        }

        /* Title styling */
        .events-title {
            font-size: 2em;
            color: #00ffd5; /* Bright color to match the theme */
            text-align: center;
            margin-bottom: 20px;
        }

        /* Event card styling */
        .event-card {
            background-color: #222; /* Slightly lighter background for event card */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            width: 100%;
            height:700px;
            display: flex; /* Align content in a row */
            flex-direction: column; /* Stack children vertically */
            align-items: center; /* Center align the children */
            margin-bottom: 20px;
        }

        /* Image styling */
        .event-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* Event content styling */
        .event-content {
            text-align: center;
            max-width: 90%; /* Limit width for better readability */
        }

        /* Description text styling */
        .event-description {
            font-size: 1.2em;
            line-height: 1.6;
            color: #ddd;
            margin-top: 10px; /* Add some margin for spacing */
        }

        /* Date and Location text styling */
        .event-date, .event-location {
            font-size: 1em;
            color: #aaa; /* Lighter color for secondary info */
        }
    </style>
</head>
<body>
    
<?php include "header.php"; ?> 
<section class="events-section">
    
    <div class="events-container">
    
        <?php
        if (isset($result) && $result->num_rows > 0) {
            // Output the specific event details
            $row = $result->fetch_assoc();

            echo '<div class="event-card">'; 
            
            echo '<h2 class="events-title">Event Details</h2>';
            echo '<img class="event-image" src="' . htmlspecialchars($row["event_image"]) . '" alt="' . htmlspecialchars($row["event_name"]) . '">';
            echo '<div class="event-content">';
            echo '<h3 class="event-title">' . htmlspecialchars($row["event_name"]) . '</h3>';
            echo '<p class="event-date">Date: ' . date("F j, Y", strtotime($row["event_date"])) . '</p>';
            echo '<p class="event-location">Location: ' . htmlspecialchars($row["event_location"]) . '</p>';
            echo '<p class="event-description">' . htmlspecialchars($row["event_description"]) . '</p>';
            echo '</div>';
            echo '</div>';
        } else {
            echo "<p>Event not found.</p>";
        }
        ?>
    </div>
</section>

<?php
// Close the database connection
$conn->close();
?>

<?php include "footer.php"; ?> 
</body>
</html>
