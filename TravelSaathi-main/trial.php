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
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #111;
            position: relative;
            overflow: hidden;
           
        }

        /* Background Patterns */
        .container::before {
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
</head>

<body>
<?php include "header.php"; ?>
    <div class="container">
        <!-- Overlapping Images Section -->
        <div class="image-section">
            <img src="images/ai.jpg" alt="Travel Image 1">
        </div>

        <!-- Content with Animated Text and Links -->
        <div class="content">
            <h1>Explore the World with TravelSaathi</h1>
            <p>Discover personalized itineraries curated just for you. With TravelSaathi, you can compare tour providers, save time, and enjoy a seamless travel planning experience like never before.</p>
            <div class="btn-container">
                <a href="#">Learn More</a>
                <a href="#">Start Your Journey</a>
            </div>
        </div>
    </div>
    <section class="best-selling">
        <h2>Best Selling Destinations</h2><br><br>
        <div class="scroll-container">
        <div class="cards-container">
            <div class="card">
                <img src="images/goa.jpeg" alt="Goa">
                <div class="card-info">
                    <h3>Goa</h3>
                    <p>Starting at ₹6,600</p>
                    <p>Per person</p>
                </div>
            </div>
            <div class="card">
                <img src="images/kashmir.jpeg" alt="Kashmir">
                <div class="card-info">
                    <h3>Kashmir</h3>
                    <p>Starting at ₹20,800</p>
                    <p>Per person</p>
                </div>
            </div>
            <div class="card">
                <img src="images/himachal.jpg" alt="Himachal">
                <div class="card-info">
                    <h3>Himachal</h3>
                    <p>Starting at ₹7,000</p>
                    <p>Per person</p>
                </div>
            </div>
            <div class="card">
                <img src="images/andaman.jpeg" alt="Andaman">
                <div class="card-info">
                    <h3>Andaman</h3>
                    <p>Starting at ₹42,000</p>
                    <p>Per person</p>
                </div>
            </div>
            <div class="card">
                <img src="images/rajasthan.jpg" alt="Rajasthan">
                <div class="card-info">
                    <h3>Rajasthan</h3>
                    <p>Starting at ₹4,500</p>
                    <p>Per person</p>
                </div>
            </div>
            <div class="card">
                <img src="images/kerala.jpg" alt="Kerala">
                <div class="card-info">
                    <h3>Kerala</h3>
                    <p>Starting at ₹37,000</p>
                    <p>Per person</p>
                </div>
            </div>
        </div>
      </div>
    </section>
  
</div>
<div class="slider">
        <div class="slide active">
            <img src="images/wave.jpg" alt="Slide 1">
            <div class="overlay">
                <div class="text">
                    <h1>Travel memories you'll never forget</h1>
                    <p>Float through the skies of <span class="highlight">Maldives</span></p>
                    <a href="#" class="learn-more">Learn more</a>
                </div>
            </div>
        </div>
        <div class="slide">
            <img src="images\kashmir.jpeg" alt="Slide 2">
            <div class="overlay">
                <div class="text">
                    <h1>Discover Exotic Destinations</h1>
                    <p>Experience the beauty of the world</p>
                    <a href="#" class="learn-more">Learn more</a>
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



    <?php include "footer.php"; ?>
</body>

</html>
<style>
    /* Basic Reset */
   * {
       margin: 0;
       padding: 0;
       box-sizing: border-box;
   }
   
   body {
       font-family: 'Arial', sans-serif;
       background-color: #111; /* Dark background */
       color: white;
   }
   
   /* Best Selling Section */
   .best-selling {
       padding: 50px;
       text-align: center;

   }
   
   .best-selling h2 {
       font-size: 2.5rem;
       color: #ffffff;
       margin-bottom: 40px;
       font-weight: bold;
       background: -webkit-linear-gradient(#00d2ff, #00ff91);
       -webkit-background-clip: text;
       -webkit-text-fill-color: transparent;
   }
   
   /* Scrollable Container */
   .scroll-container {
       overflow-x: auto;
       padding-bottom: 20px;
       white-space: nowrap;
   }
   
   .scroll-container::-webkit-scrollbar {
       height: 3px;
   }
   
   .scroll-container::-webkit-scrollbar-thumb {
       background: linear-gradient(90deg, #00d2ff, #00ff91); /* Gradient scrollbar */
       border-radius: 10px;
   }
   
   .scroll-container::-webkit-scrollbar-track {
       background: #333;
   }
   
   .cards-container {
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
   
   * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
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
    align-items: center;
    justify-content: flex-start; /* Aligns text to the left */
    color: #fff;
    padding-left: 50px; /* Adds some padding for the text */
}

.text {
    text-align: left; /* Left-aligns the text */
    max-width: 600px; /* Adjusted text container size */
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
    color: white;
    text-decoration: none;
    font-size: 1.2em;
    transition: background 0.3s ease-in-out;
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
   
   
   </style>
   