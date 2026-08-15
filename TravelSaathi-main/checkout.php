<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<section>
        <?php include "header.php"; ?>
</section>
    <div class="checkout-container">
        <div class="billing-details">
            <h2>Billing Details</h2>
            <form>
                <label for="first-name">First Name <span>*</span></label>
                <input type="text" id="first-name" name="first-name" required>

                <label for="last-name">Last Name <span>*</span></label>
                <input type="text" id="last-name" name="last-name" required>

                <label for="country">Country/Region <span>*</span></label>
                <select id="country" name="country">
                    <option value="india">India</option>
                    <!-- Other countries -->
                </select>

                <label for="street-address">Street Address <span>*</span></label>
                <input type="text" id="street-address" name="street-address" placeholder="House number and street name" required>

                <label for="town-city">Town/City <span>*</span></label>
                <input type="text" id="town-city" name="town-city" required>

                <label for="state">State <span>*</span></label>
                <input type="text" id="state" name="state" required>

                <label for="pin-code">PIN Code <span>*</span></label>
                <input type="text" id="pin-code" name="pin-code" required>
            </form>
        </div>

        <div class="order-summary">
            <h2>Your Packages</h2>
            <div class="order-item">
                <!-- This span will display the fetched package name -->
                <span id="package-name">
                    <?php
                        // Fetch uniq_id from URL
                        $uniq_id = $_GET['uniq_id'] ?? '';

                        // Connect to the database
                        include "db_connect.php";

                        // Fetch package data from travel_data table
                        $stmt = $conn->prepare("SELECT package_name, price_per_person, price_per_two FROM travel_data WHERE uniq_id = ?");
                        $stmt->bind_param("s", $uniq_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo htmlspecialchars($row['package_name']);
                            $price_per_person = $row['price_per_person'];
                            $price_per_two = $row['price_per_two'];
                        } else {
                            echo "Package not found";
                            $price_per_person = 0;
                            $price_per_two = 0;
                        }

                        $stmt->close();
                        $conn->close();
                    ?>
                </span>
                <!-- This span will display the price based on the package type -->
                <span id="package-price">₹0.00</span>
            </div>

            <label for="package-type">Select Package Type:</label>
            <select id="package-type" onchange="updatePrice()">
                <option value="per_person">Price per Person</option>
                <option value="per_two">Price for Two</option>
            </select>
<br><br><br><br>
            <div class="order-total">
                <span>Subtotal:</span>
                <span id="subtotal">₹0.00</span>
            </div>
            <button class="place-order">Place Order</button>

            <div class="payment-warning">
                <p>Sorry, it seems that there are no available payment methods. Please contact us if you require assistance or wish to make alternate arrangements.</p>
            </div>
        </div>
    </div>

   

    <script>
        // Fetch PHP variables for use in JavaScript
        const pricePerPerson = <?php echo json_encode($price_per_person); ?>;
        const pricePerTwo = <?php echo json_encode($price_per_two); ?>;

        function updatePrice() {
            const packageType = document.getElementById("package-type").value;
            let price = 0;

            if (packageType === "per_person") {
                price = pricePerPerson;
            } else if (packageType === "per_two") {
                price = pricePerTwo;
            }

            document.getElementById("package-price").innerText = ₹${price};
            document.getElementById("subtotal").innerText = ₹${price};
        }

        // Initialize price display
        updatePrice();
    </script>
</body>
</html>


<style>
    /* General body styling */
body {
    font-family: 'Arial', sans-serif;
    background-color: #1a1a1a;
    color: #f2f2f2;
    margin: 0;
    padding: 20px;
}

/* Main checkout container */
.checkout-container {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    max-width: 1200px;
    margin: auto;
}

/* Billing details section */
.billing-details, .order-summary {
    background-color: #2c2c2c;
    padding: 20px;
    border-radius: 10px;
    width: 48%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.billing-details h2, .order-summary h2 {
    color: #ffffff;
    font-size: 24px;
    margin-bottom: 20px;
}

label {
    display: block;
    margin: 10px 0 5px;
    color: #d1d1d1;
}

label span {
    color: #ff4b5c;
}

input, select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    background-color: #3c3c3c;
    border: none;
    border-radius: 5px;
    color: #f2f2f2;
}

input::placeholder {
    color: #9e9e9e;
}

input:focus, select:focus {
    outline: none;
    box-shadow: 0 0 5px #ff4b5c;
}

/* Order summary section */
.order-summary .order-item, .order-summary .order-total {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.order-summary .order-item span {
    font-size: 18px;
}

.order-summary .order-total {
    font-weight: bold;
    font-size: 20px;
}

/* Place order button */
.place-order {
    width: 100%;
    background-color: #ff4b5c;
    color: white;
    padding: 15px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.place-order:hover {
    background-color: #ff6b7c;
}

/* Payment warning */
.payment-warning {
    background-color: #f1c40f;
    padding: 10px;
    margin-top: 20px;
    border-radius: 5px;
    color: #2c2c2c;
}
</style>
