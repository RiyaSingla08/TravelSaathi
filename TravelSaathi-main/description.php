<?php
include "db_connect.php";
include "header.php";

// Get the ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the specific blog or vlog details based on the ID
$sql = "SELECT title, description, image_path FROM blogs_and_vlogs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Check if a result was found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<section-description>';
    echo '<h1>' . htmlspecialchars($row['title']) . '</h1>';
    echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['title']) . '">';
    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
    echo '</section>';
} else {
    echo "<p>Blog or vlog not found.</p>";
}

// Close the database connection
$conn->close();
?>

<style>
    /* Style for the section containing the description */
section-description {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #111; /* Dark background to match the theme */
    color: #fff; /* Text color for better contrast */
    padding: 20px;
    max-width: 800px;
    margin: auto;
    border-radius: 8px;
}

/* Title styling */
section-description h1 {
    font-size: 2em;
    color: #00ffd5; /* Bright color to match the theme */
    text-align: center;
    margin-bottom: 20px;
}

/* Image styling */
section-description img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    margin-bottom: 20px;
}

/* Description text styling */
section-description p {
    font-size: 1.2em;
    line-height: 1.6;
    color: #ddd;
    text-align: center;
}

/* Button styling for any call-to-action (if needed) */
section-description .btn {
    background-color: #00ffd5;
    color: #111;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

section-description .btn:hover {
    background-color: #00bfa3;
}

</style>

