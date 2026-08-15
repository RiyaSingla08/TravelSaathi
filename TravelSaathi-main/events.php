<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelSathi - Upcoming Events</title>
    <style>
        body {
            background-color: #121212; /* Dark background for the entire page */
            color: #e0e0e0; /* Light text for readability */
            font-family: Arial, sans-serif; /* Font style */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .events-section {
            padding: 40px;
            text-align: center;
            background: linear-gradient(135deg, #1a1a1a, #2a2a2a);
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        }

        .events-title {
            font-size: 2.5em;
            margin-bottom: 30px;
            background: linear-gradient(45deg, #00ffd1, #009999);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }

        .events-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px; /* Space between event cards */
        }

        .event-card {
            background-color: #1f1f1f; /* Darker card background */
            border-radius: 10px;
            padding: 20px;
            width: 300px; /* Fixed width for event cards */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative; /* For pseudo-element effect */
            overflow: hidden; /* To keep the pseudo-element contained */
        }

        .event-card:hover {
            transform: translateY(-5px); /* Slight lift on hover */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.7); /* Enhanced shadow */
        }

        .event-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 221, 87, 0.1);
            opacity: 0.5;
            transition: opacity 0.3s;
            z-index: 0; /* Behind the text */
        }

        .event-card:hover::before {
            opacity: 0.7; /* Darker overlay on hover */
        }

        .event-title {
            font-size: 1.6em;
            margin: 10px 0;
            background: linear-gradient(45deg, #00ffd1, #009999);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative; /* To ensure it sits above the pseudo-element */
            z-index: 1; /* Above the pseudo-element */
        }

        .event-image {
            width: 100%;
            height: 180px; /* Fixed height for images */
            border-radius: 10px;
            object-fit: cover; /* Ensures images cover the area without distortion */
            margin-bottom: 10px; /* Space between image and text */
        }

        .event-date, .event-location, .event-description {
            font-size: 1em;
            margin: 5px 0;
            color: #b0b0b0; /* Lighter color for other text */
            position: relative; /* To ensure it sits above the pseudo-element */
            z-index: 1; /* Above the pseudo-element */
        }

        /* Adding some animations to the cards */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .event-card {
            animation: fadeIn 0.5s ease forwards; /* Animation for the event cards */
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .events-container {
                flex-direction: column; /* Stack cards on smaller screens */
                align-items: center; /* Center alignment */
            }

            .event-card {
                width: 90%; /* Make cards full width */
            }
        }
    </style>
</head>
<body>

<section class="events-section">
    <h2 class="events-title">Upcoming Events</h2>
    <div class="events-container">
        <div class="event-card">
            <img class="event-image" src="https://source.unsplash.com/300x180/?city,festival" alt="City Festival">
            <h3 class="event-title">City Festival</h3>
            <p class="event-date">Date: November 10, 2024</p>
            <p class="event-location">Location: New York City</p>
            <p class="event-description">Join us for an amazing festival celebrating the culture of NYC!</p>
        </div>
        <div class="event-card">
            <img class="event-image" src="https://source.unsplash.com/300x180/?food,expo" alt="Food Expo">
            <h3 class="event-title">Food Expo</h3>
            <p class="event-date">Date: November 20, 2024</p>
            <p class="event-location">Location: Los Angeles</p>
            <p class="event-description">Explore culinary delights from around the world!</p>
        </div>
        <div class="event-card">
            <img class="event-image" src="https://source.unsplash.com/300x180/?music,concert" alt="Music Concert">
            <h3 class="event-title">Music Concert</h3>
            <p class="event-date">Date: December 5, 2024</p>
            <p class="event-location">Location: Chicago</p>
            <p class="event-description">Enjoy live performances from top artists!</p>
        </div>
        <!-- Add more events as needed -->
    </div>
</section>

</body>
</html>