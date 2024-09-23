<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $rate = mysqli_real_escape_string($conn, $_POST['rate']);

    // Process image upload
    $imagePath = "uploads/";
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageType = $_FILES['image']['type'];

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

    if (!in_array($imageExtension, $allowedExtensions)) {
        echo json_encode(['response' => 'error', 'message' => 'Invalid file format.']);
        exit();
    }

    $uniqueName = uniqid('image_') . '.' . $imageExtension;
    $targetPath = $imagePath . $uniqueName;

    if (move_uploaded_file($imageTmpName, $targetPath)) {
        // Insert information into the database
        $sql = "INSERT INTO Image (name, email, contact, rate, image_path) VALUES ('$name', '$email', '$contact', '$rate', '$targetPath')";

        if (mysqli_query($conn, $sql)) {
            echo json_encode(['response' => 'success']);
        } else {
            echo json_encode(['response' => 'error', 'message' => 'Error inserting data into the database.']);
        }
    } else {
        echo json_encode(['response' => 'error', 'message' => 'Error uploading the file.']);
    }
} else {
    echo json_encode(['response' => 'error', 'message' => 'Invalid request method.']);
}

mysqli_close($conn);
?>
