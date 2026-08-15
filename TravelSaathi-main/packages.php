<?php
include "db_connect.php";
include "header.php";

// Check if company_id is provided in the URL
if (isset($_GET['company_id'])) {
    // First, retrieve the company's email using company_id
    $company_id = $_GET['company_id'];

    // Prepare to fetch the email from the company_login table
    $query = "SELECT email FROM company_login WHERE company_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $company_id); // 'i' specifies the variable type => 'integer'
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the company exists
    if ($result->num_rows > 0) {
        $company_data = $result->fetch_assoc();
        $company_email = $company_data['email']; // Store the email for later use

        // Now prepare to fetch packages using the company email
        $query_packages = "SELECT * FROM travel_data WHERE email = ?";
        $stmt_packages = $conn->prepare($query_packages);
        $stmt_packages->bind_param("s", $company_email); // 's' specifies the variable type => 'string'
        $stmt_packages->execute();
        $result_packages = $stmt_packages->get_result();

        // Check if any packages were returned
        if ($result_packages->num_rows > 0) {
            // Display the results
            echo "<div class='package-grid'>";

            // Fetch and display each package as a card
while ($row = $result_packages->fetch_assoc()) {
    $details_url = "dest_details.php?uniq_id=" . urlencode($row['uniq_id']);
    
    echo "<a href='" . htmlspecialchars($details_url) . "' class='package-card-link'>";
    echo "<div class='package-card'>
            <img src='" . htmlspecialchars($row['image1']) . "' alt='Package Image' class='package-image' />
            <h3>" . htmlspecialchars($row['package_name']) . "</h3>
            <p>" . htmlspecialchars($row['destination']) . "</p>
            <p class='price'>Price: $" . htmlspecialchars($row['price_per_person']) . "</p>
          </div>";
    echo "</a>";
}

echo "</div>";
} else {
    echo "No packages found for this company.";
}

// Close the package statement
$stmt_packages->close();
} else {
    echo "Company not found.";
}


    // Close the company statement
    $stmt->close();
} else {
    echo "Company ID not provided.";
}

// Close the connection
$conn->close();

include "footer.php";
?>
<style>
/* General Styles */
body {
    background-color: #121212; /* Darker background for better contrast */
    color: #e0e0e0; /* Softer white for less eye strain */
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}

/* Package Grid Styling */
.package-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    padding: 40px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Package Card Styling */
.package-card {
    background-color: #1f1f1f; /* Slightly lighter than the background */
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5); /* Added shadow for depth */
    text-align: center;
    padding: 20px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.package-card:hover {
    transform: scale(1.05); /* Slight zoom effect on hover */
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.7);
}

/* Image Styling */
.package-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 15px;
}

/* Package Title */
.package-card h3 {
    font-size: 20px;
    color: #fff;
    margin-bottom: 10px;
}

/* Package Type */
.package-card p {
    font-size: 16px;
    color: #ccc;
    margin-bottom: 5px;
}

/* Price Styling */
.price {
    font-weight: bold;
    color: #0bc0d9;
    font-size: 18px;
    margin-top: 10px;
}

/* Responsive Styling */
@media (max-width: 768px) {
    .package-grid {
        grid-template-columns: 1fr; /* One column layout on smaller screens */
    }
}
</style>