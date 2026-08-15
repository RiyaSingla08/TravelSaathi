<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the email from the form
    $email = $_POST['email'];

    // Validate the email format
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        include "db_connect.php";

        // Prepare SQL to insert email into the table `newsletter_subscribers`
        $sql = "INSERT INTO newsletter_subscribers (email) VALUES (?)";
        $stmt = $conn->prepare($sql);

        // Bind the email parameter and execute the statement
        $stmt->bind_param("s", $email);

        // Check if the insertion is successful
        if ($stmt->execute()) {
            header("Location: " . $_SERVER['PHP_SELF']);
        } else {
            // Check if the error is due to a duplicate email
            if ($conn->errno == 1062) {
                header("Location: " . $_SERVER['PHP_SELF']);
            } else {
                echo "Error: " . $conn->error;
            }
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Invalid email format message
        echo "Invalid email address.";
    }
} else {
    // If the form is accessed without submitting, redirect back to the homepage or show an error
    header("Location: index.php");
    exit();
}
?>
