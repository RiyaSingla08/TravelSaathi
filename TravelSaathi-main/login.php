<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    
</head>
<?php
include 'db_connect.php';  // Include your database connection

// Handle Login
if (isset($_POST['email']) && isset($_POST['login_type'])) {  
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $login_type = $_POST['login_type'];  // Get the selected login type

    // Define table and redirect page based on login type
    if ($login_type == 'ADMIN') {
        $table = 'admin_login';
        $redirect_page = 'admin_dashboard.php';
    } elseif ($login_type == 'TOUR COMPANY') {
        $table = 'company_login';
        $redirect_page = 'profile.php';
    } elseif ($login_type == 'TOURIST') {
        $table = 'user_login';
        $redirect_page = 'my_trips.php';
    } elseif ($login_type == 'BLOGS & VLOGS') {
        $table = 'blog_vlog_login';
        $redirect_page = 'blogs&vlogs_dashboard.php';
    } else {
        $message = "Invalid login type!";
    }

    // If a valid table is set, continue with the query
    if (isset($table)) {
        // Fetch the user from the respective table
        $query = "SELECT * FROM $table WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['loggedin'] = true; // Set to true when the user is logged in
                $_SESSION['user_email'] = $email; // Store the user's email

                // Redirect based on login type
                header("Location: $redirect_page?email=" . urlencode($email));
                exit();
            } else {
                $message = "Invalid email or password!";
            }
        } else {
            $message = "User not found!";
        }
    }
}
?>


<body>
<?php include "header.php"; ?>

<?php
// Display any message if available
if (isset($message)) {
    echo "<p>$message</p>";
}
?>

<!-- Login Container -->
<div class="container1" id="login">
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="  Email" required>
        <input type="password" name="password" placeholder="  Password" required>
        <select id="login_type" name="login_type" required>
    <option value="ADMIN">ADMIN</option>
    <option value="TOUR COMPANY">TOUR COMPANY</option>
    <option value="TOURIST">TOURIST</option>
    <option value="BLOGS & VLOGS">BLOGS & VLOGS</option>
</select>
        <button type="submit">Log In</button>
    </form>

    <div class="link1">
        Don't have an account? <a href="signup.php">Sign Up</a>
    </div>
</div>

<?php include "footer.php"; ?>
</body>

</html>
<style>
    /* Style the container of the dropdown */
#login select {
    width: 100%; /* Make the dropdown fill the width of the container */
    padding: 10px; /* Padding inside the dropdown */
    margin: 10px 0; /* Margin for spacing around the element */
    background-color: #333; /* Dropdown background color */
    color: #fff; /* Text color inside the dropdown */
    border: none; /* Remove default border */
    border-radius: 5px; /* Rounded corners */
    font-size: 16px; /* Adjust font size */
    cursor: pointer; /* Change cursor on hover */
}

/* Style when the dropdown is hovered */
#login select:hover {
    background-color: #444; /* Slightly lighter background on hover */
}

/* Style the options inside the dropdown */
#login option {
    background-color: #333; /* Background color of options */
    color: #fff; /* Text color of options */
}

/* Style the arrow of the dropdown */
#login select:focus {
    outline: none; /* Remove outline when focused */
    border: 2px solid #7d4bc8; /* Add a custom border on focus */
}

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #654ea3, #eaafc8); /* Gradient background */
        
        justify-content: center;
        align-items: center;
        height: 105vh;
    }

    .container1 {
        
        background-color: #0d0d0d;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        width: 408px;
        height:500px;
        text-align: center;
        margin: 58px 572px;
        margin-top: 97px;
    }

    h2 {
        margin-bottom: 20px;
        font-size: 1.8rem;
        color: #654ea3;
    }

    input {
        width: 100%;
        padding: 12px 2px;
        margin: 10px -15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
    }

    button {
        padding: 12px 20px;
        background-color: #654ea3;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-size: 1.1rem;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #523b8c;
    }

    .link1 {
        margin-top: 15px;
        font-size: 0.9rem;
        color:#f6f6f6;
    }

    a {
        color: #f6f6f6;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    a:hover {
        color: #654ea3;
    }

    .hidden1 {
        display: none;
    }
</style>

