<?php
// Include database configuration file
include 'db_connect.php'; // Replace with your actual database configuration file

// Check if the 'email' parameter exists in the URL and set the default value
$email_from_url = isset($_GET['email']) ? $_GET['email'] : '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form inputs
    $email = $_POST['email'];
    $company_name = $_POST['company_name'];
    $discount_message = $_POST['discount_message'];

    // Insert the data into the `discounts` table
    $sql = "INSERT INTO discounts (email, company_name, discount_message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $email, $company_name, $discount_message);

    if ($stmt->execute()) {
        echo "Discount added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch discounts related only to the email from the URL
if ($email_from_url) {
    $sql = "SELECT * FROM discounts WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email_from_url);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discount Management</title>
</head>
<body>
<?php include "header_company.php"; ?>

    <h1>Discounts Form</h1>

    <!-- Form to capture discount info -->
    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email_from_url); ?>" required><br><br>

        <label for="company_name">Company Name:</label>
        <input type="text" name="company_name" id="company_name" required><br><br>

        <label for="discount_message">Discount Message:</label>
        <textarea name="discount_message" id="discount_message" required></textarea><br><br>

        <button type="submit">Submit</button>
    </form>

    <h2>Available Discounts for <?php echo htmlspecialchars($email_from_url); ?></h2>

    <!-- Display the discounts table -->
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                
                <th>Company Name</th>
                <th>Discount Message</th>
            </tr>
        </thead>
        <tbody>
        <?php
// Assuming your database connection is in $conn

// Get the email from the URL
$email = isset($_GET['email']) ? $_GET['email'] : '';

if (!empty($email)) {
    // Prepare the SQL statement with a placeholder
    $stmt = $conn->prepare("SELECT email, company_name, discount_message FROM discounts WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows are returned
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            
            echo "<td>" . htmlspecialchars($row['company_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['discount_message']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No discounts found for this email.</td></tr>";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "<tr><td colspan='3'>No email provided.</td></tr>";
}
?>

        </tbody>
    </table>
</body>
</html>
<style>
/* General body styling for dark theme */
body {
    background-color: #0D1117;
    color: #C9D1D9; /* Light text color */
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
}

/* Form styling */
form {
    background-color: #161B22; /* Slightly lighter than #0D1117 */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.5);
}

label {
    display: block;
    margin-bottom: 10px;
    color: #58A6FF; /* Blueish text for labels */
}

input[type="email"], input[type="text"], textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    background-color: #0D1117;
    border: 1px solid #30363D; /* Border matching the dark theme */
    border-radius: 4px;
    color: #C9D1D9;
}

input[type="email"]::placeholder, input[type="text"]::placeholder, textarea::placeholder {
    color: #8B949E; /* Subtle placeholder text */
}

button {
    background-color: #238636; /* Green accent color */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #2EA043; /* Slightly lighter green on hover */
}

/* Table styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px 15px;
    border: 1px solid #30363D; /* Border matching form */
    text-align: left;
}

th {
    background-color: #161B22;
    color: #C9D1D9;
}

td {
    background-color: #0D1117;
    color: #C9D1D9;
}

/* Styling for empty state or messages */
h1, h2 {
    color: #58A6FF;
}

p {
    color: #C9D1D9;
}
    </style>