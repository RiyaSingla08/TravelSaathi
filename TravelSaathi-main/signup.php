<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    
</head>
<?php
include 'db_connect.php';  // Include your database connection

// Handle Signup
if (isset($_POST['username'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);  // Hashing the password for security
    $role = mysqli_real_escape_string($conn, $_POST['role']);  // Fetch the selected role

    // Check if the email already exists in all four tables
    $query_admin = "SELECT * FROM admin_login WHERE email = '$email'";
    $query_company = "SELECT * FROM company_login WHERE email = '$email'";
    $query_user = "SELECT * FROM user_login WHERE email = '$email'";
    $query_blogs_vlogs = "SELECT * FROM blog_vlog_login WHERE email = '$email'"; // New query for blogs and vlogs

    $result_admin = mysqli_query($conn, $query_admin);
    $result_company = mysqli_query($conn, $query_company);
    $result_user = mysqli_query($conn, $query_user);
    $result_blogs_vlogs = mysqli_query($conn, $query_blogs_vlogs); // New result for blogs and vlogs

    if (mysqli_num_rows($result_admin) > 0 || mysqli_num_rows($result_company) > 0 || mysqli_num_rows($result_user) > 0 || mysqli_num_rows($result_blogs_vlogs) > 0) {
        $message = "Email already exists!";
    } else {
        // Insert the user into the appropriate table based on the role
        if ($role == 'admin') {
            $sql = "INSERT INTO admin_login (full_name, email, password) VALUES ('$username', '$email', '$password')";
        } elseif ($role == 'tour_company') {
            // Additional fields for company registration
            $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
            $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $contact_information = mysqli_real_escape_string($conn, $_POST['contact_information']);

            // Handle logo upload
            $logo_path = "";
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === 0) {
                $logo_name = $_FILES['logo']['name'];
                $logo_tmp = $_FILES['logo']['tmp_name'];
                $upload_dir = "uploads/";
                $logo_path = $upload_dir . uniqid() . "_" . basename($logo_name);

                // Create the upload directory if it doesn't exist
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                // Move the uploaded file to the designated folder
                if (move_uploaded_file($logo_tmp, $logo_path)) {
                    $message = "Logo uploaded successfully!";
                } else {
                    $message = "Failed to upload logo.";
                }
            }

            $sql = "INSERT INTO company_login (company_name, email, password, contact_number, description, contact_information, logo_path) 
                    VALUES ('$company_name', '$email', '$password', '$contact_number', '$description', '$contact_information', '$logo_path')";
        } elseif ($role == 'tourist') {
            $sql = "INSERT INTO user_login (full_name, email, password) VALUES ('$username', '$email', '$password')";
        } elseif ($role == 'blogs_and_vlogs') { // New role handling
            $sql = "INSERT INTO blog_vlog_login (full_name, email, password) VALUES ('$username', '$email', '$password')";
        }

        if (mysqli_query($conn, $sql)) {
            $message = "Signup successful!";
            // Redirect to login page
            header("Location: login.php");
            exit();  // Ensure the script stops after redirection
        } else {
            $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
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
<!-- Signup Container -->
<div class="container1" id="signup">
    <h2>Sign Up</h2>
    <!-- Add enctype attribute for file uploads -->
    <form action="signup.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="  Username" required>
        <input type="email" name="email" placeholder="  Email" required>
        <input type="password" name="password" placeholder="  Password" required>
        <select name="role" id="role" required onchange="toggleCompanyFields()">
    <option value="admin">Admin</option>
    <option value="tour_company">Tour Company</option>
    <option value="tourist">Tourist</option>
    <option value="blogs_and_vlogs">Blogs and Vlogs</option> <!-- New option -->
</select>


        <!-- Additional fields for Tour Company -->
        <div id="company-fields" style="display:none;">
            <input type="text" name="company_name" placeholder="  Company Name">
            <input type="text" name="contact_number" placeholder="  Contact Number">
            <input type="text" name="description" placeholder="  Description">
            <input type="text" name="contact_information" placeholder="  Contact Information">
            
            <!-- Logo upload input -->
            <label class="upload-label">Upload Logo:</label>
            <input type="file" name="logo" accept="image/*" class="file-input">
        </div>

        <button type="submit">Sign Up</button>
    </form>

    <div class="link1">
        Already have an account? <a href="login.php">Log In</a>
    </div>
</div>
<?php include "footer.php"; ?>

<script>
    function toggleCompanyFields() {
        var role = document.getElementById('role').value;
        var companyFields = document.getElementById('company-fields');
        var container = document.getElementById('signup');
        
        if (role === 'tour_company') {
            companyFields.style.display = 'block';
            container.style.height = '800px'; // Elongate form for Tour Company
        } else {
            companyFields.style.display = 'none';
            container.style.height = '500px'; // Default height for other roles
        }
    }
</script>
</body>

</html>

<style>
     /* Style the container of the dropdown */
#signup select {
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
.label{
    color:#0000;
}
.file1{

}
/* Style when the dropdown is hovered */
#signup select:hover {
    background-color: #444; /* Slightly lighter background on hover */
}

/* Style the options inside the dropdown */
#signup option {
    background-color: #333; /* Background color of options */
    color: #fff; /* Text color of options */
}

/* Style the arrow of the dropdown */
#signup select:focus {
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
    height: 500px; /* Default height */
    text-align: center;
    margin: 58px 572px;
    margin-top: 97px;
    transition: height 0.3s ease; /* Smooth transition when height changes */
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

/* Style for the upload label */
.upload-label {
    color: #f0f0f0; /* Off-white color */
    display: block;
    margin-top: 10px;
    margin-bottom: 5px;
    text-align: left;
}

/* Style for the file input */
.file-input {
    color: #f0f0f0; /* Off-white for 'No file chosen' text */
    margin-top: 5px;
}
</style>
