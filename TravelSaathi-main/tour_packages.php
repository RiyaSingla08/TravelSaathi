<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Selling Destinations</title>
    
</head>
<body>

    <section class="best-selling">
        <h2>Best Selling Destinations</h2>
        <div class="scroll-container">
        <div class="cards-container">
            <div class="card">
                <img src="goa.jpg" alt="Goa">
                <div class="card-info">
                    <h3>Goa</h3>
                    <p>Starting at ₹6,600</p>
                    <p>Per person</p>
                </div>
            </div>
            <div class="card">
                <img src="kashmir.jpg" alt="Kashmir">
                <div class="card-info">
                    <h3>Kashmir</h3>
                    <p>Starting at ₹20,800</p>
                    <p>Per person</p>
                </div>
            </div>
            <div class="card">
                <img src="himachal.jpg" alt="Himachal">
                <div class="card-info">
                    <h3>Himachal</h3>
                    <p>Starting at ₹7,000</p>
                    <p>Per person</p>
                </div>
            </div>
            <div class="card">
                <img src="andaman.jpg" alt="Andaman">
                <div class="card-info">
                    <h3>Andaman</h3>
                    <p>Starting at ₹42,000</p>
                    <p>Per person</p>
                </div>
            </div>
            <div class="card">
                <img src="rajasthan.jpg" alt="Rajasthan">
                <div class="card-info">
                    <h3>Rajasthan</h3>
                    <p>Starting at ₹4,500</p>
                    <p>Per person</p>
                </div>
            </div>
            <div class="card">
                <img src="kerala.jpg" alt="Kerala">
                <div class="card-info">
                    <h3>Kerala</h3>
                    <p>Starting at ₹37,000</p>
                    <p>Per person</p>
                </div>
            </div>
        </div>
      </div>
    </section>

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
    background-color: #0d0d0d; /* Dark background */
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