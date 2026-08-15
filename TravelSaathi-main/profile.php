<?php
include 'db_connect.php';  // Include your database connection

// Fetch the email from the URL
if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($conn, $_GET['email']);

    // Query to fetch company information based on email
    $query = "SELECT company_name, description, contact_information, logo_path FROM company_login WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    // Check if the company exists
    if (mysqli_num_rows($result) > 0) {
        $company = mysqli_fetch_assoc($result);
    } else {
        $company = null; // No company found
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
    <title>Tour Company Profile - TravelSaathi</title>
    <link rel="stylesheet" >
</head>
<body>
<?php include "header_company.php"; ?>
    <div class="container-profile">
        <br>
        <main>
            <section class="profile">
                <h2>Your Company Profile</h2>
                <?php if ($company): ?>
                    <p>Company Name: <strong><?php echo $company['company_name']; ?></strong></p>
                    <p>Company Description: <strong><?php echo $company['description']; ?></strong></p>
                    <p>Contact Information: <strong><?php echo $company['contact_information']; ?></strong></p>
                    <p>Company Logo:</p>
                    <img src="<?php echo $company['logo_path']; ?>" alt="Company Logo" style="max-width: 150px;">
                    <br><br>
                    <!-- Edit Profile Button -->
                    <a href="edit_profile.php?email=<?php echo $email; ?>" class="button">Edit Profile</a>
                <?php else: ?>
                    <p>No company information found.</p>
                <?php endif; ?>
            </section>
        </main>
    </div>
</body>
</html>


<style>
    .button {
    display: inline-block;
    background-color: #3ea0dd;
    color: #f5f5f5;
    padding: 10px 20px;
    border-radius: 4px;
    font-weight: bold;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
    text-align: center;
}

.button:hover {
    background-color: #2b81b3;
    color: #ffffff;
}

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

.container-profile {
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