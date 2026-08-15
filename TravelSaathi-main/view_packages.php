<?php
include 'db_connect.php'; // Include the database connection

// Fetch the email from the URL (which was passed from the previous page)
if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($conn, $_GET['email']);

    // Query to fetch packages associated with the company (travel_data table)
    $query = "SELECT uniq_id, email, package_name, package_type, destination, itinerary, places_covered, travel_date, hotel_details, start_city, airline, price_per_two, price_per_person, sightseeing_details, Initial_Payment, Cancellation_Rules, Date_Change_Rules, image1, image2, image3, image4, image5, image6, image7, image8, image9, image10 FROM travel_data WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    
    // Check if any packages exist
    if (mysqli_num_rows($result) > 0) {
        $packages = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $packages = null;
    }
} else {
    echo "No email provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tour Packages - TravelSaathi</title>
    <link rel="stylesheet">
</head>
<body>
<?php include "header_company1.php" ?>
    <div class="container-packages">
        <div class="header-packages">
            <h1>Your Tour Packages</h1>
</div>
        <br>
        <main>
            <h2>Active Packages</h2>
            <br>
            <ul class="package-list">
                <?php if ($packages): ?>
                    <?php foreach ($packages as $package): ?>
                        <li class="listes">
                            <h3><?php echo $package['package_name']; ?> (<?php echo $package['package_type']; ?>) - Destination: <?php echo $package['destination']; ?></h3>
                            <p>Travel Date: <?php echo $package['travel_date']; ?></p>
                            <p>Price for Two: ₹<?php echo $package['price_per_two']; ?></p>
                            <p>Price per Person: ₹<?php echo $package['price_per_person']; ?></p>
                            <p>Duration: <?php echo $package['places_covered']; ?></p>
                            <p>Itinerary: <?php echo $package['itinerary']; ?></p>
                            <p>Hotel Details: <?php echo $package['hotel_details']; ?></p>
                            <p>Start City: <?php echo $package['start_city']; ?></p>
                            <p>Airline: <?php echo $package['airline']; ?></p>
                            <p>Sightseeing Details: <?php echo $package['sightseeing_details']; ?></p>
                            <p>Initial Payment: ₹<?php echo $package['Initial_Payment']; ?></p>
                            <p>Cancellation Rules: <?php echo $package['Cancellation_Rules']; ?></p>
                            <p>Date Change Rules: <?php echo $package['Date_Change_Rules']; ?></p>
                            <p>Images:</p>
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <?php if (!empty($package['image' . $i])): ?>
                                    <img src="<?php echo $package['image' . $i]; ?>" alt="<?php echo $package['package_name']; ?>" width="150px">
                                <?php endif; ?>
                            <?php endfor; ?>
                            <a href="edit_package.php?uniq_id=<?php echo $package['uniq_id']; ?>&email=<?php echo urlencode($email); ?>">Edit</a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No active packages found.</li>
                <?php endif; ?>
            </ul>
        </main>
    </div>

    

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
    line-height: 1.6; /* Better readability */
}

.container-packages {
   
    max-width: 1200px;
 height:2px;
    margin: 0 auto;
    padding: 20px;
}

/* Header styles */
h1{
    background-color: #161B22; /* Darker header background */
    color: #ffffff;
    padding: 20px 0;
    text-align: center;
    border-bottom: 2px solid #30363D;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Subtle shadow */
}

h1 {
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
p{
    color:#c9d1d9;
}
/* Profile Section */
.profile, .packages, .upload {
    background-color: #161B22;
    padding: 20px;
    margin-bottom: 30px;
    border-radius: 8px;
    border: 1px solid #30363D;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow */
}

.profile h2, .packages h2, .upload h2 {
    color: #58A6FF; /* Blue heading color */
    margin-bottom: 20px;
}

.profile p {
    font-size: 18px;
    margin-bottom: 8px;
    white-space: pre-line; /* Ensures line breaks from text */
}

/* Package List Section */
.package-list {
    list-style: none;
    padding-left: 0;
}

.package-list li {
    background-color: #21262D;
    padding: 20px;
    margin-bottom: 10px;
    border-radius: 8px;
    border: 1px solid #30363D;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Soft shadow */
}

.package-list li:hover {
    transform: translateY(-5px); /* Slight movement on hover */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Hover shadow */
}

.package-list li a {
    color: #58A6FF;
    text-decoration: none;
    font-weight: bold;
    font-size: 18px;
}

.package-list li a:hover {
    text-decoration: underline;
}

/* Package details */
.package-details {
    margin-bottom: 15px;
}

.package-details h3 {
    margin-bottom: 10px;
}

.package-details p {
    margin-bottom: 8px;
    white-space: pre-line; /* Ensures nlbr behavior */
}

/* Aligning image and content in a row format */
.package-list li {
    display: block; /* Stack content in rows */
}

.package-list li img {
    display: block;
    margin: 20px 0; /* Add some space between the image and text */
    border-radius: 8px;
    max-width: 100%; /* Make image responsive */
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
    border-radius: 8px;
    background-color: #0D1117;
    color: white;
    font-size: 16px;
    outline: none;
    transition: border-color 0.3s;
}

form input:focus, form textarea:focus {
    border-color: #1F6FEB; /* Focus state for inputs */
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
    border-radius: 8px;
}

form button:hover {
    background-color: #2585ff;
}



/* Add media query for responsiveness */
@media (max-width: 768px) {
    nav ul {
        flex-direction: column;
        gap: 10px;
    }
}

    </style>