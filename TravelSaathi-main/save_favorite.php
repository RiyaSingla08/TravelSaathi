<?php
include 'db_connect.php';
session_start();

// Read input data from AJAX request
$data = json_decode(file_get_contents('php://input'), true);

$uniq_id = $data['uniq_id'];
$email = $data['email'];
$is_favorite = $data['favorite'];

// Check if required data is available
if (!$uniq_id || !$email) {
    echo json_encode(['success' => false, 'message' => 'Missing parameters.']);
    exit();
}

// Prepare SQL query
if ($is_favorite) {
    // Add to favorites
    $sql = "INSERT INTO favorites (uniq_id, email) VALUES (?, ?) ON DUPLICATE KEY UPDATE uniq_id = uniq_id";
} else {
    // Remove from favorites
    $sql = "DELETE FROM favorites WHERE uniq_id = ? AND email = ?";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $uniq_id, $email);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
}
$stmt->close();
$conn->close();
?>
