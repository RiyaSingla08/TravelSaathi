<?php
include 'db_connect.php';
include 'header.php';

// Ensure the user is logged in, and get their email
$userEmail = $_SESSION['user_email'] ?? '';
if (empty($userEmail)) {
    echo "<p>Please log in to view your wishlist.</p>";
    exit();
}

// SQL query to fetch liked packages for the user
$sql = "
SELECT td.uniq_id, td.image1, td.start_city, td.destination, td.duration, td.airline, td.package_type, td.itinerary, td.price_per_person, td.sightseeing_details
FROM travel_data td
JOIN favorites f ON td.uniq_id = f.uniq_id
WHERE f.email = ?
";

// Prepare and execute the statement
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    exit();
}

// Bind the email parameter and execute the query
$stmt->bind_param('s', $userEmail);

if (!$stmt->execute()) {
    echo "Error executing query: " . $stmt->error;
    exit();
} else {
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    
    <h1>My Wishlist</h1>
    
    <div class="wishlist-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Generate the URL to the dest_details.php page with uniq_id
                $details_url = "dest_details.php?uniq_id=" . urlencode($row['uniq_id']);
                ?>
                <div class="wishlist-card" data-uniq-id="<?php echo htmlspecialchars($row['uniq_id']); ?>">
                    <a href="<?php echo $details_url; ?>">
                        <img src="<?php echo htmlspecialchars($row['image1']); ?>" alt="Package Image" class="package-card-img">
                    </a>
                    <div class="heart-icon active" onclick="toggleWishlist(this)">
                        <i class="fas fa-heart"></i> <!-- Liked items show as solid red heart -->
                    </div>
                    <h3><?php echo htmlspecialchars($row['start_city']) . " to " . htmlspecialchars($row['destination']); ?></h3>
                    <p><?php echo htmlspecialchars($row['duration']); ?> Nights</p>
                    <p><?php echo htmlspecialchars($row['airline']); ?></p>
                    <p><?php echo htmlspecialchars($row['package_type']); ?></p>
                    <p class="sight"><?php echo htmlspecialchars($row['sightseeing_details']); ?></p>
                    <p class="price-per-person">
                        <?php
                        $pricePerPerson = number_format($row['price_per_person']);
                        echo "₹" . $pricePerPerson . " / Person";
                        ?>
                    </p>
                </div>
                <?php
            }
        } else {
            echo "<p>No packages found in your wishlist.</p>";
        }
        ?>
    </div>
<script>
function toggleWishlist(element) {
    const card = element.closest('.wishlist-card');
    const uniqId = card.getAttribute('data-uniq-id');

    // Send AJAX request to remove the item from the wishlist
    fetch('toggle_wishlist.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'uniq_id=' + encodeURIComponent(uniqId)
    })
    .then(response => response.json())
    .then(data => {
        console.log("Response from server:", data); // Debugging: Log the response

        if (data.success) {
            // Remove the card from the wishlist view if the backend update is successful
            card.remove();
        } else {
            alert(data.message || 'Error removing item from wishlist.');
        }
    })
    .catch(error => console.error('Error:', error));
}

</script>
</body>
</html>


<?php
// Close the statement and the connection
$stmt->close();
$conn->close();
?>
<style>
    h1 {
    color: #ffffff; /* White text color to stand out on a dark background */
    font-size: 36px; /* Adjust size as needed */
    text-align: center; /* Center align the text */
    margin: 20px auto; /* Center the element itself */
    font-family: 'Arial', sans-serif; /* Change the font as per your preference */
    text-transform: uppercase; /* Make the text uppercase for emphasis */
    letter-spacing: 2px; /* Slight spacing between letters */
    border-bottom: 2px solid #ffcc00; /* Adds a yellow underline */
    width: fit-content; /* The width will adjust to fit the text content */
    padding-bottom: 10px;
    display: block; /* Make sure it behaves like a block element for centering */
}


/* Container for wishlist items */
.wishlist-container {
    display: flex;
    flex-wrap: wrap; /* Allow cards to wrap */
    gap: 20px; /* Space between wishlist cards */
    padding: 20px;
    justify-content: center; /* Center the cards horizontally */
    position: relative;
    margin-top: 20px; /* Add space above the wishlist */
}

/* Single definition for wishlist-card */
.wishlist-card {
    background-color: #1a1a1a; /* Matching your package card style */
    width: 400px; /* Set width for each card */
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
    position: relative; /* So the heart icon can be positioned absolutely */
    overflow: hidden; /* Ensure content stays within card */
}

.wishlist-card:hover {
    transform: translateY(-10px); /* Slight lift on hover */
}

/* Heart Icon Styling */
.heart-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    color: #ffcc00; /* Adjust heart color */
    font-size: 24px;
    border-radius: 50%;
    padding: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s, color 0.2s;
    cursor: pointer;
    z-index: 1; /* Ensure heart icon is above other content */
}

.heart-icon.active {
    color: #ff0000; /* Solid red heart for liked items */
}

.heart-icon:hover {
    transform: scale(1.1);
}

/* Styling for package image */
.package-card-img {
    width: 100%;
    height: 180px;
    object-fit: cover; /* Ensure image maintains aspect ratio */
    border-radius: 10px;
}

/* Styling for the text and price inside the wishlist card */
.wishlist-card h3 {
    color: #fff;
    font-size: 18px;
    margin: 10px 0;
}

.wishlist-card p {
    color: #ddd;
    font-size: 14px;
    margin: 5px 0;
}

.price-per-person {
    color: #ffcc00;
    font-size: 16px;
    font-weight: bold;
}

/* Responsive Design for Smaller Screens */
@media (max-width: 768px) {
    .wishlist-card {
        width: 100%; /* Full width on smaller screens */
    }
}


    </style>