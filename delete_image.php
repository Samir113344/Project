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
    if (isset($_POST['image_id'])) {
        $imageId = $_POST['image_id'];

        // Perform deletion query
        $deleteQuery = "DELETE FROM Image WHERE id = '$imageId'";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            $response = array('response' => 'success');
        } else {
            $response = array('response' => 'Error deleting image: ' . mysqli_error($conn));
        }

        echo json_encode($response);
        exit; // Stop execution after sending the response
    } else {
        echo json_encode(array('response' => 'Invalid request'));
        exit; // Stop execution after sending the response
    }
}

mysqli_close($conn);
?>
