<?php
// Start session to access user information if logged in
session_start();



// Use email from session if available, else check URL
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} elseif (isset($_GET['email'])) {
    $email = $_GET['email'];
} else {
    echo "Unauthorized access. Please log in.";
    exit;
}

// Include database connection file
include('db_connect.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if new passwords match
    if ($new_password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    // Query to check the current password based on email
    $sql = "SELECT password FROM company_login WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Database error: Failed to prepare statement.";
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($stored_password);
    $stmt->fetch();
    $stmt->close();

    // Verify if the current password is correct
    if (!password_verify($current_password, $stored_password)) {
        echo "Current password is incorrect!";
        exit;
    }

    // Hash the new password
    $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database based on email
    $update_sql = "UPDATE company_login SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($update_sql);

    if (!$stmt) {
        echo "Database error: Failed to prepare update statement.";
        exit;
    }

    $stmt->bind_param("ss", $new_password_hashed, $email);

    if ($stmt->execute()) {
        // Password updated, redirect to login page after successful change
        header("Location: login.php");
        exit;
    } else {
        echo "Error updating password.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - TravelSaathi</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

    <div class="container">
   
        <header>
            <h1>Change Your Password</h1>
        </header>
        <main>
            <form action="change_password.php" method="POST">
                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" required>
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <button type="submit">Change Password</button>
            </form>
        </main>
    </div>
</body>
</html>
<style>
    /* Style for the container */
/* Container styling */
/* General reset and body styling */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #0D1117;
    color: #ffffff;
}

/* Container */
.container {
    width:100%;
    height:720px;
    margin: 0 auto;
    padding: 20px;
}

/* Header styling */
header h1 {
    
    font-size: 1.8em;
    text-align: center;
}

/* Form styling */
form {
    background-color: #0D1117;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #ffffff;
}

input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #444;
    border-radius: 4px;
    background-color: #0D1117;
    color: #ffffff;
}

input[type="password"]:focus {
    outline: none;
    border-color: #58A6FF; /* Blue color for input focus */
}

/* Button styling */
button[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color:#58A6FF;
    color: #ffffff;
    border: none;
    border-radius: 4px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Additional styling for links and navigation */
nav a {
    color: #58A6FF;
    text-decoration: none;
    padding: 10px;
}

nav a:hover {
    color: #ffffff;
}

</style>