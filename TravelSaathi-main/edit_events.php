<?php
session_start();
include("db_connect.php");

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Fetch event details
    $sql = "SELECT * FROM events WHERE event_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();

    if (!$event) {
        echo "Event not found.";
        exit();
    }
} else {
    echo "No event ID specified.";
    exit();
}

// Update event details if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];
    $event_description = $_POST['event_description'];
    $event_image = $event['event_image'];

    // Check if a new image was uploaded
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] === UPLOAD_ERR_OK) {
        $image_path = 'images/' . basename($_FILES['event_image']['name']);
        move_uploaded_file($_FILES['event_image']['tmp_name'], $image_path);
        $event_image = $image_path;
    }

    // Update query
    $sql = "UPDATE events SET event_name=?, event_date=?, event_location=?, event_description=?, event_image=? WHERE event_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $event_name, $event_date, $event_location, $event_description, $event_image, $event_id);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error updating event: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="admin-header">
        <h1>Edit Event</h1>
        <div class="admin-options">
            <a href="change_password.php">Change Password</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <section class="upload-section">
        <h2>Edit Event Details</h2>
        <form action="edit_events.php?event_id=<?php echo $event_id; ?>" method="POST" enctype="multipart/form-data">
            <label for="event_name">Event Name:</label>
            <input type="text" id="event_name" name="event_name" value="<?php echo htmlspecialchars($event['event_name']); ?>" required>

            <label for="event_date">Event Date:</label>
            <input type="date" id="event_date" name="event_date" value="<?php echo htmlspecialchars($event['event_date']); ?>" required>

            <label for="event_location">Event Location:</label>
            <input type="text" id="event_location" name="event_location" value="<?php echo htmlspecialchars($event['event_location']); ?>" required>

            <label for="event_description">Event Description:</label>
            <textarea id="event_description" name="event_description" required><?php echo htmlspecialchars($event['event_description']); ?></textarea>

            <label for="event_image">Upload New Event Image (optional):</label>
            <input type="file" id="event_image" name="event_image">
            <p>Current Image: <img src="<?php echo htmlspecialchars($event['event_image']); ?>" width="100" alt="Current Event Image"></p>

            <button type="submit">Save Changes</button>
        </form>
    </section>
</body>
</html>

<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #121212; /* Dark background */
    color: #ffffff; /* Light text */
    margin: 0;
    padding: 0;
}

.admin-header {
    background-color: #1e1e1e;
    padding: 20px;
    text-align: center;
}

.admin-header h1 {
    margin: 0;
}

.admin-options {
    margin-top: 10px;
}

.admin-options a {
    color: #4CAF50; /* Green links */
    text-decoration: none;
    margin: 0 15px;
}

.upload-section {
    background-color: #1e1e1e;
    padding: 20px;
    border-radius: 5px;
    margin: 20px;
}

.upload-section h2 {
    margin-top: 0;
}

label {
    display: block;
    margin: 10px 0 5px;
}

input[type="text"],
input[type="date"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #4CAF50; /* Green border */
    border-radius: 4px;
    background-color: #2c2c2c; /* Darker input field */
    color: #ffffff; /* Light text */
}

input[type="file"] {
    margin: 10px 0;
}

button {
    background-color: #4CAF50; /* Green button */
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049; /* Darker green on hover */
}

.event-image {
    margin-top: 10px;
}

    </style>