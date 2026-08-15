<?php
include 'db_connect.php'; // Include your database connection

// Check if the company email is provided
if (isset($_GET['email'])) {
    $company_email = $_GET['email'];

    // Prepare statement to prevent SQL injection
    $query = $conn->prepare("SELECT b.id, b.package_id, b.booking_date, b.status, tp.package_name 
                             FROM bookings b 
                             JOIN travel_data tp ON b.package_id = tp.uniq_id 
                             WHERE tp.email = ?");
    $query->bind_param("s", $company_email);
    $query->execute();
    $result = $query->get_result();

    // Check if any bookings exist
    if ($result->num_rows > 0) {
        $bookings = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $bookings = [];
    }

    $query->close();
} else {
    echo "No company email provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bookings - TravelSaathi</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="container">
        <?php include "header_company1.php"; ?>
        <header>
            <h1>Your Bookings</h1>
        </header>
        <main>
            <h2>Current Bookings</h2>
            <ul>
                <?php if (!empty($bookings)): ?>
                    <?php foreach ($bookings as $booking): ?>
                        <li>
                            Booking ID: <?php echo htmlspecialchars($booking['id']); ?>, 
                            Package Name: <?php echo htmlspecialchars($booking['package_name']); ?>, 
                            Booking Date: <?php echo htmlspecialchars($booking['booking_date']); ?>, 
                            Status: <?php echo htmlspecialchars($booking['status']); ?>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No current bookings found.</li>
                <?php endif; ?>
            </ul>
        </main>
    </div>
</body>
</html>
