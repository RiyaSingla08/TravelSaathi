<?php
include 'db_connect.php';  // Include your database connection

// Fetch the email from the URL
if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($conn, $_GET['email']);
} else {
    header("Location: error.php"); 
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    
    // Define directory to store uploaded files
    $uploadDir = "uploads/";

    // Handle image upload
    if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] == 0) {
        $imageFileName = basename($_FILES['image_path']['name']);
        $imagePath = $uploadDir . $imageFileName;
        move_uploaded_file($_FILES['image_path']['tmp_name'], $imagePath);
    } else {
        $imagePath = '';
    }

    // Handle video upload
    if (isset($_FILES['video_path']) && $_FILES['video_path']['error'] == 0) {
        $videoFileName = basename($_FILES['video_path']['name']);
        $videoPath = $uploadDir . $videoFileName;
        move_uploaded_file($_FILES['video_path']['tmp_name'], $videoPath);
    } else {
        $videoPath = '';
    }

    // Insert data into database
    $query = "INSERT INTO blogs_and_vlogs (email, title, description, image_path, video_path, type) 
              VALUES ('$email', '$title', '$description', '$imagePath', '$videoPath', '$type')";
    if (mysqli_query($conn, $query)) {
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Blog/Vlog - TravelSaathi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "header_blogs.php"; ?>
    <div class="container">
        <h2>Upload Your Blog or Vlog</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?email=<?php echo $email; ?>" method="POST" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" required></textarea>

            <label for="image_path">Upload Image:</label>
            <input type="file" name="image_path" id="image_path" accept="image/*" required>

            <label for="video_path">Upload Video (Optional):</label>
            <input type="file" name="video_path" id="video_path" accept="video/*">

            <label for="type">Type:</label>
            <select name="type" id="type" required>
                <option value="blog">Blog</option>
                <option value="vlog">Vlog</option>
            </select>

            <button type="submit">Submit</button>
        </form>
   
        <h2>Your Blogs and Vlogs</h2>
        <ul>
            <?php
            // Query to retrieve blogs/vlogs by the user
            $query = "SELECT title, description, image_path, video_path, type FROM blogs_and_vlogs WHERE email = '$email'";
            $result = mysqli_query($conn, $query);
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li><strong>Title:</strong> {$row['title']}<br>";
                    echo "<strong>Description:</strong> {$row['description']}<br>";
                    echo "<strong>Type:</strong> {$row['type']}<br>";
                    echo "<strong>Image:</strong> <img src='{$row['image_path']}' alt='Image' style='max-width:150px;'><br>";

                    if (!empty($row['video_path'])) {
                        echo "<strong>Video:</strong> <a href='{$row['video_path']}' target='_blank'>Watch Video</a><br>";
                    }
                    echo "<br></li>";
                }
            } else {
                echo "<p>No blogs or vlogs found for your account.</p>";
            }
            ?>
        </ul>
    </div>
</body>
</html>

<style>
    /* General styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
}

body {
    background-color: #0D1117; /* Dark background */
    color: #C9D1D9; /* Light text */
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.container {
    width: 100%;
    background-color: #161B22;
    border-radius: 12px;
    box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.6); /* Box shadow */
    border: 1px solid #30363D;
}

/* Heading styles */
h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #58A6FF; /* Blue heading color */
}

/* Form Styles */
form label {
    color: #C9D1D9;
    font-weight: bold;
    margin-bottom: 8px;
}

form input, form textarea, form select {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #30363D;
    border-radius: 8px;
    background-color: #0D1117;
    color: white;
    font-size: 16px;
    transition: border-color 0.3s ease-in-out;
}

form input:focus, form textarea:focus, form select:focus {
    border-color: #58A6FF; /* Focus border color */
    outline: none;
}

/* Styled Dropdown */
form select {
    appearance: none;
    background-color: #161B22;
    padding-right: 30px;
    background-image: url('data:image/svg+xml;utf8,<svg fill="%23C9D1D9" height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5H7z"/></svg>');
    background-repeat: no-repeat;
    background-position: right 10px center;
    border-radius: 8px;
}

form select:hover {
    background-color: #21262D;
}

/* Button Styles */
form button {
    background-color: #1F6FEB;
    color: white;
    border: none;
    cursor: pointer;
    font-weight: bold;
    padding: 15px;
    font-size: 16px;
    border-radius: 8px;
    transition: background-color 0.3s, transform 0.2s ease-in-out;
}

form button:hover {
    background-color: #2585ff;
    transform: translateY(-2px);
}

/* Blog/Vlog list */
ul {
    list-style-type: none;
    padding-left: 0;
}

li {
    background-color: #21262D;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 8px;
    border: 1px solid #30363D;
}

li img {
    max-width: 100%;
    border-radius: 8px;
}

li a {
    color: #58A6FF;
    text-decoration: none;
}

li a:hover {
    text-decoration: underline;
}

    </style>