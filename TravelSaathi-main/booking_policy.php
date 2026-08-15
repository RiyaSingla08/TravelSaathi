<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Policy - Travel Saathi</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
// Include the header
include "header.php";
?>

<div class="booking-policy-container">
    <div class="container_booking">
        <h1>Booking Policy</h1>
        <p>At Travel Saathi, we are committed to ensuring a smooth and reliable booking experience for all our customers. Please read through our booking policy to understand the terms and conditions associated with booking your travel with us.</p>
        
        <h2>1. Booking Process</h2>
        <p>To book your trip with Travel Saathi, you can visit our website and select your desired destination, travel dates, and accommodations. Once you provide the necessary details and make the payment, your booking will be confirmed via email.</p>
        
        <h2>2. Payment Terms</h2>
        <p>All payments must be made in full at the time of booking. We accept payments via major credit cards, debit cards, and online payment gateways. Any payment-related issues must be resolved before the booking can be confirmed.</p>
        
        <h2>3. Cancellation Policy</h2>
        <p>If you need to cancel your booking, please refer to our cancellation policy. Cancellations made within 7 days of the travel date may be subject to cancellation charges. Refunds will be processed according to our refund policy.</p>
        
        <h2>4. Modifications to Booking</h2>
        <p>You may request modifications to your booking (e.g., changes in travel dates or accommodations) by contacting our customer support. Modifications are subject to availability and may incur additional charges.</p>
        
        <h2>5. Travel Insurance</h2>
        <p>We strongly recommend purchasing travel insurance to protect your trip against unforeseen circumstances such as illness, injury, or trip cancellations.</p>
        
        <h2>6. Responsibility</h2>
        <p>Travel Saathi is not liable for any delays, changes, or disruptions to your travel arrangements caused by external factors such as weather conditions, political events, or airline/transportation cancellations.</p>

        <h2>7. Contact Us</h2>
        <p>If you have any questions regarding our booking policy, feel free to reach out to our customer support team through the Contact Us page or by emailing us at support@travelsaathi.com.</p>
    </div>
</div>

<?php
// Include the footer
include "footer.php";
?>

</body>
</html>
<style>
    /* General styles */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #1e1e1e;
    color: #f2f2f2;
    margin: 0;
    padding: 0;
    line-height: 1.6;
}

h1, h2 {
    color: #fff;
    margin-bottom: 20px;
}

.container_booking {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

/* Styling for the booking policy content */
.booking-policy-container {
    background-color: #2a2a2a;
    padding: 50px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    margin-bottom: 40px;
}

.booking-policy-container h1 {
    font-size: 36px;
    text-align: center;
    margin-bottom: 40px;
    color: #0079fb;
}

.booking-policy-container h2 {
    font-size: 28px;
    margin-bottom: 15px;
    color: #0079fb;
    border-bottom: 2px solid #0079fb;
    padding-bottom: 10px;
}

.booking-policy-container p {
    font-size: 18px;
    margin-bottom: 25px;
    color: #dcdcdc;
    line-height: 1.8;
}

/* Responsive styles */
@media (max-width: 768px) {
    .container_booking {
        padding: 20px;
    }
}

    </style>