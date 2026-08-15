<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Cards</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Food+Family:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
// Include the header
include "header.php";

// Connect to the database
include 'db_connect.php';  // Make sure this file has your database connection code

// Retrieve email from URL
$email = isset($_GET['email']) ? mysqli_real_escape_string($conn, $_GET['email']) : '';

// Fetch user trips from the database
$query = "SELECT destination, nights, price_per_person, total_price, image FROM trips WHERE user_email = '$email'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<div class="my-trips">
    <h2 class="my-trips-heading">MY TRIPS</h2>
</div>

<div class="card-container1">
    <?php
    // Loop through each trip and display it
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="card-a">
                <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="Destination Image">
                <div class="card-content">
                    <h2><?php echo htmlspecialchars($row['destination']); ?></h2>
                    <p><strong><?php echo htmlspecialchars($row['nights']); ?>N <?php echo htmlspecialchars($row['destination']); ?></strong></p>
                    <p class="price">₹<?php echo number_format($row['price_per_person'], 0); ?> / Person</p>
                    <p>Total Price: ₹<?php echo number_format($row['total_price'], 0); ?></p>
                </div>
            </div>
            <?php
        }
    } else {
        
        echo "<p>No trips found for this user.</p>";
        
    }
    ?>
</div>

<?php
// Include the footer
include "footer.php";
?>

</body>

</html>


<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #1c1616;
    color: #fff;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.no_trips{
    color:#ffff;
}
body {
    font-family: 'Arial', sans-serif;
    background-color: #000;
    color: #fff;
}

.my-trips {
    padding: 20px;
    text-align: left;
    margin-top: 50px;

}

.my-trips-heading {
    font-family: 'Food Family', sans-serif;
    font-size: 36px;
    color: #00F260;
    margin-left: 115px;
}

.card-container1 {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    padding: 20px;
    
}

.card-a {
    background-color: #1a1a1a;
    border-radius: 10px;
    overflow: hidden;
    width: 400px;
   
    
}

.card-a:hover {
    transform: scale(1.05);
}

.card-a img {
    width: 100%;
    height: 250px;
}

.card-a-content {
    padding: 20px;
}

.card-a-content h2 {
    font-size: 24px;
    color: #00ccff;
}

.card-a-content p {
    font-size: 16px;
    margin: 5px 0;
}

.card-a-content .price {
    font-size: 20px;
    color: orange;
    margin: 10px 0;
}
</style>
