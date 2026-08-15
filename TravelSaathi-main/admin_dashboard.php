<?php
include("db_connect.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = htmlspecialchars($_POST['event_name']);
    $event_date = htmlspecialchars($_POST['event_date']);
    $event_location = htmlspecialchars($_POST['event_location']);
    $event_description = htmlspecialchars($_POST['event_description']);
    
    // Handle file upload
    $event_image = $_FILES['event_image']['name'];
    $target_dir = "images/"; // Directory to save uploaded images
    $target_file = $target_dir . basename($event_image);
    
    // Check if image file is a valid image
    $check = getimagesize($_FILES['event_image']['tmp_name']);
    if ($check !== false) {
        // Attempt to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['event_image']['tmp_name'], $target_file)) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO events (event_name, event_date, event_location, event_description, event_image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $event_name, $event_date, $event_location, $event_description, $target_file);

            if ($stmt->execute()) {
                echo "New event uploaded successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}

// Fetch events from the database
$sql = "SELECT * FROM events ORDER BY event_date ASC";
$result = mysqli_query($conn, $sql);

// Check for errors in the query
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="admin-header">
        <h1>Admin Dashboard</h1>
        <div class="admin-options">
            <a href="change_password.php">Change Password</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <section class="upload-section">
        <h2>Upload New Event</h2>
        <form action="admin_dashboard.php" method="POST" enctype="multipart/form-data">
            <label for="event_name">Event Name:</label>
            <input type="text" id="event_name" name="event_name" required>

            <label for="event_date">Event Date:</label>
            <input type="date" id="event_date" name="event_date" required>

            <label for="event_location">Event Location:</label>
            <input type="text" id="event_location" name="event_location" required>

            <label for="event_description">Event Description:</label>
            <textarea id="event_description" name="event_description" required></textarea>

            <label for="event_image">Event Image:</label>
            <input type="file" id="event_image" name="event_image" required>

            <button type="submit">Upload Event</button>
        </form>
    </section>

    <section class="events-section">
        <h2>Upcoming Events</h2>
        <div class="events-container">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="event-card">
                    <img class="event-image" src="<?php echo htmlspecialchars($row['event_image']); ?>" alt="<?php echo htmlspecialchars($row['event_name']); ?>">
                    <h3 class="event-name"><?php echo htmlspecialchars($row['event_name']); ?></h3>
                    <p class="event-date">Date: <?php echo htmlspecialchars($row['event_date']); ?></p>
                    <p class="event-location">Location: <?php echo htmlspecialchars($row['event_location']); ?></p>
                    <p class="event-description"><?php echo htmlspecialchars($row['event_description']); ?></p>
                    <a href="edit_events.php?event_id=<?php echo $row['event_id']; ?>" class="edit-button">Edit</a>
                </div>
            <?php } ?>
        </div>
    </section>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>


<style>
    /* Center alignment for the Edit button */
.event-card {
    text-align: center; /* Centers all content inside the event card */
}

.edit-button {
    display: inline-block;
    padding: 8px 16px;
    margin-top: 10px;
    color: #fff;
    background-color: #007bff; /* Primary color for the button */
    font-size: 14px;
    font-weight: bold;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s ease;
    cursor: pointer;
}

.edit-button:hover {
    background-color: #0056b3;
    color: #ffffff;
}

.edit-button:active {
    background-color: #003f7f;
    color: #ffffff;
}

    /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Background and Text Color */
body {
    background-color: #1e1e1e;
    color: #e0e0e0;
}

/* Admin Header */
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #333;
    padding: 20px;
    color: #e0e0e0;
}

.admin-header h1 {
    font-size: 24px;
}

.admin-options a {
    color: #e0e0e0;
    margin-left: 15px;
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 4px;
    background-color: #555;
    transition: background-color 0.3s ease;
}

.admin-options a:hover {
    background-color: #777;
}

/* Upload Section */
.upload-section {
    background-color: #2c2c2c;
    padding: 30px;
    max-width: 600px;
    margin: 20px auto;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
}

.upload-section h2 {
    font-size: 20px;
    margin-bottom: 15px;
    color: #e0e0e0;
}

.upload-section form label {
    display: block;
    margin-bottom: 5px;
    color: #bbbbbb;
}

.upload-section form input[type="text"],
.upload-section form input[type="date"],
.upload-section form input[type="file"],
.upload-section form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #555;
    background-color: #3c3c3c;
    color: #e0e0e0;
    border-radius: 4px;
}

.upload-section form button {
    padding: 10px 15px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.upload-section form button:hover {
    background-color: #45a049;
}

/* Events Section */
.events-section {
    padding: 30px;
    max-width: 1000px;
    margin: 20px auto;
}

.events-section h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #e0e0e0;
    text-align: center;
}

.events-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.event-card {
    background-color: #2c2c2c;
    border: 1px solid #444;
    border-radius: 8px;
    width: 280px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    transition: transform 0.3s ease;
}

.event-card:hover {
    transform: scale(1.02);
}

.event-image {
    width: 100%;
    height: 180px;
    object-fit: cover;
}

.event-name {
    font-size: 18px;
    margin: 15px;
    color: #e0e0e0;
}

.event-date,
.event-location,
.event-description {
    font-size: 14px;
    color: #bbbbbb;
    margin: 5px 15px;
}

    </style>