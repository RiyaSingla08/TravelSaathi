<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
   
    <title>TravelSaathi Footer</title>
</head>
<body>
<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        include "db_connect.php";

        // Insert email into the database
        $sql = "INSERT INTO newsletter_subscribers (email) VALUES ('$email')";

        if ($conn->query($sql) === TRUE) {
            header("Location: " . $_SERVER['PHP_SELF']);
        } else {
            if ($conn->errno == 1062) { // Duplicate entry error
                echo "This email is already subscribed.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Close the connection
        $conn->close();
    } else {
        echo "Invalid email address.";
    }
}
?>

<div class="footer-top">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-6">
                <h6>Explore</h6>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="listed_packages.php">Destinations</a></li>
                    <li><a href="travel_guide.php">Travel Guides</a></li>
                    <li><a href="discount_web.php">Discounts</a></li>
                </ul>
            </div>

            <div class="col-md-4 col-6">
                <h6>Support</h6>
                <ul>
                    <li><a href="contactus.php">Contact Us</a></li>
                    <li><a href="booking_policy.php">Booking Policy</a></li>
                    <li><a href="faqs.php">FAQs</a></li>
                    <li><a href="privacy_policy.php">Privacy Policy</a></li>
                </ul>
            </div>

            <div class="col-md-4 col-6">
                <h6>Follow Us</h6>
                <ul>
                    <li><a href="">Facebook</a></li>
                    <li><a href="https://www.instagram.com/travelsaathi2024/">Instagram</a></li>
                    <li><a href="https://x.com/TravelSaathi24">X</a></li>
                    <li><a href="https://www.linkedin.com/in/travel-saathi-bb0463336/">LinkedIn</a></li>
                </ul>
            </div>
        </div>

        <div class="subscribe-section">
            <h5>Subscribe to Our Newsletter</h5>
            <form id="newsletter-form" action="newsletter_subscribe.php" method="POST">
    <input type="email" id="email-input" name="email" class="form-control" placeholder="Enter your email" required>
    <button type="submit" class="btn-subscribe">Subscribe</button>
</form>
        </div>

        <div class="row">
            <div class="col-12 text-center mt-3">
                <p>&copy; 2024 TravelSaathi.com | All Rights Reserved</p>
            </div>
        </div>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
<style>
    /* General Styles */
    body {
    font-family: 'Poppins', sans-serif;
    background-color: black;
    margin: 0;
    padding: 0;
}

.footer-top {
    border-top: #fff 1px solid;
    background-color: #111;
    padding: 50px 0;
    
    color: white;
}
.row{
display:flex;
justify-content: space-around;
}
h6 {
    font-size: 18px;
    margin-bottom: 20px;
    color: #fff;
    font-weight: 600;
    background: linear-gradient(to right, #00F260, #0575E6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

ul {
    list-style-type: none;
    padding: 0;
   
}

ul li {
    margin-bottom: 10px;
   
}

ul li a {
    color: #aaa;
    text-decoration: none;
    transition: color 0.3s ease;
}

ul li a:hover {
    color: #00F260;
}

.subscribe-section {
    text-align: center;
    margin: 40px 458px;
}

.subscribe-section h5 {
    font-size: 22px;
    font-weight: 500;
    color: #fff;
}

.form-control {
    width: 300px;
    padding: 10px;
    margin: 10px 0;
    border: 2px solid #0575E6;
    background-color: #222;
    color: #fff;
    border-radius: 25px;
}

.btn-subscribe {
    background-color: #0575E6;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 25px;
    cursor: pointer;
    transition: backgroun 0.3s ease;
}

.btn-subscribe:hover {
    background-color: #00F260;
}

p {
    font-size: 14px;
    color: #777;
    margin: 0;
}

.text-center {
    text-align: center;
}

.mt-3 {
    margin-top: 30px;
}

</style>