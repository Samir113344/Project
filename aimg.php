<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="img1.css">
</head>
<body>
    <div class="home">
        <div class="navbar">
            <img src="logo.png" class="logo">
            <ul>
                <li><a href="alogin.php">Home</a><li>
                <li><a href="newabout.php">About</a></li>
                <li><a href="aimg.php">Image</a></li>
                <li><a href="photog.php">Photographer</a></li>
            </ul>
        </div>
    </div>
    <div class="view">
        <div class="profile">
            <div class="dropdown">
                <img src="U.png" class="dropdown-img" id="dropdownMenuButton" style="height: 40px; width: 40px;position: relative;
                transform: translate(-65px, 52px)">
                <?php
                session_start();
                $conn = mysqli_connect("localhost", "root", "", "Project");
                
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                
                if (isset($_SESSION['username'])) {
                    $Username = $_SESSION['username'];
                } else {
                    $Username = "";
                }
                
                $sel = "SELECT * FROM PG WHERE Username = '$Username'";
                $query = mysqli_query($conn, $sel);
                $result = mysqli_fetch_assoc($query);
                $UsernameFromDB = $result['Username'];
                
                mysqli_close($conn);
                ?>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">Welcome <?php echo $UsernameFromDB; ?></a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="project.PHP"> Logout</a></li>
                </ul>
            </div>
        </div>
       
    </div>
    <div class="imgbody">
        <div class="igg">
                <img src="img1.jpg">
            <div class="dis">Photo credit: Shailaj G. Pradhan</div>
        </div>
        <div class="igg">
                <img src="img7a.jpg">
            <div class="dis">Photo credit: Aman Dhakal</div>
        </div>
        <div class="igg">
                <img src="img8z.jpg">
            
            <div class="dis">Photo credit: Zenith Shahi Khadki</div>
        </div>
        <div class="igg">
                <img src="img4.jpg">
            <div class="dis">Photo credit: Shailaj G. Pradhan</div>
        </div>
        <div class="igg">
                <img src="img11a.jpg">
            <div class="dis">Photo credit: Aman Dhakal</div>
        </div>
        <div class="igg">
                <img src="img9z.jpg">
            <div class="dis">Photo credit: Zenith Shahi Khadki</div>
        </div>
        <div class="igg">
                <img src="img6.jpg">
            <div class="dis">Photo credit: Shailaj G. Pradhan</div>
        </div>
        <div class="igg">
                <img src="img12a.jpg">
            <div class="dis">Photo credit: Aman Dhakal</div>
        </div>
        <div class="igg">
                <img src="img10z.jpeg">
            <div class="dis">Photo credit: Zenith Shahi Khadki</div>
        </div>
        <div class="popup">
            
            </div>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    var dropdownToggle = document.getElementById("dropdownMenuButton");
    var dropdownMenu = document.querySelector(".dropdown-menu");

    dropdownToggle.addEventListener("click", function() {
        dropdownMenu.classList.toggle("show");
    });

    window.addEventListener("click", function(event) {
        if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.remove("show");
        }
    });
});

    </script>
</body>
</html>
