<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - TravelSaathi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
include "header.php";
?>

    <!-- About Us Section -->
    <section class="about-section">
        <div class="container">
            <h1>About TravelSaathi</h1>
            <p>Welcome to TravelSaathi, your AI-powered travel companion. Our platform is designed to make trip planning easy, efficient, and personalized, ensuring you have the best experience possible. With our advanced itinerary generator, users can create travel plans based on their preferences and compare the best tour packages offered by multiple travel providers.</p>
            <div class="cards">
                <!-- Mission Card -->
                <div class="card">
                    <h2>Our Mission</h2>
                    
                    <p>At TravelSaathi, we aim to revolutionize the way people plan their trips. Our mission is to save travelers valuable time by offering customized travel itineraries and allowing them to compare services from various tour companies in one place.</p>
                </div>

                <!-- Why Choose Us Card -->
                <div class="card">
                    <h2>Why Choose Us?</h2>
                    <ul>
                        <li>AI-powered itinerary creation tailored to your preferences</li>
                        <li>Compare travel packages from multiple tour providers</li>
                        <li>Easy booking and seamless payment integration</li>
                        <li>Comprehensive travel packages covering flights, hotels, and activities</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php
include "footer.php";
?>

</body>
</html>

<style> 
/* General Styles */
body {
    font-family: 'Poppins', sans-serif;
    background-color: black;
    margin: 0;
    padding: 0;
    color: #333;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    text-align: center;
}

/* About Us Section */
.about-section {
    background-color: black;
    padding: 50px 20px;
    margin: 20px 0;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.about-section h1 {
    font-size: 36px;
    color: #0575E6;
    margin-bottom: 40px;
    text-align: center;
}

.about-section p {
    font-size: 16px;
    line-height: 1.6;
    color: white;
}

/* Flexbox layout for cards */
.cards {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 40px;
}

.card {
    background-color: #1a1a1a;
    padding: 20px;
    border-radius: 10px;
    width: 45%;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    color: white;
}

.card h2 {
    font-size: 28px;
    color: #00F260;
    margin-bottom: 15px;
}

.card p, .card ul {
    font-size: 16px;
    line-height: 1.6;
    color: white;
}

.card ul {
    list-style-type: disc;
    margin-left: 20px;
}

.card ul li {
    margin-bottom: 10px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .cards {
        flex-direction: column;
        align-items: center;
    }

    .card {
        width: 100%;
    }
}
</style>
