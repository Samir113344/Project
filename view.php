<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT name,image_data FROM Image";
$result = mysqli_query($conn, $sql);
$images = mysqli_fetch_all($result, MYSQLI_ASSOC);


mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" href="view.css">
</head>
<body>
<div class="image-container">
    <?php foreach ($images as $image): ?>
        <img src="data:image/jpg;base64,<?= base64_encode($image['image_data']) ?>" alt="<?= $image['name'] ?>" >
    <?php endforeach; ?>
    </div>
</body>
</html>