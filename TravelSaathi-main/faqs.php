<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs - Travel Saathi</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Header Section -->
    <?php include 'header.php'; ?>

    <!-- FAQ Section -->
    <div class="faq-container">
        <h1>Frequently Asked Questions</h1>

        <div class="faq">
            <h2 class="faq-question">1. How do I book a trip with Travel Saathi?</h2>
            <p class="faq-answer">You can book a trip by visiting our website, selecting your destination, travel dates, and accommodation, and completing the booking process. We will send you a confirmation email with all the details once your booking is confirmed.</p>
        </div>

        <div class="faq">
            <h2 class="faq-question">2. What payment methods do you accept?</h2>
            <p class="faq-answer">We accept major credit cards, debit cards, and online payment gateways. Payments must be made in full at the time of booking.</p>
        </div>

        <div class="faq">
            <h2 class="faq-question">3. Can I cancel or modify my booking?</h2>
            <p class="faq-answer">Yes, you can cancel or modify your booking by contacting our customer support team. Please note that cancellations may be subject to charges depending on the timing and terms of your booking.</p>
        </div>

        <div class="faq">
            <h2 class="faq-question">4. Do you offer travel insurance?</h2>
            <p class="faq-answer">We highly recommend purchasing travel insurance to protect your trip from unforeseen events such as illness, injury, or cancellations. You can find insurance options during the booking process.</p>
        </div>

        <div class="faq">
            <h2 class="faq-question">5. How do I contact customer support?</h2>
            <p class="faq-answer">You can reach our customer support team through the 'Contact Us' page on our website or by emailing us at support@travelsaathi.com. We’re here to help 24/7.</p>
        </div>
    </div>

    <!-- Footer Section -->
    <?php include 'footer.php'; ?>

</body>
</html>
<style>
    /* General body styles */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #1e1e1e;
    color: #f2f2f2;
    margin: 0;
    padding: 0;
    line-height: 1.6;
}

/* FAQ container styles */
.faq-container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 0 20px;
    background-color: #2a2a2a;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    padding: 40px;
}

.faq-container h1 {
    text-align: center;
    font-size: 36px;
    color: #0079fb;
    margin-bottom: 40px;
}

/* FAQ item styles */
.faq {
    margin-bottom: 30px;
}

.faq-question {
    font-size: 22px;
    margin-bottom: 10px;
    color: #0079fb;
    border-bottom: 1px solid #0079fb;
    padding-bottom: 8px;
}

.faq-answer {
    font-size: 18px;
    color: #dcdcdc;
    line-height: 1.8;
    margin-top: 10px;
}

/* Footer and header can use similar styles as before */

/* Responsive styles for FAQ */
@media (max-width: 768px) {
    .faq-container {
        padding: 20px;
    }

    .faq-question {
        font-size: 20px;
    }

    .faq-answer {
        font-size: 16px;
    }
}
    </style>
