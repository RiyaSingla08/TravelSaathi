<?php
include 'db_connect.php';  // Include your database connection
include "header_company.php";
// Fetch the email from the URL
if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($conn, $_GET['email']);

    // Fetch the company details
    $query = "SELECT * FROM company_login WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $company = mysqli_fetch_assoc($result);
} else {
    header("Location: error.php");
    exit();
}

// Handle form submission for updating the profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $company_name = $_POST['company_name'];
    $description = $_POST['description'];
    $contact_information = $_POST['contact_information'];

    // Check if a new logo was uploaded
    if ($_FILES['logo']['name']) {
        $logo_path = 'uploads/' . basename($_FILES['logo']['name']);
        move_uploaded_file($_FILES['logo']['tmp_name'], $logo_path);
    } else {
        $logo_path = $company['logo_path'];  // Keep the existing logo if no new file is uploaded
    }

    // Update query
    $updateQuery = "UPDATE company_login SET company_name='$company_name', description='$description', contact_information='$contact_information', logo_path='$logo_path' WHERE email='$email'";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: tour_dashboard.php?email=$email");  // Redirect back to dashboard
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Company Profile</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="company_name">Company Name:</label>
        <input type="text" id="company_name" name="company_name" value="<?php echo htmlspecialchars($company['company_name']); ?>" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" ><?php echo htmlspecialchars($company['description']); ?></textarea><br>

        <label for="contact_information">Contact Information:</label>
        <input type="text" id="contact_information" name="contact_information" value="<?php echo htmlspecialchars($company['contact_information']); ?>"><br>

        <label for="logo">Current Logo:</label><br>
        <img src="<?php echo htmlspecialchars($company['logo_path']); ?>" alt="Current Logo" style="max-width: 150px; margin-bottom: 10px;"><br>

        <label for="logo">Upload New Logo (optional):</label>
        <input type="file" id="logo" name="logo" accept="image/*"><br>

        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
<style>
    /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #1f1f1f;
    color: #f5f5f5;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
}

h2 {
    color: #3ea0dd;
    margin-top: 20px;
}

/* Form Styles */
form {
    background-color: #2d2d2d;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    max-width: 400px;
    width: 100%;
}

label {
    color: #f5f5f5;
    font-weight: bold;
    display: block;
    margin: 15px 0 5px;
}

input[type="text"],
textarea {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #555;
    border-radius: 4px;
    background-color: #3b3b3b;
    color: #f5f5f5;
    outline: none;
}

textarea {
    resize: vertical;
}

input[type="file"] {
    margin-top: 10px;
    color: #f5f5f5;
}

/* Image Styles */
img {
    border: 2px solid #3ea0dd;
    border-radius: 4px;
}

/* Button Styles */
button[type="submit"] {
    background-color: #3ea0dd;
    color: #f5f5f5;
    font-weight: bold;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #2b81b3;
}

/* Responsive */
@media (max-width: 480px) {
    form {
        padding: 15px;
    }

    input[type="text"], textarea {
        width: calc(100% - 16px);
    }
}

    </style>