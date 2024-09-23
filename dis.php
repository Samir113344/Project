<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT DISTINCT name, email, contact, rate, image_data FROM Image";
$result = mysqli_query($conn, $sql);
$images = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql1 = "SELECT name, type, data FROM ProfilePictures";
$result1 = mysqli_query($conn, $sql1);
$profilePictures = mysqli_fetch_all($result1, MYSQLI_ASSOC);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numberOfDays = isset($_POST['no']) ? (int)$_POST['no'] : 0;

    if ($numberOfDays <= 0) {
        echo "<script>alert('Please enter a valid number of days greater than zero.');</script>";
    } else {
        $rate = isset($images[0]['rate']) ? (float)$images[0]['rate'] : 0;
        $totalAmount = $rate * $numberOfDays;
    }}

mysqli_close($conn);
?>

<html>
<head>
    <link rel="stylesheet" href="disp.css">
</head>
<body>
    <div class="home">
        <div class="navbar">
            <img src="logo.png" class="logo">
            <ul>
                <li><a href="alogin.php">Home</a></li>
                <li><a href="newabout.php">About</a></li>
                <li><a href="aimg.php">Image</a></li>
                <li><a href="photog.php">Photographer</a></li>
            </ul>
        </div>
    </div>

    <div class="profile-header">
        <div class="profile-info">
            <h1>Info :</h1>
            <div class="profile-data">
                <?php foreach ($images as $index => $image): ?>
                    <?php if ($index === 0): ?>
                        <h2><?= $image['name'] ?></h2>
                        <p>Email: <?= $image['email'] ?></p>
                        <p>Contact: <?= $image['contact'] ?></p>
                        <p>Rate: <?= $image['rate'] ?></p>
                        <form action="" method="POST">Number of Days:
                        <input type="number" name="no">
                        </form>
                        <div id="paypal-button-container"></div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="post-grid">
        <div class="profile-img">
            <?php foreach ($images as $index => $image): ?>
                <img src="data:image/jpg;base64,<?= base64_encode($image['image_data']) ?>" alt="<?= $image['name'] ?>">
            <?php endforeach; ?>
        </div>

        <?php foreach ($profilePictures as $picture): ?>
            <?php $base64Image = base64_encode($picture['data']); ?>
            <div class="profile-pic">
                <img src="data:<?= $picture['type'] ?>;base64,<?= $base64Image ?>" alt="<?= $picture['name'] ?>">
            </div>
        <?php endforeach; ?>
     
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=AWmaam2oaKBhkp0CiAsOvjS8mYRgKHZ3NZKuqPcrddXWYa024VxCJiGCOmc06CBIftVSvnyo1wQoewd4"></script>
    <script>
         <?php if (isset($totalAmount) && $totalAmount > 0): ?>
        <script src="https://www.paypal.com/sdk/js?client-id=YOUR_PAYPAL_CLIENT_ID"></script>
        <script>
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '<?php echo $totalAmount; ?>'
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    alert('Payment successful!');
                },
                onError: function(err) {
                    // Handle any PayPal button errors here
                    console.error('PayPal Error:', err);
                    // You can display a custom error message to the user if desired
                    alert('An error occurred while processing the payment. Please try again later.');
                }
            }).render('#paypal-button-container');
        </script>
    <?php endif; ?>
    </script>
    
</body>
</html>