<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Your Free Trial - Travel Saathi</title>
    <style>
        /* Basic styles for the body */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        /* Overlay background */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
        }

        /* Popup window styles */
        .popup-content {
            display: none;
            background-color: white;
            width: 500px;
            padding: 40px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            z-index: 1001;
        }

        .popup-content h2 {
            color: #0575E6;
            margin-bottom: 20px;
        }

        .popup-content p {
            font-size: 18px;
            margin-bottom: 20px;
            color: #333;
        }

        /* Details Section */
        .details-list {
            text-align: left;
            font-size: 16px;
            margin-top: 10px;
            color: #555;
        }

        .details-list li {
            margin-bottom: 10px;
        }

        /* Close Button */
        .close-btn {
            background-color: #ff4e4e;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
        }

    </style>
</head>
<body>

    <!-- Overlay -->
    <div class="popup-overlay" id="popup-overlay"></div>

    <!-- Popup content -->
    <div class="popup-content" id="popup-content">
        <h2>Start Your Free Trial - Premium</h2>
        <p>Unlock the best of Travel Saathi!</p>

        <!-- Plan Details -->
        <ul class="details-list">
            <li>Customized travel plans based on your preferences</li>
            <li>Access to exclusive travel deals and offers</li>
            <li>Compare itineraries from top travel agencies</li>
            <li>Real-time support from our travel experts</li>
            <li>Easy and secure payment for bookings</li>
            <li>Exclusive content on popular destinations and travel tips</li>
        </ul>

        <!-- Close Button -->
        <button class="close-btn" onclick="closePopup()">Close</button>
    </div>

    <!-- JavaScript to handle popup open/close -->
    <script>
        // Open popup function
        function openPopup() {
            document.getElementById('popup-overlay').style.display = 'block';
            document.getElementById('popup-content').style.display = 'block';
        }

        // Close popup function and redirect to index1.php
        function closePopup() {
            window.location.href = 'index1.php';
        }

        // Trigger the popup for demonstration (optional)
        window.onload = function() {
            openPopup(); // Automatically open the popup on page load
        };
    </script>

    <!-- Footer Section -->
    <?php include 'footer.php'; ?>

</body>
</html>
