<?php
include 'db_connect.php';  // Include your database connection

// Fetch the email from the URL
if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($conn, $_GET['email']);

    // Query to fetch company information based on email
    $query = "SELECT full_name FROM blog_vlog_login WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    // Check if the company exists
    if (mysqli_num_rows($result) > 0) {
        $name = mysqli_fetch_assoc($result);
    } else {
        $name = null; // No company found
    }
} else {
    // Redirect or handle the case where email is not set
    header("Location: error.php"); // Redirect to an error page or handle it
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Company Dashboard - TravelSaathi</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="container">
        <header>
            <br>
            <h1>Welcome to Your Dashboard, <?php echo $name ? $name['full_name'] : 'Your UserName'; ?>!</h1>
            <br>
            <nav>
                <ul>
                <li><a href="profile.php?email=<?php echo $email; ?>">Profile</a></li>
                <li><a href="change_password1.php?email=<?php echo $email; ?>">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>
</body>
</html>        
<style>
/* General styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
}

body {
    background-color: #0D1117; /* Dark background */
    color: #C9D1D9; /* Light text */
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Header styles */
header {
    background-color: #161B22; /* Darker header background */
    color: #ffffff;
    padding: 20px 0;
    text-align: center;
    border-bottom: 2px solid #30363D;
}

header h1 {
    font-size: 28px;
    margin-bottom: 10px;
}

nav ul {
    display: flex;
    justify-content: center;
    list-style: none;
    gap: 25px;
    margin-top: 10px;
}

nav ul li a {
    color: #C9D1D9;
    text-decoration: none;
    font-size: 18px;
    font-weight: 500;
    padding: 10px 20px;
    transition: background-color 0.3s;
    border-radius: 5px;
}

nav ul li a:hover {
    background-color: #1F6FEB; /* Hover effect */
}

/* Profile Section */
.profile, .packages, .upload {
    background-color: #161B22;
    padding: 20px;
    margin-bottom: 30px;
    border-radius: 8px;
    border: 1px solid #30363D;
}

.profile h2, .packages h2, .upload h2 {
    color: #58A6FF; /* Blue heading color */
    margin-bottom: 20px;
}

.profile p {
    font-size: 18px;
    margin-bottom: 8px;
}

/* Package List Section */
.package-list {
    list-style: none;
    padding-left: 0;
}

.package-list li {
    display: flex;
    justify-content: space-between;
    background-color: #21262D;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #30363D;
}

.package-list li a {
    color: #58A6FF;
    text-decoration: none;
    font-weight: bold;
}

.package-list li a:hover {
    text-decoration: underline;
}

/* Upload Package Form */
form label {
    display: block;
    margin-bottom: 5px;
    color: #C9D1D9;
}

form input, form textarea, form button {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #30363D;
    border-radius: 5px;
    background-color: #0D1117;
    color: white;
    font-size: 16px;
}

form textarea {
    resize: vertical;
}

form button {
    background-color: #1F6FEB;
    color: white;
    border: none;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s;
}

form button:hover {
    background-color: #2585ff;
}

/* Footer styles */
footer {
    background-color: #161B22;
    color: #8B949E;
    text-align: center;
    padding: 20px;
    margin-top: 30px;
    font-size: 14px;
}

    </style>