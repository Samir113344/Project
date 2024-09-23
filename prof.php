<?php
if (isset($_POST['submit-profilepic'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_FILES['profilepic']) && $_FILES['profilepic']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profilepic'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];
        $fileData = file_get_contents($fileTmpName);

        $stmt = mysqli_prepare($conn, "INSERT INTO ProfilePictures (name, type, size, data) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssis", $fileName, $fileType, $fileSize, $fileData);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Profile picture uploaded successfully.";
        } else {
            echo "Failed to upload profile picture.";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
    header("Location: pprofile.php");
    exit; 
}
?>