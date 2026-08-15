<?php
// Database connection
include "db_connect.php";

// Capture uniq_id from URL
$uniq_id = isset($_GET['uniq_id']) ? $_GET['uniq_id'] : null;

if ($uniq_id) {
    // Fetch package details using uniq_id
    // Updated SQL Query to include price_per_person and price_per_two
$sql = "SELECT package_name, itinerary, places_covered, hotel_details, sightseeing_details, Cancellation_Rules, Date_Change_Rules,
image1, image2, image3, image4, image5, image6, image7, image8, image9, image10, 
price_per_person, price_per_two
FROM travel_data WHERE uniq_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $uniq_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Prepare itinerary content with day subheadings
        $itineraryContent = '';
        $itineraryArray = explode("\n", $row['itinerary']);
        foreach ($itineraryArray as $line) {
            if (strpos($line, "Day") !== false) {
                $itineraryContent .= "<br><h3>$line</h3>";
            } else {
                $itineraryContent .= "<p>$line</p>";
            }
        }

        // Images
        $imageContent = '';
        for ($i = 1; $i <= 10; $i++) {
            $imageCol = 'image' . $i;
            if (!empty($row[$imageCol])) {
                $imageContent .= "<img src='/" . htmlspecialchars($row[$imageCol]) . "' alt='Image $i' onerror=\"this.src='/images/placeholder.jpg';\">";
            }
        }
    } else {
        echo "<p>Package not found.</p>";
    }
    $stmt->close();
} else {
    echo "<p>Invalid package ID.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serene Bali</title>
 
</head>
<body>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($row['package_name']) ?> Package</title>
    <link rel="stylesheet" href="styles.css"> <!-- Your existing CSS -->
</head>
<body>
<section>
        <?php include "header.php"; ?>
</section>
<div class="container">
    <!-- Left Section: Main Content -->
    <div class="left-section">
        <!-- Destination Heading -->
        <div class="heading"><?= htmlspecialchars($row['package_name']) ?></div>

        <!-- Image Gallery -->
        <div class="gallery">
            <?= $imageContent ?>
        </div>
        <br><br>
        
        <!-- Tabs: Itinerary, Policies -->
        <div class="tabs">
            <button class="active" data-tab="itinerary">Itinerary</button>
            <button data-tab="policies">Policies</button>
            <button data-tab="summary">Summary</button>
        </div>

        <!-- Itinerary Content -->
        <div id="itinerary" class="tab-content active">
            <div class="details">
                <?= $itineraryContent ?>
            </div>
        </div>

        <!-- Policies Content -->
        <div id="policies" class="tab-content">
            <div class="details">
                <h3>Cancellation Policy</h3>
                <p><?= htmlspecialchars($row['Cancellation_Rules']) ?></p><br>
                <h3>Date Change Rules</h3>
                <p><?= htmlspecialchars($row['Date_Change_Rules']) ?></p>
            </div>
        </div>

        <!-- Summary Content -->
<div id="summary" class="tab-content">
    <div class="details">
        <h3>Places Covered</h3>
        <?php 
            $placesCovered = explode('.', $row['places_covered']);
            foreach ($placesCovered as $sentence) {
                if (trim($sentence)) {
                    echo "<p>" . htmlspecialchars(trim($sentence)) . ".</p>";
                }
            }
        ?><br>

        <h3>Hotel Details</h3>
        <?php 
            $hotelDetails = explode('.', $row['hotel_details']);
            foreach ($hotelDetails as $sentence) {
                if (trim($sentence)) {
                    echo "<p>" . htmlspecialchars(trim($sentence)) . ".</p>";
                }
            }
        ?><br>

        <h3>Sightseeing Details</h3>
        <?php 
            $sightseeingDetails = explode('.', $row['sightseeing_details']);
            foreach ($sightseeingDetails as $sentence) {
                if (trim($sentence)) {
                    echo "<p>" . htmlspecialchars(trim($sentence)) . ".</p>";
                }
            }
        ?>
    </div>
</div>


    <!-- Right Section: Payment and Offer Details -->
    <div class="right-section">
        <div class="price-box">₹<?= htmlspecialchars($row['price_per_person']) ?>/Person</div>
        <div class="discount">12% OFF</div>
        <a href="checkout.php?uniq_id=<?php echo $uniq_id; ?>">
    <button type="button" class="payment-button">Checkout</button>
</a>
        <div class="coupon-box">
            <div class="coupon-title">Coupons & Offers</div>
            <div class="coupon"><strong>GRANDOFFER</strong> - ₹5,817 Off</div>
            <div class="coupon"><strong>FEDERALEMI</strong> - ₹8,554 Off</div>
        </div>
    </div>
</div>


<script>
// JavaScript for tab switching
const tabs = document.querySelectorAll('.tabs button');
const tabContents = document.querySelectorAll('.tab-content');

tabs.forEach(tab => {
    tab.addEventListener('click', function() {
        tabs.forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');

        tabContents.forEach(content => content.classList.remove('active'));
        document.getElementById(this.getAttribute('data-tab')).classList.add('active');
    });
});
</script>

</body>
</html>


</body>
</html>
<style>
   /* General Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #0d0d0d; /* Dark background */
    color: #f1f1f1; /* Light text for contrast */
}

.container {
    position: relative; /* Set position relative for absolute positioning of child elements */
    max-width: 1277px;
    margin: 20px 140px;
}

/* Left section for details */
.left-section {
    flex: 3;
    width: 902px;
    background-color: #111; /* Darker background for left section */
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* Deeper shadow for more depth */
}

/* Position the right section */
.right-section {
    position: absolute; /* Position it absolutely */
    top: 20px; /* Align it to the top */
    right: 0px; /* Align it to the right */
    width: 300px; /* Set a specific width as needed */
    background-color: #111; /* Darker background for right section */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

/* Other styles remain unchanged... */
.heading {
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 15px;
    background: linear-gradient(to right, #00F260, #0575E6); /* Gradient text */
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Image Gallery */
.gallery {
    display: flex;
    overflow-x: auto; /* Enables horizontal scrolling */
    margin-bottom: 20px;
    padding-bottom: 10px;
    white-space: nowrap; /* Prevent wrapping */
}

.gallery img {
    width: 150px;
    height: 100px;
    margin-right: 10px;
    border-radius: 8px;
    display: inline-block;
}

.gallery::-webkit-scrollbar {
    height: 3px;
}

.gallery::-webkit-scrollbar-thumb {
    background-color: #3498db; /* Blue for scrollbar */
    border-radius: 4px;
}

.gallery::-webkit-scrollbar-track {
    background-color: #555; /* Darker scrollbar background */
}

/* Tabs */
.tabs {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.tabs button {
    background-color: transparent;
    border: none;
    font-size: 18px;
    padding: 10px;
    cursor: pointer;
    color: #f1f1f1; /* Light text */
    border-bottom: 3px solid transparent;
    transition: border-color 0.3s, color 0.3s;
    flex: 1;
}

.tabs button.active {
    border-bottom: 3px solid #00F260; /* Gradient accent color */
    color: #00F260; /* Matching text color */
}

/* Content below tabs */
.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.details {
    margin-bottom: 20px;
}

.details h3 {
    color: #e74c3c; /* Red heading for emphasis */
    margin-bottom: 10px;
}

.details p {
    color: #bbb; /* Lighter gray for paragraph text */
    line-height: 1.6;
}

/* Price Box */
.price-box {
    font-size: 24px;
    color: #00F260; /* Green for price */
    margin-bottom: 15px;
}

/* Original Price */
.original-price {
    font-size: 16px;
    color: #7f8c8d;
    text-decoration: line-through;
    margin-bottom: 10px;
}

/* Discount */
.discount {
    color: #e74c3c; /* Red discount text */
    margin-bottom: 10px;
}

/* Payment Button */
.payment-button {
    width: 100%;
    padding: 12px;
    background-color: #3498db; /* Blue background */
    color: #fff;
    font-size: 18px;
    text-align: center;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.payment-button:hover {
    background-color: #2980b9; /* Darker blue on hover */
}

/* Coupons & Offers */
.coupon-box {
    margin-top: 20px;
}

.coupon-title {
    font-size: 18px;
    color: #f1f1f1; /* Light text */
    margin-bottom: 10px;
}

.coupon {
    padding: 10px;
    background-color: #222; /* Dark background for coupon box */
    border-radius: 5px;
    margin-bottom: 10px;
    font-size: 16px;
}

.coupon strong {
    color: #00F260; /* Green for coupon codes */
}


</style>
