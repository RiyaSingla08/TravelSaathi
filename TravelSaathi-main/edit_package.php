<?php
$email = isset($_GET['email']) ? urlencode($_GET['email']) : '';
?>
<?php
include 'db_connect.php'; // Include your database connection

// Check if the package ID and email are provided
if (isset($_GET['uniq_id']) && isset($_GET['email'])) {
    $uniq_id = mysqli_real_escape_string($conn, $_GET['uniq_id']);
    $email = mysqli_real_escape_string($conn, $_GET['email']);

    // Fetch the package details based on the ID
    $query = "SELECT * FROM travel_data WHERE uniq_id = '$uniq_id' AND email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $package = mysqli_fetch_assoc($result);
    } else {
        echo "Package not found.";
        exit();
    }
} else {
    echo "No package ID or email provided.";
    exit();
}

// Handle the form submission to update the package
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fields = [
        'package_name', 'package_type', 'destination', 'itinerary', 'duration', 'places_covered', 
        'travel_date', 'hotel_details', 'start_city', 'airline', 'price_per_two', 'price_per_person', 
        'sightseeing_details', 'Initial_Payment', 'Cancellation_Rules', 'Date_Change_Rules'
    ];

    foreach ($fields as $field) {
        $$field = mysqli_real_escape_string($conn, $_POST[$field]);
    }

    // Handle file upload for multiple images
    $image_paths = [];
    for ($i = 1; $i <= 10; $i++) {
        $image_field = "image" . $i;
        if (isset($_FILES[$image_field]) && $_FILES[$image_field]['error'] == 0) {
            $target_dir = "uploads/";
            $image_name = basename($_FILES[$image_field]["name"]);
            $target_file = $target_dir . $image_name;
            move_uploaded_file($_FILES[$image_field]["tmp_name"], $target_file);
            $image_paths[$image_field] = $target_file;
        } else {
            $image_paths[$image_field] = $package[$image_field];
        }
    }

    // Build the update query
    $updateQuery = "UPDATE travel_data SET ";
    foreach ($fields as $field) {
        $updateQuery .= "$field = '" . $$field . "', ";
    }

    // Add image paths to the query
    foreach ($image_paths as $image_field => $path) {
        $updateQuery .= "$image_field = '$path', ";
    }

    // Remove trailing comma and space
    $updateQuery = rtrim($updateQuery, ', ');
    $updateQuery .= " WHERE uniq_id = '$uniq_id' AND email = '$email'";

    if (mysqli_query($conn, $updateQuery)) {
        // Redirect back to view_packages.php after successful update
        header("Location: view_packages.php?email=" . urlencode($email));
        exit();
    } else {
        echo "Error updating package: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tour Package</title>
    <link rel="stylesheet" > 
</head>
<body>

    <div class="container">
        <header>
            <h1>Edit Tour Package</h1>
        </header>
        <main>
            <form action="edit_package.php?uniq_id=<?php echo $uniq_id; ?>&email=<?php echo urlencode($email); ?>" method="POST" enctype="multipart/form-data">
                <label for="package_name">Package Name:</label>
                <input type="text" id="package_name" name="package_name" value="<?php echo $package['package_name']; ?>">

                <label for="package_type">Package Type:</label>
                <input type="text" id="package_type" name="package_type" value="<?php echo $package['package_type']; ?>" >

                <label for="destination">Destination:</label>
                <textarea id="destination" name="destination" rows="4" ><?php echo $package['destination']; ?></textarea>

                <label for="itinerary">Itinerary:</label>
                <textarea id="itinerary" name="itinerary" rows="4" ><?php echo $package['itinerary']; ?></textarea>

                <label for="duration">Duration (days):</label>
                <input type="number" id="duration" name="duration" value="<?php echo $package['duration']; ?>" >

                <label for="places_covered">Places Covered:</label>
                <input type="text" id="places_covered" name="places_covered" value="<?php echo $package['places_covered']; ?>" >

                <label for="travel_date">Travel Date:</label>
                <input type="date" id="travel_date" name="travel_date" value="<?php echo $package['travel_date']; ?>" >

                <label for="hotel_details">Hotel Details:</label>
                <input type="text" id="hotel_details" name="hotel_details" value="<?php echo $package['hotel_details']; ?>" >

                <label for="start_city">Start City:</label>
                <input type="text" id="start_city" name="start_city" value="<?php echo $package['start_city']; ?>" >

                <label for="airline">Airline:</label>
                <input type="text" id="airline" name="airline" value="<?php echo $package['airline']; ?>" >

                <label for="price_per_two">Price per Two (₹):</label>
                <input type="number" id="price_per_two" name="price_per_two" value="<?php echo $package['price_per_two']; ?>" >

                <label for="price_per_person">Price per Person (₹):</label>
                <input type="number" id="price_per_person" name="price_per_person" value="<?php echo $package['price_per_person']; ?>" >

                <label for="sightseeing_details">Sightseeing Details:</label>
                <textarea id="sightseeing_details" name="sightseeing_details" rows="4"><?php echo $package['sightseeing_details']; ?></textarea>

                <label for="Initial_Payment">Initial Payment(₹):</label>
                <input type="number" id="Initial_Payment" name="Initial_Payment" value="<?php echo $package['Initial_Payment']; ?>">

                <label for="Cancellation_Rules">Cancellation Rules:</label>
                <textarea id="Cancellation_Rules" name="Cancellation_Rules" rows="4"><?php echo $package['Cancellation_Rules']; ?></textarea>

                <label for="Date_Change_Rules">Date Change Rules:</label>
                <textarea id="Date_Change_Rules" name="Date_Change_Rules" rows="4"><?php echo $package['Date_Change_Rules']; ?></textarea>

                <!-- Image uploads for all 10 images -->
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <label for="image<?php echo $i; ?>">Image <?php echo $i; ?>:</label>
                    <?php if (!empty($package["image$i"])): ?>
                        <p>Current Image <?php echo $i; ?>:</p>
                        <img src="<?php echo $package["image$i"]; ?>" alt="Image <?php echo $i; ?>" width="150px">
                    <?php endif; ?>
                    <input type="file" id="image<?php echo $i; ?>" name="image<?php echo $i; ?>" accept="image/*">
                <?php endfor; ?>

                <!-- Hidden fields for ID and email -->
                <input type="hidden" name="package_id" value="<?php echo $uniq_id; ?>">
                <input type="hidden" name="company_email" value="<?php echo $email; ?>">

                <button type="submit">Update Package</button>
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