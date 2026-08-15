<?php
include "db_connect.php";

// Fetch all companies from the company_login table
$sql = "SELECT company_id, company_name, description, contact_information, logo_path FROM company_login";
$result = $conn->query($sql);

$companies = [];
if ($result->num_rows > 0) {
    // Fetch all companies data
    while ($row = $result->fetch_assoc()) {
        $companies[] = $row;
    }
} else {
    echo "No company information found.";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Guide</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container-travel">
        <h1>Travel Guide</h1>

        <div class="company-grid">
            <?php if (!empty($companies)): ?>
                <?php foreach ($companies as $company): ?>
                    <div class="company">
                        <img src="<?php echo htmlspecialchars($company['logo_path']); ?>" alt="<?php echo htmlspecialchars($company['company_name']); ?> Logo" class="company-logo">
                        
                        <div class="company-info">
                            <h2><?php echo htmlspecialchars($company['company_name']); ?></h2>
                            <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($company['description'])); ?></p>
                            <p>
                                <a href="packages.php?company_id=<?php echo urlencode($company['company_id']); ?>" class="btn btn-primary">View Packages</a>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No company information available.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>

<style>
    .btn-primary {
    background-color: #007bff; /* Blue background */
    color: #fff; /* White text */
    padding: 10px 20px; /* Button padding */
    border-radius: 5px; /* Rounded corners */
    text-decoration: none; /* Remove underline from link */
    font-size: 16px; /* Font size */
    font-weight: bold; /* Bold text */
    border: none; /* Remove border */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth transition */
}

.btn-primary:hover {
    background-color: #0056b3; /* Darker blue on hover */
    transform: scale(1.05); /* Slightly larger on hover */
}

.btn-primary:active {
    background-color: #004085; /* Darkest blue on click */
    transform: scale(0.98); /* Slightly smaller on click */
}

/* General Body Styling */
body {
    font-family: 'Arial', sans-serif;
    background-color: #1e1e1e;
    color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.container-travel {
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #f0f0f0;
    margin-bottom: 40px;
    font-size: 36px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
}

/* Card Grid Styling */
/* Company Card Grid Styling */
.company-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Two cards per row */
    gap: 20px; /* Space between cards */
}

/* Company Card Styling */
.company {
    background: linear-gradient(145deg, #2d2d2d, #3b3b3b);
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.6);
    padding: 20px;
    color: #e0e0e0;
    display: flex;
    flex-direction: column; /* Stack content vertically */
    align-items: center; /* Center align all content */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center; /* Center text */
}
/* Hover effect on cards */
.company:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.8);
}

/* Company Logo Styling */
.company-logo {
    max-width: 120px;
    margin-bottom: 15px;
    border-radius: 50%;
    background-color: #444;
    padding: 5px;
    box-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
}

/* Company Information */
.company-info h2 {
    color: #00bfff;
    margin-bottom: 10px;
    font-size: 24px;
    font-weight: 500;
    text-transform: capitalize;
}

.company-info p {
    margin-bottom: 15px;
    line-height: 1.6;
    font-size: 16px;
}

.company-info strong {
    color: #fff;
    font-weight: 700;
}

/* Button Styling */
button {
    background-color: #00bfff;
    border: none;
    padding: 10px 20px;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #008bbf;
}

/* Responsive Design */
@media (max-width: 768px) {
    .company {
        flex: 1 1 100%; /* Stack cards in one column for smaller screens */
        max-width: 100%;
    }
}
</style>
