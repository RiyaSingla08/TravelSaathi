<?php
include 'db_connect.php';

// Retrieve search inputs
$start_city = $_GET['start_city'] ?? '';
$destination = $_GET['destination'] ?? '';
$travel_date = $_GET['travel_date'] ?? '';
$rooms_guests = $_GET['rooms_guests'] ?? '1';
$airline = $_GET['airline'] ?? '';
$package_type = $_GET['package_type'] ?? '';
$min_duration = $_GET['min_duration'] ?? 1;
$max_duration = $_GET['max_duration'] ?? 9;
$budget = $_GET['budget'] ?? 215000;

// Set price column based on rooms/guests input
$price_column = ($rooms_guests === '2') ? 'price_per_two' : 'price_per_person';

// Check which button was clicked
if (isset($_GET['search'])) {
    // Query for search (only search criteria)
    $sql = "SELECT *, 
            (SELECT SUM(CAST(SUBSTRING_INDEX(itinerary, ' ', -1) AS UNSIGNED)) 
             FROM travel_data WHERE uniq_id = travel_data.uniq_id) AS total_duration
            FROM travel_data 
            WHERE (start_city LIKE ? OR destination LIKE ? OR travel_date = ?)
            AND $price_column IS NOT NULL
            ORDER BY 
            (CASE WHEN start_city LIKE ? THEN 1 ELSE 0 END) + 
            (CASE WHEN destination LIKE ? THEN 1 ELSE 0 END) DESC,
            $price_column ASC";
    
    $params = [
        '%' . $start_city . '%',
        '%' . $destination . '%',
        $travel_date,
        '%' . $start_city . '%',
        '%' . $destination . '%'
    ];
    $types = 'sssss';

} elseif (isset($_GET['apply_filter'])) {
    // Query for filters + search
    $sql = "SELECT *, 
            (SELECT SUM(CAST(SUBSTRING_INDEX(itinerary, ' ', -1) AS UNSIGNED)) 
             FROM travel_data WHERE uniq_id = travel_data.uniq_id) AS total_duration,
            (
              (start_city LIKE ?) +
              (destination LIKE ?) +
              (travel_date = ?) +
              (airline LIKE ?) +
              (package_type LIKE ?)
            ) AS match_score
            FROM travel_data 
            WHERE ((start_city LIKE ? OR destination LIKE ? OR travel_date = ? OR airline LIKE ? OR package_type LIKE ?)
            AND (SELECT SUM(CAST(SUBSTRING_INDEX(itinerary, ' ', -1) AS UNSIGNED)) 
                  FROM travel_data WHERE uniq_id = travel_data.uniq_id) BETWEEN ? AND ? 
            AND $price_column <= ?)
            HAVING match_score > 0
            ORDER BY 
            (CASE WHEN start_city LIKE ? THEN 1 ELSE 0 END) + 
            (CASE WHEN destination LIKE ? THEN 1 ELSE 0 END) DESC,
            match_score DESC, $price_column ASC";
    
    $params = [
        '%' . $start_city . '%',
        '%' . $destination . '%',
        $travel_date,
        '%' . $airline . '%',
        '%' . $package_type . '%',
        '%' . $start_city . '%',
        '%' . $destination . '%',
        $travel_date,
        '%' . $airline . '%',
        '%' . $package_type . '%',
        $min_duration,
        $max_duration,
        $budget,
        '%' . $start_city . '%',
        '%' . $destination . '%'
    ];
    $types = str_repeat('s', 5) . str_repeat('s', 5) . 'iidss';

} else {
    // If neither button is clicked, default SQL query to fetch all packages without any filtering
    $sql = "SELECT *, 
            (SELECT SUM(CAST(SUBSTRING_INDEX(itinerary, ' ', -1) AS UNSIGNED)) 
             FROM travel_data WHERE uniq_id = travel_data.uniq_id) AS total_duration
            FROM travel_data
            ORDER BY 
            (CASE WHEN start_city LIKE ? THEN 1 ELSE 0 END) + 
            (CASE WHEN destination LIKE ? THEN 1 ELSE 0 END) DESC,
            $price_column ASC";
    
    $params = [
        '%' . $start_city . '%',
        '%' . $destination . '%'
    ];
    $types = 'ss'; // Only two parameters
}

// Prepare and execute the statement
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    exit();
}

// Bind parameters if any
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

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
    <title>Tour Packages</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="search-bar">
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
                    <div class="filter-item">
                        <h4>Duration (in Nights)</h4>
                        <input type="range" min="1" max="9" value="<?php echo $min_duration; ?>" name="min_duration" class="slider" id="durationRange">
                        <p>Min: <span id="min-duration-value"><?php echo $min_duration; ?></span></p>
                    </div>

                    <div class="filter-item">
                        <h4>Total Duration</h4>
                        <input type="range" min="1" max="9" value="<?php echo $max_duration; ?>" name="max_duration" class="slider" id="totalDurationRange" oninput="updateDurationValue(this.value)">
                        <p>Max: <span id="max-duration-value"><?php echo $max_duration; ?></span></p>
                    </div>

                    <div class="filter-item">
                        <h4>Budget (per person)</h4>
                        <input type="range" min="15000" max="215000" step="1000" value="<?php echo $budget; ?>" name="budget" class="slider" id="budgetRange" oninput="updateBudgetValue(this.value)">
                        <p>₹ <span id="budget-value"><?php echo number_format($budget); ?></span></p>
                    </div>

                    <div class="filter-item">
                        <h4>Airlines</h4>
                        <input type="text" name="airline" value="<?php echo htmlspecialchars($airline); ?>" placeholder="e.g. Indigo">
                    </div>

                    <div class="filter-item">
                        <h4>Package Type</h4>
                        <input type="text" name="package_type" value="<?php echo htmlspecialchars($package_type); ?>" placeholder="e.g. Premium">
                    </div>

                    <!-- Apply Filter Button -->
                    <button type="submit" name="apply_filter" class="apply-filter-btn">Apply Filter</button>
                </div>
            </form>
        </aside>

        <main>
            <div class="tabs">
                <button class="tab-btn active">All Packages</button>
                <button class="tab-btn">Budget-Friendly</button>
                <button class="tab-btn">Adventure</button>
                <button class="tab-btn">Best Sellers</button>
                <button class="tab-btn">Honeymoon</button>
            </div>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="package-card">
                        <h3><?php echo htmlspecialchars($row['start_city']) . " to " . htmlspecialchars($row['destination']); ?></h3>
                        <p>Duration: <?php echo htmlspecialchars($row['total_duration']); ?> Nights</p>
                        <p>Price per Person: ₹<?php echo number_format($row['price_per_person']); ?></p>
                        <p>Airline: <?php echo htmlspecialchars($row['airline']); ?></p>
                        <p>Package Type: <?php echo htmlspecialchars($row['package_type']); ?></p>
                        <p>Itinerary: <?php echo nl2br(htmlspecialchars($row['itinerary'])); ?></p>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No packages found matching your criteria.</p>";
            }
            ?>
        </main>
    </div>

    <script>
        function updateBudgetValue(value) {
            document.getElementById('budget-value').innerText = new Intl.NumberFormat('en-IN').format(value);
        }

        function updateDurationValue(value) {
            document.getElementById('max-duration-value').innerText = value;
        }

        // Update the displayed value for minimum duration
        document.getElementById('durationRange').oninput = function() {
            document.getElementById('min-duration-value').innerText = this.value;
        };
    </script>
</body>
</html>

<?php $conn->close(); ?>










<style>
 /* Basic Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #0d0d0d; /* Dark background similar to TravelSaathi */
    color: white;
}

/* Header */
header {
    background-color: #1a1a1a; /* Dark header */
    padding: 20px 343px;
    display: flex;
    justify-content: space-between;
    align-items: center;
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

/* Filters */
.container {
    display: flex;
    margin: 20px;
}

aside {
    width: 20%;
}

.filters {
    background-color: #1a1a1a;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

.filters h3 {
    color: #00d2ff;
}

.filter-item {
    margin-bottom: 25px;
}

.filter-item h4 {
    color: #00d2ff;
}

.slider {
    width: 100%;
    background-color: #333333;
}

.flight-btn {
    padding: 10px 15px;
    background-color: #333333;
    color: white;
    border: 1px solid #555;
    margin-right: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.flight-btn:hover {
    background-color: #00d2ff;
}

input[type="checkbox"] {
    margin-right: 10px;
}

/* Package Tabs */
main {
    width: 80%;
    padding-left: 30px;
}

.tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.tab-btn {
    padding: 10px 20px;
    border: none;
    background-color: #1f1f1f;
    color: white;
    cursor: pointer;
    border-radius: 20px;
    transition: background-color 0.3s ease;
}

.tab-btn:hover, .tab-btn.active {
    background-color: #00d2ff;
}

/* Package Cards */
.packages {
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
}

.package-card {
    background-color: #1a1a1a;
    width: 45%;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
    transition: transform 0.3s ease;
}

.package-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6);
}

.package-card img {
    width: 100%;
    height: 180px;
    border-radius: 10px;
    object-fit: cover;
}

.package-card h3 {
    margin-top: 10px;
    color: #00d2ff;
}

.package-card ul {
    list-style-type: none;
    margin-top: 10px;
    color: #bbbbbb;
}

.package-card li {
    margin-bottom: 5px;
}

.package-card p {
    margin: 5px 0;
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

</style>