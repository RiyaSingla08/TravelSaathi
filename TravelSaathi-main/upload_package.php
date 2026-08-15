<?php
include "db_connect.php"; // Assuming this file connects to the database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escape and prepare form input
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $package_type = mysqli_real_escape_string($conn, $_POST['package_type']);
    $destination = mysqli_real_escape_string($conn, $_POST['destination']);
    $itinerary = mysqli_real_escape_string($conn, $_POST['itinerary']);
    $places_covered = mysqli_real_escape_string($conn, $_POST['places_covered']);
    $travel_date = mysqli_real_escape_string($conn, $_POST['travel_date']);
    $hotel_details = mysqli_real_escape_string($conn, $_POST['hotel_details']);
    $start_city = mysqli_real_escape_string($conn, $_POST['start_city']);
    $airline = mysqli_real_escape_string($conn, $_POST['airline']);
    $price_per_two = mysqli_real_escape_string($conn, $_POST['price_per_two']);
    $price_per_person = mysqli_real_escape_string($conn, $_POST['price_per_person']);
    $sightseeing_details = mysqli_real_escape_string($conn, $_POST['sightseeing_details']);
    $initial_payment = mysqli_real_escape_string($conn, $_POST['initial_payment']);
    $cancellation_rules = mysqli_real_escape_string($conn, $_POST['cancellation_rules']);
    $date_change_rules = mysqli_real_escape_string($conn, $_POST['date_change_rules']);

    // Define the upload folder path
    $uploadDir = 'uploads/';

    // Check if the 'uploads/' directory exists, if not, create it
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);  // Create the directory with full permissions
    }

    // Prepare variables to store image paths
    $image_paths = [];

    // Loop to handle multiple images (image1 to image10)
    for ($i = 1; $i <= 10; $i++) {
        $image_field = 'image' . $i; // image1, image2, ..., image10
        if (isset($_FILES[$image_field]['name']) && $_FILES[$image_field]['name'] != '') {
            $image_name = $_FILES[$image_field]['name'];
            $image_tmp_name = $_FILES[$image_field]['tmp_name'];
            $image_folder = $uploadDir . basename($image_name);

            if (move_uploaded_file($image_tmp_name, $image_folder)) {
                $image_paths[$image_field] = $image_folder; // Store the path
            } else {
                $image_paths[$image_field] = NULL; // In case of failure
            }
        } else {
            $image_paths[$image_field] = NULL; // If no file was uploaded
        }
    }

    // Insert into `travel_data` table
    $stmt = $conn->prepare(
        "INSERT INTO travel_data (
            email, package_name, package_type, destination, itinerary, places_covered, travel_date, hotel_details, start_city, airline, price_per_two, price_per_person, sightseeing_details, initial_payment, cancellation_rules, date_change_rules, image1, image2, image3, image4, image5, image6, image7, image8, image9, image10
        ) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    // Bind parameters for the SQL query
    $stmt->bind_param(
        "ssssssssssddssssssssssssss",
        $email, $package_name, $package_type, $destination, $itinerary, $places_covered, $travel_date, $hotel_details, $start_city, $airline, $price_per_two, $price_per_person, $sightseeing_details, $initial_payment, $cancellation_rules, $date_change_rules,
        $image_paths['image1'], $image_paths['image2'], $image_paths['image3'], $image_paths['image4'], $image_paths['image5'], $image_paths['image6'], $image_paths['image7'], $image_paths['image8'], $image_paths['image9'], $image_paths['image10']
    );

    if ($stmt->execute()) {
        header("Location: view_packages.php?email=" . urlencode($email));
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Tour Package - TravelSaathi</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<?php include "header_company.php" ?>
    <div class="container-upload">
       
            <h1>Upload Tour Package</h1>
        
        <main>
            <form action="upload_package.php" method="POST" enctype="multipart/form-data">
                <!-- Email -->
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <!-- Package Name -->
                <label for="package_name">Package Name:</label>
                <input type="text" id="package_name" name="package_name" required>

                <!-- Package Type -->
                <label for="package_type">Package Type:</label>
                <input type="text" id="package_type" name="package_type" >

                <!-- Destination -->
                <label for="destination">Destination:</label>
                <input type="text" id="destination" name="destination" >

                <!-- Itinerary -->
                <label for="itinerary">Itinerary:</label>
                <textarea id="itinerary" name="itinerary" rows="5" required></textarea>

                <!-- Places Covered -->
                <label for="places_covered">Places Covered:</label>
                <textarea id="places_covered" name="places_covered" rows="5" ></textarea>

                <!-- Travel Date -->
                <label for="travel_date">Travel Date:</label>
                <input type="date" id="travel_date" name="travel_date" >

                <!-- Hotel Details -->
                <label for="hotel_details">Hotel Details:</label>
                <textarea id="hotel_details" name="hotel_details" rows="5" ></textarea>

                <!-- Start City -->
                <label for="start_city">Start City:</label>
                <input type="text" id="start_city" name="start_city" >

                <!-- Airline -->
                <label for="airline">Airline:</label>
                <input type="text" id="airline" name="airline" >

                <!-- Price per Two -->
                <label for="price_per_two">Price per Two People:</label>
                <input type="number" id="price_per_two" name="price_per_two" >

                <!-- Price per Person -->
                <label for="price_per_person">Price per Person:</label>
                <input type="number" id="price_per_person" name="price_per_person" >

                <!-- Sightseeing Details -->
                <label for="sightseeing_details">Sightseeing Details:</label>
                <textarea id="sightseeing_details" name="sightseeing_details" rows="5" ></textarea>

                <!-- Initial Payment -->
                <label for="initial_payment">Initial Payment:</label>
                <input type="number" id="initial_payment" name="initial_payment" >

                <!-- Cancellation Rules -->
                <label for="cancellation_rules">Cancellation Rules:</label>
                <textarea id="cancellation_rules" name="cancellation_rules" rows="5" ></textarea>

                <!-- Date Change Rules -->
                <label for="date_change_rules">Date Change Rules:</label>
                <textarea id="date_change_rules" name="date_change_rules" rows="5" ></textarea>

                <!-- Image Uploads -->
                <label for="package_images">Upload Images (up to 10):</label>
                <input type="file" id="image1" name="image1" accept="image/*">
                <input type="file" id="image2" name="image2" accept="image/*">
                <input type="file" id="image3" name="image3" accept="image/*">
                <input type="file" id="image4" name="image4" accept="image/*">
                <input type="file" id="image5" name="image5" accept="image/*">
                <input type="file" id="image6" name="image6" accept="image/*">
                <input type="file" id="image7" name="image7" accept="image/*">
                <input type="file" id="image8" name="image8" accept="image/*">
                <input type="file" id="image9" name="image9" accept="image/*">
                <input type="file" id="image10" name="image10" accept="image/*">

                <!-- Submit Button -->
                <button type="submit">Upload Package</button>
            </form>
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
}

.container-upload {
    max-width: 2500px;
    height:500px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    background-color: #161B22; 
    color: #ffffff;
    padding: 20px 0;
    text-align: center;
    border-bottom: 2px solid #30363D;
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



    </style>