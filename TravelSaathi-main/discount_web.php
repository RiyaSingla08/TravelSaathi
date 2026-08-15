<?php
include "header.php";
include "db_connect.php";

// SQL query to fetch data from the discounts table
$sql = "SELECT id, email, company_name, discount_message FROM discounts";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discounts</title>
    <style>
/* Basic styling */
body {
    font-family: Arial, sans-serif;
    background-color: #0d0d0d;
    color: #ffffff;
    text-align: center;
    margin: 0;
}

h2 {
    color: #ffffff;
    margin-top: 20px;
    font-size: 2.2em;
    font-weight: 600;
    text-shadow: 0px 2px 5px rgba(0, 0, 0, 0.5);
}

/* Container for the cards */
.container-discount {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    padding: 40px;
}

/* Card styling */
.card {
    background-color: #1c1c1c;
    border-radius: 8px;
    width: 280px;
    padding: 20px;
    box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.4);
    transition: transform 0.3s, box-shadow 0.3s;
    text-align: left;
    position: relative;
    border: 1px solid #333333;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.6);
}

/* Text styling within the card */
.card h3 {
    color: #3da9fc;
    font-size: 1.4em;
    font-weight: 600;
    margin-bottom: 10px;
}

.card p {
    color: #cccccc;
    font-size: 1em;
    line-height: 1.4;
}



    </style>
</head>
<body>

<h2>Available Discounts</h2>

<div class="container-discount">
    <?php
    // Check if the query returned any results
    if ($result->num_rows > 0) {
        // Loop through each row in the result and create a card for each discount
        while($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<h3>" . $row["company_name"] . "</h3>";
            echo "<p>" . $row["discount_message"] . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No discounts found.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>
</div>
<?php include "footer.php"; ?>
</body>
</html>
