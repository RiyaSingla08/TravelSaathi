<?php
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

include 'db_connect.php';
include "header.php";

// Retrieve search inputs
$start_city   = $_GET['start_city']   ?? '';
$destination  = $_GET['destination']  ?? '';
$travel_date  = $_GET['travel_date']  ?? '';
$rooms_guests = $_GET['rooms_guests'] ?? '1';
$airline      = $_GET['airline']      ?? '';
$package_type = $_GET['package_type'] ?? '';
$max_duration = $_GET['max_duration'] ?? 9;
$budget       = $_GET['budget']       ?? 215000;

// Set price column based on rooms/guests input
$price_column = ($rooms_guests === '2') ? 'price_per_two' : 'price_per_person';

// Handle empty airline and package type
$airline      = empty($airline) ? '%' : '%' . $airline . '%';
$package_type = empty($package_type) ? '%' : '%' . $package_type . '%';

// Get the logged-in user's email from the session
$userEmail = $_SESSION['user_email'] ?? '';

// SQL query
$sql = "
SELECT td.uniq_id, td.image1, td.start_city, td.destination, td.duration, td.airline, td.package_type, td.itinerary, $price_column, td.sightseeing_details,
       IF(f.email IS NOT NULL, 1, 0) AS is_favorite,
       (
           (td.start_city LIKE ?) * 6 +
           (td.destination LIKE ?) * 6 +
           (td.travel_date = ?) * 2
       ) AS match_score
FROM travel_data td
LEFT JOIN favorites f ON td.uniq_id = f.uniq_id AND f.email = ?
WHERE (
        (td.start_city LIKE ? OR td.destination LIKE ? OR td.travel_date = ?)
    )
AND td.duration BETWEEN 1 AND ?
AND $price_column IS NOT NULL
AND $price_column <= ?
AND td.airline LIKE ?
AND td.package_type LIKE ?
HAVING match_score > 0
ORDER BY match_score DESC, $price_column ASC";

// Parameters
$params = [
    '%' . $start_city . '%',   // 1. start_city match_score
    '%' . $destination . '%',  // 2. destination match_score
    $travel_date,              // 3. travel_date match_score
    $userEmail,                // 4. user email
    '%' . $start_city . '%',   // 5. start_city WHERE
    '%' . $destination . '%',  // 6. destination WHERE
    $travel_date,              // 7. travel_date WHERE
    $max_duration,             // 8. max_duration
    $budget,                   // 9. budget
    $airline,                  // 10. airline
    $package_type              // 11. package_type
];

// Types (11 params → sssssssidss)
$types = 'sssssssidss';

// Prepare statement
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    exit();
}

// Bind BEFORE execute
$stmt->bind_param($types, ...$params);

// Execute
if (!$stmt->execute()) {
    echo "Error executing query: " . $stmt->error;
    exit();
} else {
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "<pre>DEBUG: No rows found\n";
        echo "Start City: $start_city\n";
        echo "Destination: $destination\n";
        echo "Travel Date: $travel_date\n";
        echo "Budget: $budget\n";
        echo "Max Duration: $max_duration\n";
        echo "Airline: $airline\n";
        echo "Package Type: $package_type\n</pre>";
    } else {
        // Example loop to display packages
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h3>" . htmlspecialchars($row['destination']) . " (" . htmlspecialchars($row['start_city']) . ")</h3>";
            echo "<p>Airline: " . htmlspecialchars($row['airline']) . "</p>";
            echo "<p>Package: " . htmlspecialchars($row['package_type']) . "</p>";
            echo "<p>Duration: " . htmlspecialchars($row['duration']) . " nights</p>";
            echo "<p>Price: " . htmlspecialchars($row[$price_column]) . "</p>";
            echo "</div><hr>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Packages</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="search-bar">
            <!-- Update your form method in the header section -->
<form method="GET" action="">
    <input type="text" name="start_city" value="<?php echo htmlspecialchars($start_city); ?>" placeholder="Starting From">
    <input type="text" name="destination" value="<?php echo htmlspecialchars($destination); ?>" placeholder="Going To">
    <input type="date" name="travel_date" value="<?php echo htmlspecialchars($travel_date); ?>" placeholder="Starting Date">
    <input type="text" name="rooms_guests" value="<?php echo htmlspecialchars($rooms_guests); ?>" placeholder="Rooms & Guests">
    
    <!-- Search Button -->
    <button type="submit" name="search" class="search-btn">Search</button>
</form>

        </div>
    </header>

    <div class="container">
    <aside>
    <form method="GET" action="">
        <div class="filters">
            <h3>Filters</h3>

            <!-- Hidden inputs to retain search data -->
            <input type="hidden" name="start_city" value="<?php echo htmlspecialchars($start_city); ?>">
            <input type="hidden" name="destination" value="<?php echo htmlspecialchars($destination); ?>">
            <input type="hidden" name="travel_date" value="<?php echo htmlspecialchars($travel_date); ?>">
            <input type="hidden" name="rooms_guests" value="<?php echo htmlspecialchars($rooms_guests); ?>">

            <!-- Duration Filter -->
            <div class="filter-item">
                <h4>Total Duration (in Nights)</h4>
                <input type="range" min="1" max="9" value="<?php echo $max_duration; ?>" name="max_duration" class="slider" id="totalDurationRange" oninput="updateDurationValue(this.value)">
                <p>Max: <span id="max-duration-value"><?php echo $max_duration; ?></span></p>
            </div>

            <!-- Budget Filter -->
            <div class="filter-item">
                <h4>Budget (per person)</h4>
                <input type="range" min="3000" max="70000" step="500" value="<?php echo $budget; ?>" name="budget" class="slider" id="budgetRange" oninput="updateBudgetValue(this.value)">
                <p>₹ <span id="budget-value"><?php echo number_format($budget); ?></span></p>
            </div>

            <!-- Airline Filter -->
            <div class="filter-item">
                <h4>Airlines</h4>
                <select name="airline">
                    <option value="">Select Airline</option>
                    <option value="Indigo" <?php if (trim($airline, '%') == 'Indigo') echo 'selected'; ?>>Indigo</option>
                    <option value="SpiceJet" <?php if (trim($airline, '%') == 'SpiceJet') echo 'selected'; ?>>SpiceJet</option>
                    <option value="Vistara" <?php if (trim($airline, '%') == 'Vistara') echo 'selected'; ?>>Vistara</option>
                    <option value="Air India" <?php if (trim($airline, '%') == 'Air India') echo 'selected'; ?>>Air India</option>
                </select>
            </div>

            <!-- Package Type Filter -->
            <div class="filter-item">
                <h4>Package Type</h4>
                <select name="package_type">
                    <option value="">Select Package Type</option>
                    <option value="Standard" <?php if (trim($package_type, '%') == 'Standard') echo 'selected'; ?>>Standard</option>
                    <option value="Deluxe" <?php if (trim($package_type, '%') == 'Deluxe') echo 'selected'; ?>>Deluxe</option>
                    <option value="Premium" <?php if (trim($package_type, '%') == 'Premium') echo 'selected'; ?>>Premium</option>
                    <option value="Luxury" <?php if (trim($package_type, '%') == 'Luxury') echo 'selected'; ?>>Luxury</option>
                </select>
            </div>

            <!-- Apply Filter Button -->
            <button type="submit" name="apply_filter" class="search-btn">Apply Filter</button>
        </div>
    </form>
</aside>

<main class="package-item">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Generate the URL to the dest_details.php page with uniq_id
            $details_url = "dest_details.php?uniq_id=" . urlencode($row['uniq_id']);

            // Determine heart icon class based on favorite status
            $heartClass = $row['is_favorite'] ? 'fas fa-heart active' : 'far fa-heart';
            ?>
            <div class="package-card">
                <!-- Wrap only the image in the link -->
                <a href="<?php echo $details_url; ?>" class="package-card-link">
                    <img src="<?php echo htmlspecialchars($row['image1']); ?>" alt="Package Image" class="package-card-img">
                </a>
                <!-- Render heart icon with red color if already liked -->
                <div class="heart-icon <?php echo $row['is_favorite'] ? 'active' : ''; ?>" onclick="toggleHeart(this)">
                    <i class="<?php echo $heartClass; ?>"></i>
                </div>
                <!-- Wrap only the text in the link -->
                <a href="<?php echo $details_url; ?>" class="package-card-link">
                    <h3><?php echo htmlspecialchars($row['start_city']) . " to " . htmlspecialchars($row['destination']); ?></h3>
                    <p><?php echo htmlspecialchars($row['duration']); ?> Nights</p>
                    <p><?php echo htmlspecialchars($row['airline']); ?></p>
                    <p><?php echo htmlspecialchars($row['package_type']); ?></p>
                    <p class="sight"><?php echo htmlspecialchars($row['sightseeing_details']); ?></p>
                    <p class="price-per-person">
                        <?php
                        $pricePerPerson = number_format($row[$price_column]);
                        echo "₹" . $pricePerPerson . " / Person";
                        ?>
                    </p>
                    <p class="total-price">
                        <?php
                        if ($price_column === 'price_per_two') {
                            $totalPrice = 2 * $row['price_per_two'];
                        } else {
                            $totalPrice = 2 * $row['price_per_person'];
                        }
                        echo "Total Price: ₹" . number_format($totalPrice);
                        ?>
                    </p>
                </a>
            </div>
            <?php
        }
    } else {
        echo "<p>No packages found matching your criteria.</p>";
    }
    ?>
</main>


</div>

  <?php include "footer.php"; ?> 
</body>
</html> 









<script>

function toggleHeart(element) {
    element.classList.toggle('active');
    let icon = element.querySelector('i');
    if (icon.classList.contains('far')) {
        icon.classList.remove('far');
        icon.classList.add('fas');
    } else {
        icon.classList.remove('fas');
        icon.classList.add('far');
    }

    // Get package ID from closest package card instead of link
    let packageCard = element.closest('.package-card');
    let uniq_id = packageCard.querySelector('.package-card-link').href.split('uniq_id=')[1];

    // Get user email from the session in PHP
    let userEmail = "<?php echo $_SESSION['user_email'] ?? ''; ?>";

    // Send an AJAX request to save the favorite
    fetch('save_favorite.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ uniq_id: uniq_id, email: userEmail, favorite: icon.classList.contains('fas') })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Favorite status updated successfully.');
        } else {
            console.error('Error updating favorite status.');
        }
    })
    .catch(error => console.error('Error:', error));
}


</script>





<style>
    .heart-icon.active i {
        color: red;
    }
    /* Heart icon styling - always visible */
.heart-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    color: #e74c3c;
    font-size: 24px;

    border-radius: 50%;
    padding: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s;
    cursor: pointer;
}

.heart-icon:hover {
    transform: scale(1.1);
}

.heart-icon.active {
    color: #e74c3c;
}

/* Package card styling */
.package-card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease;
    width: 280px;
    position: relative;
}

.package-card:hover {
    transform: translateY(-10px);
}





 :root {
    --primary-bg: #0d0d0d;
    --filter-bg: #1a1a1a;
    --highlight-color: #00d2ff;
    --text-color: white;
}

/* Basic Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: var(--primary-bg);
    color: var(--text-color);
}

/* Header */
header {
    background-color: #0d0d0d; /* Dark header */
    padding: 20px 343px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 1000; /* Ensure it stays above other elements */

}


header h1 {
    color: #ffffff;
    font-weight: bold;
    font-size: 1.8rem;
}

header .search-bar {
    display: flex;
    justify-content: center;
    gap: 15px;
    position: sticky;
    top: 20px; /* Adjust as needed based on header height */
}


.search-bar input {
    padding: 12px;
    background-color: #333333; /* Dark input background */
    color: white;
    border: 1px solid #555;
    border-radius: 5px;
}

.search-bar input::placeholder {
    color: #bbbbbb;
}

.search-btn {
    padding: 12px 20px;
    background: linear-gradient(45deg, #00d2ff, #3a7bd5); /* Gradient button */
    border: none;
    color: white;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.search-btn:hover {
    background: linear-gradient(45deg, #0072ff, #00d2ff); /* Hover effect */
}

<style>


/* Main layout container */
.container {
    display: flex;
    
    min-height: 150vh;
}

/* Sidebar */
aside {
    width: 20%;
    margin-left: 10px;
    position: sticky; /* Make the sidebar sticky */
    top: 101px; /* Distance from the top of the viewport */
    margin-top:30px;
}

/* Filters styling */
.filters {
    background-color: var(--filter-bg);
    padding: 20px;
    
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

/* Filter Titles */
.filters h3, .filter-item h4 {
    color: var(--highlight-color);
}

.filter-item {
    margin-bottom: 25px;
}

.filter-item select {
    width: 100%;
    padding: 10px;
    border: 1px solid var(--highlight-color);
    border-radius: 5px;
    background-color: #333;
    color: #fff;
    outline: none;
    transition: border-color 0.3s ease;
}

.filter-item select:focus {
    border-color: var(--highlight-color);
}

.slider {
    width: 100%;
    background-color: #333333;
}

.search-btn, .flight-btn {
    padding: 10px 15px;
    background-color: #333333;
    color: white;
    border: 1px solid #555;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-btn:hover, .flight-btn:hover {
    background-color: var(--highlight-color);
}

input[type="range"] {
    width: 100%;
}

input[type="checkbox"] {
    margin-right: 50px;
}

/* Package Tabs */
main {
    width: 80%;
    padding-left: 30px;
    margin: -425px 308px;
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    
}

/* Main container for the package cards */
.package-item {
    display: flex;
    flex-wrap: wrap;
    gap: 25px; /* Adjust spacing between cards */
    justify-content: space-evenly; /* Center cards in rows */
}

/* Package card container */
.package-card {
    
    background-color: #1a1a1a;
    width: 493px;
    
    padding: 37px;
    font-size:16px;
    border-radius: 15px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
    transition: transform 0.3s ease;
    margin-right:35px;
}

a.package-card-link {
    text-decoration: none;
    color: inherit;
}

/* Hover effect */
.package-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6);
}

/* Consistent styling for images in each package card */
.package-card-img {
    width: 100%; /* Set width to cover the full width of the card */
    height: 180px;
    border-radius: 10px;
    object-fit: cover;
    margin-bottom: 10px;
}

.package-card h3 {
    margin-top: 10px;
    color: #00d2ff;
}

.package-card p {
    margin: 5px 0;
    color: #bbbb;
}
p.sight {
    margin: 5px 0;
    font-size:16px;
    color:#fff ;
}

/* Responsive styling for smaller screens */
@media (max-width: 768px) {
    .package-card {
        width: 100%; /* Full width on smaller screens */
    }
}

.price {
    margin-top: 10px;
    font-size: 1.2rem;
    font-weight: bold;
    color: #ff9100; /* Bright price text */
}

.total-price {
    color: #ff3d00;
}

/* Budget Display */
#budget-value {
    color: #00d2ff;
    font-weight: bold;
}

p.price-per-person {
    color: orange; /* Set the color for price per person */
    font-size: 18px; /* Adjust the size as needed */
    font-weight: bold; /* Make it bold */
    margin: 0; /* Remove default margin */
}

p.total-price {
    color: red; /* Set the color for total price */
    font-size: 16px; /* Adjust the size as needed */
    font-weight: bold; /* Make it bold */
    margin: 0; /* Remove default margin */
}



</style>






