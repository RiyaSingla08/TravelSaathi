<?php
include 'db_connect.php';
session_start();

// Check that this is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the unique ID and email from the POST request and session
    $uniqId = $_POST['uniq_id'] ?? '';
    $userEmail = $_SESSION['user_email'] ?? '';

    // Validate the required parameters
    if (!empty($uniqId) && !empty($userEmail)) {
        // Prepare the SQL DELETE statement
        $sql = "DELETE FROM favorites WHERE uniq_id = ? AND email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters to the statement
            $stmt->bind_param('ss', $uniqId, $userEmail);

            // Execute the statement
            if ($stmt->execute()) {
                // Send a success response
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete item from wishlist.']);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Error preparing the delete statement.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request parameters.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$conn->close();
?>
