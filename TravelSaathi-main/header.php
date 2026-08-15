<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    @session_start();
}



// Check if the email is set in the URL and not in the session
if (isset($_GET['email']) && !isset($_SESSION['user_email'])) {
    $_SESSION['user_email'] = $_GET['email'];
    $_SESSION['loggedin'] = true;  // Set logged-in status to true for testing
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>TravelSaathi</title>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <!-- Logo Area -->
        <div class="logo">
            <img src="images/Final LOGO(1)(1).png" alt="TravelSaathi Logo">
        </div>

        <!-- Navigation Links -->
        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="my_trips.php">My Trips</a>
            <a href="listed_packages.php">Search</a>
            <a href="aboutus.php">About Us</a>
            <a href="contactus.php">Contact Us</a>
            <a href="wishlist.php">
                <i class="far fa-heart"></i> WishList
            </a>
        </nav>

        <!-- Conditional User Display -->
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <!-- Display User Email and Profile Picture -->
            <div class="user-container">
                <img src="images/1.jpg" alt="User Profile Picture" class="user-profile-pic">
                <span><?php echo htmlspecialchars($_SESSION['user_email']); ?></span>
                <a href="logout.php" class="sign-in-btn hollow-btn">Logout</a> 
            </div>
        <?php else: ?>
            <!-- Sign In and Log In Buttons -->
            <div class="auth-buttons">
                <a href="signup.php" class="sign-in-btn hollow-btn">Sign In</a>
                <a href="login.php" class="sign-in-btn hollow-btn">Log In</a> 
            </div>
        <?php endif; ?>
    </header>
</body>
</html>


<style>
    .user-container span{
        color: white;
    }
    /* User profile picture styling */
.user-container {
    display: flex;
    align-items: center;
    gap: 10px; /* Space between image and email */
}

.user-container img {
    width: 30px;  /* Set width */
    height: 30px; /* Set height */
    border-radius: 50%; /* Make it circular */
    object-fit: cover; /* Crop image to fit the circle */
    border: 2px solid #fff; /* Optional: add border for contrast */
}

/* Optional: styling for email next to the image */
.user-container .user-email {
    font-size: 0.9rem;
    color: #fff !important; /* Adjust color as needed */
}

    /* General Styling */
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background-color: #0d0d0d; /* Dark background for the body */
    }

    /* Header Styling */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 40px;
        background-color: #0d0d0d; /* Darker background for the header */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
    }

    /* Logo */
    .logo img {
        width: 150px;
    }

    /* Navigation Links */
    .nav-links {
        display: flex;
        gap: 30px;
    }

    .nav-links a {
        text-decoration: none;
        color: #e0e0e0; /* Light grey for text to stand out on dark background */
        font-size: 16px;
        font-weight: 500;
        transition: color 0.3s ease-in-out;
        padding: 8px;
    }

    .nav-links a:hover {
        color: #00bcd4; /* Highlight link on hover */
        border-bottom: 2px solid #00bcd4;
    }

    /* Hollow Heart Icon Styling */
    .far.fa-heart {
        color: #00bcd4; /* Blue color for hollow heart icon */
        font-size: 20px;
        margin-right: 8px;
    }

    /* Hollow Button Styling for Sign In & Log In */
    .hollow-btn {
        padding: 10px 18px;
        background-color: transparent; /* Hollow effect */
        border: 2px solid #00bcd4; /* Blue border */
        color: #00bcd4; /* Blue text */
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 500;
        transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
    }

    .hollow-btn:hover {
        background-color: #00bcd4; /* Blue background on hover */
        color: white; /* White text on hover */
    }

    /* User Icon Styling */
    .user-icon {
        color: #e0e0e0; /* Light color to match the dark theme */
        font-size: 16px;
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .user-icon i {
        margin-right: 5px;
    }

    /* Responsive Styling */
    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        .header {
            flex-direction: column;
            align-items: flex-start;
        }

        .logo img {
            margin-bottom: 10px;
        }
    }
</style>


