<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="alogin1.css">
</head>
<body>
    <div class="home">
        <div class="navbar">
            <img src="logo.png" class="logo">
            <ul>
                <li><a href="slogin.php">Home</a></li>
                <li><a href="newabout.php">About</a></li>
                <li><a href="aimg.php">Image</a></li>
                <li><a href="pprofile.php">Photographer</a></li>
            </ul>
        </div>
    </div>
    <div class="view">
        <div class="profile">
            <div class="dropdown">
                <img src="U.png" class="dropdown-img" id="dropdownMenuButton">
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
