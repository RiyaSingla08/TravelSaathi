<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elevated TravelSaathi Design</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    
</head>

<body>
    <!-- Header Section -->
    <section>
        <?php include "header.php"; ?>
</section>


    <div class="containerz">
        <!-- Overlapping Images Section -->
        <div class="image-section">
            <img src="images/ai.jpg" alt="Travel Image 1">
        </div>

        <!-- Content with Animated Text and Links -->
        <div class="content">
            <h1>Explore the World with TravelSaathi</h1>
            <p>Discover personalized itineraries curated just for you. With TravelSaathi, you can compare tour providers, save time, and enjoy a seamless travel planning experience like never before.</p>
            <div class="btn-container">
          <!--  <a href="learn_more.php">Learn More</a> -->
            <a href="listed_packages.php">Start Your Journey</a>
            </div>
        </div>
    </div>

     <!-- 5 -->
    <!-- Best Selling Destinations Section -->
    <section class="best-selling">
    <?php
include "db_connect.php";

// Fetch destinations from the database
$sql = "SELECT name, image_path, starting_price FROM destinations";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    echo '<section class="best-selling">';
    echo '<h2>Best Selling Destinations</h2>';
    echo '<div class="scroll-container-image">';
    echo '<div class="cards-container-image">';
    
    // Output data for each destination
    while($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['name']) . '">';
        echo '<div class="card-info">';
        echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
        echo '<p>Starting at ₹' . htmlspecialchars(number_format($row['starting_price'], 2)) . '</p>';
        echo '<p>Per person</p>';
        echo '</div>';
        echo '</div>';
    }
    
    echo '</div>'; // End of cards-container-image
    echo '</div>'; // End of scroll-container-image
    echo '</section>';
} else {
    echo "No destinations found.";
}
    // Close the database connection
    $conn->close();
?>
</section>
<br><br><br>
<!-- 8 -->
<section>
    <?php
    include "db_connect.php";

    // Fetch blogs and vlogs from the database
    $sql = "SELECT id, title, description, image_path FROM blogs_and_vlogs"; // Ensure 'id' is available in the table
    $result = $conn->query($sql);

    // Check if there are results
    if ($result->num_rows > 0) {
        echo '<section>';
        echo '<h1>TravelSaathi Blogs & Vlogs</h1>';
        echo '<div class="marquee-container">';
        echo '<div class="marquee-content">';

        // Output data for each blog/vlog
        while ($row = $result->fetch_assoc()) {
            // Wrap the entire content-box in the <a> tag
            echo '<a href="description.php?id=' . htmlspecialchars($row['id']) . '" class="content-link">';
            echo '<div class="content-box">';
            echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['title']) . '">';
            echo '<div class="content-overlay">';
            echo '<h2>' . htmlspecialchars($row['title']) . '</h2>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
        }

        echo '</div>'; // End of marquee-content
        echo '</div>'; // End of marquee-container
        echo '</section>';
    } else {
        echo "No blogs or vlogs found.";
    }

    // Close the database connection
    $conn->close();
    ?>
</section>
<br><br>

<section>
    <div class="container-tourist">
        <h2>Famous Tourist Attractions</h2>
        <div class="attraction-grid">
            <div class="attraction-item">
            <a href="listed_packages.php?search=Lakshadweep&destination=Lakshadweep">
    <img src="images/lakshadweep.jpg" alt="Lakshadweep">
</a>
<p>Lakshadweep</p>
            </div>
            <div class="attraction-item">
                <a href="listed_packages.php?search=Andaman&destination=Andaman">
                    <img src="images/andaman.jpeg" alt="Andaman">
                </a>
                <p>Andaman</p>
            </div>
            <div class="attraction-item">
                <a href="listed_packages.php?search=Kashmir&destination=Kashmir">
                    <img src="images/kashmir1.jpeg" alt="Kashmir">
                </a>
                <p>Kashmir</p>
            </div>
            <div class="attraction-item">
            <a href="listed_packages.php?search=Jaipur&destination=Jaipur">
                <img src="images/jaipur.jpg" alt="Jaipur">
</a>
                <p>Jaipur</p>
            </div>
            <div class="attraction-item">
            <a href="listed_packages.php?search=Bengaluru&destination=Bengaluru">
                <img src="images/Bengaluru.jpg" alt="Bengaluru">
</a>
                <p>Bengaluru</p>
            </div>
            <div class="attraction-item">
            <a href="listed_packages.php?search=Paris&destination=Paris">
                <img src="images/paris.jpg" alt="Paris">
</a>
                <p>Paris</p>
            </div>
            <div class="attraction-item">
            <a href="listed_packages.php?search=Leh&destination=Leh">
                <img src="images/leh.jpg" alt="Leh">
</a>
                <p>Leh</p>
            </div>
            <div class="attraction-item">
            <a href="listed_packages.php?search=Bali&destination=Bali">
                <img src="images/bali1.jpeg" alt="Bali">
</a>
                <p>Bali</p>
            </div>
            <div class="attraction-item">
            <a href="listed_packages.php?search=Dubai&destination=Dubai">
                <img src="images/dubai1.jpeg" alt="Dubai">
</a>
                <p>Dubai</p>
            </div>
            <div class="attraction-item">
            <a href="listed_packages.php?search=Kerala&destination=Kerala">
                <img src="images/kerala.jpg" alt="Kerala">
</a>
                <p>Kerala</p>
            </div>
        </div>
    </div>
</section>

<?php
include "db_connect.php";

if (isset($_GET['event_id'])) { 
    $event_id = intval($_GET['event_id']); 
}

// Corrected SQL query
$sql = "SELECT event_id, event_name, event_date, event_location, event_description, event_image FROM events ORDER BY event_date ASC";
$result = $conn->query($sql);
?>

<section class="events-section">
    <h2 class="events-title">Upcoming Events</h2>
    <div class="events-container">
        <?php
        if ($result->num_rows > 0) {
            // Output each event as a clickable card
            while($row = $result->fetch_assoc()) {
                echo '<a href="events_web.php?event_id=' . htmlspecialchars($row["event_id"]) . '" class="event-card">'; 
                echo '<img class="event-image" src="' . htmlspecialchars($row["event_image"]) . '" alt="' . htmlspecialchars($row["event_name"]) . '">';
                echo '<div class="event-content">';
                echo '<h3 class="event-title">' . htmlspecialchars($row["event_name"]) . '</h3>';
                echo '<p class="event-date">Date: ' . date("F j, Y", strtotime($row["event_date"])) . '</p>';
                echo '<p class="event-location">Location: ' . htmlspecialchars($row["event_location"]) . '</p>';
                echo '</div>';
                echo '</a>';
            }
        } else {
            echo "<p>No upcoming events found.</p>";
        }
        ?>
    </div>
</section>

<?php
// Close the database connection
$conn->close();
?>



   
    <br><br><br><br><br>
    <!-- 6 -->
    <section>
    <div class="slider">
        <div class="slide active">
            <img src="images/wave.jpg" alt="Slide 1">
            <div class="overlay">
                <div class="text">
                    <h1>Travel memories you'll never forget</h1>
                    <p>Float through the skies of <span class="highlight">Maldives</span></p>
                    <a href="wishlist.php" class="wishlist">Add to your Wishlist</a>
                </div>
            </div>
        </div>
        <div class="slide">
            <img src="images\2.jpg" alt="Slide 2">
            <div class="overlay">
                <div class="text">
                    <h1>Bookmark Your Adventure With TravelSaathi</h1>
                    <p>Experience the beauty of the world</p>
                    <a href="wishlist.php" class="wishlist">Add to your Wishlist</a>
                </div>
            </div>
        </div>
        <!-- Add more slides as needed -->
    </div>
    <script>
    const slides = document.querySelectorAll('.slide');
let currentSlide = 0;

function showNextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
}

// Start the slideshow, change slides every 3 seconds
setInterval(showNextSlide, 3000); // 3000 milliseconds = 3 seconds
</script>
</section>


<section>
    <!-- Custom Chatbot Icon -->
    <a href="chatbot_page.php" class="custom-chatbot-icon" title="Welcome to TravelSaathi, I am Sobo your Personal AI assistant">
    <img src="images/chatbot.jpg" alt="Chatbot Icon">
</a>




</script>
  <!-- 11 -->
  <section>
    <?php include "footer.php"; ?>
    </section>
    

    
</body>

</html>
<style>
    /* Style for the event link to remove default anchor styles */
.event-card {
    display: block; /* Make the entire card clickable */
    text-decoration: none; /* Remove underline */
    color: inherit; /* Keep the text color from parent */
}

/* Hover effect for the event card */
.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.5);
}

            /* General styling for the section */
.events-section {
    background: #111;
    padding: 40px 20px;
    margin-top:30px;
    margin-bottom:-54px;
    text-align: center;
    color: #e0e0e0;
}

.events-title {
    font-size: 2.5em;
    color: #00d4ff;
    margin-bottom: 20px;
    text-transform: uppercase;
}

/* Styling for the container holding the event cards */
.events-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

/* Styling for each event card */
.event-card {
    background-color: #333;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    max-width: 250px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.5);
}

/* Styling for the event image */
.event-image {
    width: 100%;
    height: 160px;
    object-fit: cover;
}

/* Styling for the event content (text) */
.event-content {
    background: #2a2a2a;
    padding: 15px;
    color: #e0e0e0;
    text-align: left;
}

.event-title {
    font-size: 1.2em;
    color: #00d4ff;
    margin: 5px 0;
}

.event-date,
.event-location {
    font-size: 0.9em;
    color: #a8a8a8;
    margin: 3px 0;
}

.event-description {
    font-size: 0.85em;
    color: #d0d0d0;
    margin-top: 8px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .events-container {
        flex-direction: column;
        align-items: center;
    }

    .event-card {
        max-width: 90%;
    }
}

            
/* Custom Chatbot Icon */
.custom-chatbot-icon {
    position: fixed;
    bottom: 30px; /* Bottom margin */
    right: 30px; /* Right margin */
    width: 80px; /* Increased width */
    height: 80px; /* Increased height */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(173, 216, 230, 0.5);
    transition: transform 0.3s;
    text-decoration: none; /* Removes underline on link */
    z-index: 1000; /* Ensure it is on top of other elements */
}

.custom-chatbot-icon:hover {
    transform: scale(1.1);
}

.custom-chatbot-icon img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    padding: 10px;
}

/* Tooltip */
.custom-chatbot-icon::after {
    content: "Welcome to TravelSaathi! I am Sobo, your Personal AI assistant";
    position: absolute;
    bottom: 80px; /* Vertical position */
    right: 40px; /* Move further left */
    background-color: #333; /* Darker background color */
    color: #fff;
    text-align: left; /* Align text to the left */
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 14px;
    white-space: nowrap; /* Prevents text wrapping to a new line */
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px); /* Straight positioning */
    transition: opacity 0.3s, transform 0.3s;
    box-shadow: 0 4px 8px rgba(173, 216, 230, 0.5); /* Light blue shadow */
    z-index: 1000; /* Ensure it is on top */
    font-weight: bold;
    letter-spacing: 0.5px;
}

.custom-chatbot-icon:hover::after {
    opacity: 1;
    visibility: visible;
    transform: translateY(0); /* Brings tooltip into view without rotation */
}








        body {
            margin: 15px;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* Header Styling */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: #0d0d0d;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            position: relative;
            margin-bottom: -50px;
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 160px;
            margin-right: 15px;
        }

        .logo h1 {
            color: white;
            font-size: 24px;
            font-weight: 700;
        }

        /* Nav Links */
        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #00bcd4;
        }

        /* Search Bar */
        .search-container {
            position: relative;
            margin-left: -54px;
        }

        .search-container input {
            padding: 10px;
            border-radius: 20px;
            border: none;
            outline: none;
            font-size: 16px;
            width: 285px;
            transition: width 0.3s ease;
        }

        .search-container input:focus {
            width: 300px;
        }

        .search-container .icon {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: #333;
        }

        /* Sign In Button */
        .sign-in-btn {
            padding: 10px 20px;
            background-color: #00bcd4;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .sign-in-btn:hover {
            background-color: #ff4081;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-container input {
                width: 100%;
            }

            .search-container input:focus {
                width: 100%;
            }
        }
    </style>

    <style>
    /* Marquee Section */
.marquee-container {
    width: 100%;
    overflow-x: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    background: #111;
    padding: 10px 0;
    margin-bottom: 20px;
    display: flex;
    justify-content: center;
}

.marquee-content {
    display: flex;
    animation: scroll 10s linear infinite;
}

@keyframes scroll {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-100%);
    }
}

/* Discount Boxes */
.discount-box {
    background: black;
    border-radius: 12px;
    padding: 20px;
    margin: 10px;
    width: 300px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.5);
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
    color: #fff;
    border: 6px solid transparent; /* Set a transparent border */
    border-image: linear-gradient(45deg, #00d2ff, #3a7bd5) 1; /* Apply the gradient as border image */
    padding: 20px; /* Add padding for spacing inside the box */
    border-radius: 8px; /* Optional: Add border radius for rounded corners */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Optional: Add a subtle shadow for depth */
}

.discount-box h2 {
    font-size: 24px;
    margin-bottom: 10px;
    color: #40E0D0;
}

.discount-box p {
    font-size: 18px;
    margin: 0;
    color: #F5F5DC;
}

.discount-box:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
}


/* Blogs & Vlogs */
.marquee-container {
    display: flex;
    overflow-x: hidden; /* Hide the horizontal scrollbar */
    padding: 10px;
    gap: 30px;
    background: #111;
    border-radius: 10px;
   
}

.content-box {
    position: relative;
    flex: 0 0 auto;
    width: calc(100% - 20px); /* Adjust width to avoid overflow */
    max-width: 300px; /* Set a max width for content boxes */
    max-height:215px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
    transition: transform 0.3s ease;
    gap: 20px;
    width: calc(100% - 30px); /* Adjust width to avoid overflow with increased gap */
    max-width: 300px; /* Set a max width for content boxes */
    margin-right: 10px;
    margin-left:20px;
    margin-right:40px;
    
}

.content-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height:100%;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9));
    color: #ffffff;
    opacity: 0;
    transition: opacity 0.3s;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-size: 1.2em;
    font-weight: 500;
    
}

.content-box:hover .content-overlay {
    opacity: 1;
}

.image-section img {
    width: 100%;
    height: 200px;
    transition: transform 0.3s ease-in-out;
    gap: 20px;
}

.content-box:hover .image-section img {
    transform: scale(1.1);
    gap: 20px;
}
h1{
    color: #00ffd1;
    font-size: 2.5em;
    text-align: center;
    margin: 20px 0;
    background: linear-gradient(45deg, #00ffd1, #009999);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.content h1{
    text-align: left;
}
/* Text Styles */
.text h1 {
    color: #00ffd1;
    font-size: 2.5em;
    text-align: center;
    margin: 20px 0;
    background: linear-gradient(45deg, #00ffd1, #009999);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.text p {
    color: #b3b3b3;
    font-size: 1.2em;
    text-align: center;
    line-height: 1.6;
}

/* Responsiveness */
@media (max-width: 768px) {
    .marquee-container {
        flex-direction: column;
        align-items: center;
    }
    
    .image-section img {
        width: 90%;
        margin: 0 auto;
    }
}

@media (max-width: 480px) {
    .text h1 {
        font-size: 2em;
    }
    
    .text p {
        font-size: 1em;
    }
}


/* Best Selling Section */
.best-selling {
    margin-top:-20px;
       padding: 18px;
       text-align: center;

   }
   
   .best-selling h2, .container-tourist h2 {
       font-size: 2.5rem;
       color: #ffffff;
       margin-bottom: 40px;
       font-weight: bold;
       background: -webkit-linear-gradient(#00d2ff, #00ff91);
       -webkit-background-clip: text;
       -webkit-text-fill-color: transparent;
   }
  
   /* Scrollable Container */
   .scroll-container-image {
       overflow-x: auto;
       padding-bottom: 20px;
       white-space: nowrap;
   }
   
   .scroll-container-image::-webkit-scrollbar {
       height: 3px;
   }
   
   .scroll-container-image::-webkit-scrollbar-thumb {
       background: linear-gradient(90deg, #00d2ff, #00ff91); /* Gradient scrollbar */
       border-radius: 10px;
   }
   
   .scroll-container-image::-webkit-scrollbar-track {
       background: #333;
   }
   
   .cards-container-image {
       display: inline-flex;
       gap: 20px;
       padding-left: 5px;
   }
   
   .card {
       background-color: #1a1a1a;
       border-radius: 15px;
       overflow: hidden;
       width: 250px;
       flex-shrink: 0;
       transition: transform 0.3s ease, box-shadow 0.3s ease;
       position: relative;
       box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
   }
   
   .card:hover {
       transform: translateY(-10px);
       box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6);
   }
   
   .card img {
       width: 100%;
       height: 200px;
       object-fit: cover;
       border-bottom: 5px solid #00d2ff;
   }
   
   .card-info {
       padding: 20px;
       background: linear-gradient(180deg, rgba(0, 210, 255, 0.3), rgba(0, 0, 0, 0.8));
   }
   
   .card-info h3 {
       color: #00d2ff;
       margin-bottom: 10px;
       font-size: 1.5rem;
   }
   
   .card-info p {
       color: #cccccc;
       font-size: 1rem;
       margin: 5px 0;
   }
.slider {
    position: relative;
    width: 100%;
    height: 70vh; /* Decreased height */
    overflow: hidden;
}

.slide {
    position: absolute;
    width: 100%;
    height: 100%;
    transition: opacity 1s ease-in-out;
    opacity: 0;
}

.slide.active {
    opacity: 1;
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(50%); /* Dulls the image */
}


.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column; /* Ensure elements are stacked vertically */
    align-items: flex-start; /* Aligns items to the start (left) */
    justify-content: center; /* Centers vertically */
    color: #fff;
    padding-left: 50px;
    text-align: left;
}
.overlay {
    align-items: flex-start !important;
    text-align: left !important;
}

.text {
    text-align: left !important;
    margin: 0 !important;
    max-width: 600px;
}






.text h1 {
    font-size: 3em;
    margin-bottom: 20px;
}

.text p {
    font-size: 1.5em;
    margin-bottom: 30px;
}

.highlight {
    color: white; /* Makes the word Dubai more visible */
}

.learn-more {
    padding: 10px 20px;
    background: -webkit-linear-gradient(#00d2ff, #00ff91);
    border-radius:10px;
    color: white;
    text-decoration: none;
    font-size: 1.2em;
    transition: background 0.3s ease-in-out;
}

.wishlist {
    padding: 10px 20px;
    background: -webkit-linear-gradient(#00d2ff, #00ff91);
    border-radius:10px;
    color: white;
    text-decoration: none;
    font-size: 1.2em;
    transition: background 0.3s ease-in-out;
    text-align: center;
    margin-left:94px;
}


.learn-more:hover {
    background-color: #ff4500;
}


   /* Responsiveness */
   @media (max-width: 768px) {
       .card {
           width: 200px;
       }
   }
   
   @media (max-width: 480px) {
       .card {
           width: 160px;
       }
   }

  /* Container Styling */
/* Import Montserrat Font */
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap');

/* Container Styling */
.container-tourist {
    text-align: center;
    background-color: #111;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
    max-width: 90%;
    margin: 20px auto;
    color: #ffffff;
}

/* Section Heading */
.attraction-heading {
    font-size: 2.8em;
    color: #00ffd1;
    margin-bottom: 30px;
    background: linear-gradient(45deg, #00ffd1, #00a3a3);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Attraction Grid */
.attraction-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 25px;
}

/* Attraction Item */
.attraction-item {
    background-color: #222;
    border-radius: 12px;
    padding: 25px;
    text-align: center;
    
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    color: #ffffff;
}

.attraction-item:hover {
    transform: scale(1.08);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
}

/* Image Styling */
.attraction-item img {
    width: 100px;
    height: 100px;
    margin-bottom: 12px;
    border-radius: 50%;
    filter: brightness(0.9);
    border: 3px solid #444;
    transition: transform 0.3s ease, filter 0.3s ease;
}

.attraction-item:hover img {
    transform: scale(1.1);
    filter: brightness(1);
}

/* Text Styling for Destination Name */
.attraction-item p {
    font-size: 18px;
    font-weight: 600;
    color: #e0e0e0;
    font-family: 'Montserrat', sans-serif; /* Apply Montserrat font */
}

/* Responsive Adjustments */
@media (max-width: 1024px) {
    .attraction-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .attraction-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .attraction-grid {
        grid-template-columns: 1fr;
    }
}


</style>



    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #111;
        }

        .containerz {
            width: 100%;
            height: 93vh;
            display: flex;
           
            justify-content: center;
            align-items: center;
            background: #111;
            position: relative;
            overflow: hidden;
           
        }

        /* Background Patterns */
        .containerz::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('background-pattern.png'); /* Add subtle circular lines similar to the example */
            opacity: 0.1;
            z-index: 1;
        }

        /* Overlapping Image Section */
        .image-section {
            width: 50%;
            position: relative;
            z-index: 2;
            padding-left: 40px;
        }

        .image-section img {
            width: 90%;
            height: auto;
            border-radius: 12px;
            transition: transform 0.5s ease;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .image-section img:hover {
            transform: scale(1.05);
        }

        /* Content Section with Animated Text */
        .content {
            width: 50%;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            color: #fff;
            padding: 20px;
            animation: slideIn 1s ease-out;
            position: relative;
            border-bottom: #f0f0f0 solid 1px;
        }

        .content h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            background: linear-gradient(45deg, #00bcd4, #ff4081);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textFadeIn 1.5s ease-out;
        }

        .content p {
            font-size: 18px;
            margin-bottom: 30px;
            line-height: 1.6;
            animation: fadeIn 2s ease;
        }

        .content a {
            padding: 10px 20px;
            background-color: #00bcd4;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-weight: 500;
            font-size: 16px;
            box-shadow: 0 10px 20px rgba(0, 188, 212, 0.3);
        }

        .content a:hover {
            background-color: #ff4081;
        }

        /* Button Styles */
        .btn-container {
            display: flex;
            gap: 15px;
        }

        /* Animation for Text and Content */
        @keyframes slideIn {
            0% {
                transform: translateX(50px);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes textFadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                text-align: center;
                height: auto;
            }

            .image-section,
            .content {
                width: 100%;
            }

            .content h1 {
                font-size: 36px;
            }

            .content p {
                font-size: 16px;
            }
        }
    </style>