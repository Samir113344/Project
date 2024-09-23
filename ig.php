<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image'])) {
        $name = $_POST['name'];
        $file = $_FILES['image'];
        $email = $_POST['email']; 
        $contact = $_POST['contact']; 
        $rate = $_POST['rate'];

        if (empty($name)) {
            echo 'Name cannot be empty';
            exit();
        }
        if (empty($email)) {
            echo 'Email cannot be empty';
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid email format';
            exit();
        }
        if (empty($contact)) {
            echo 'Contact cannot be empty';
            exit();
        } elseif (!preg_match('/^\d{10}$/', $contact)) {
            echo 'Invalid contact number';
            exit();
        }
        if (empty($rate)) { 
            echo 'Rate cannot be empty';
            exit();
        } elseif (!is_numeric($rate)) {
            echo 'Rate must be a numeric value';
            exit();
        }

        $uploadDirectory = 'uploads/';

        $targetFile = $uploadDirectory . basename($file['name']);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($fileType, $allowedExtensions)) {
            echo 'Please upload only images with the following extensions: .jpg, .jpeg, .png, .gif';
            exit();
        }

        
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $newFilePath = $uploadDirectory . 'img' . uniqid() . '.' . $fileType;

        
        if (move_uploaded_file($file['tmp_name'], $newFilePath)) {
            $imageData = file_get_contents($newFilePath);

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "project";
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "INSERT INTO Image (name, email, contact, rate, image_data) VALUES (?, ?, ?, ?, ?)"; 
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $contact, $rate, $imageData); 
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: pprofile.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo 'Failed to move uploaded file.';
        }
    }
}
?>