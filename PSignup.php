<?php
session_start();
$servername = "localhost";
$username1 = "root";
$password1 = "";
$dbname = 'project';
$conn = mysqli_connect($servername, $username1, $password1, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
   // echo "Connected<br>";
}

$errname = $erremail = $errpass = $errcpass = $errsubmit = $userTypeErr = $genderErr = "";
if (isset($_POST['Signup'])) {
    $name = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $cpassword = $_POST['cpassword'];
    $userType = $_POST['user_type'];
    $gender = $_POST['gender'];

    if (empty($name)) {
        $errname = "Username cannot be empty";
    }

    if (empty($password) || strlen($password) <= 8) {
        $errpass = "Password must be greater than 8 characters";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erremail = "Enter a valid email";
    }

    if ($password !== $cpassword) {
        $errcpass = "Password must be the same";
    }

    if (empty($userType)) {
        $userTypeErr = "User type is required";
    } else {
        $allowedUserTypes = ['photographer', 'user', 'admin'];
        if (!in_array($userType, $allowedUserTypes)) {
            $userTypeErr = "Invalid user type";
        } else {
            // Store user data based on the selected user type
            $table = "";
            if ($userType == "photographer") {
                $table = "PG";
            } elseif ($userType == "user") {
                $table = "pro";
            } elseif ($userType == "admin") {
                $table = "admin";
            }

            if (!empty($table)) {
                if ($table === 'PG' || $table === 'pro') {
                    $value = "INSERT INTO $table (Username, Email, Password, Cpassword, Gender, User_type) VALUES ('$name', '$email', '$password', '$cpassword', '$gender', '$userType');";
                } else {
                    $value = "INSERT INTO $table (Username, Email, Password, Cpassword) VALUES ('$name', '$email', '$password', '$cpassword');";
                }

                if (mysqli_query($conn, $value)) {
                    //echo "success";
                } else {
                    echo "error: " . mysqli_error($conn);
                }
            } else {
                echo "Please select a valid user type";
            }
        }
    }
}
?>






<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PSignup</title>
    <link rel="stylesheet" href="page.css">
</head>
<body>
<div class="navbar">
        <a href="./project.php">Home</a>
        <a href="./About.php">About</a>
        <a href="./img.php">Image</a>
        <a href="./clogin.php">Login</a>
        <a href="./PSignup.php">SignUP</a>
    </div>
    <div class="green">
        <form method="post" action="" onsubmit="return showSuccessAlert();">
            <h2>Signup</h2>
            <label for="name">Username:</label><input type="text" name="username" placeholder="Enter your Name" id="name">
            <span class="error"><?php echo $errname ?></span><br><br>
            <label for="email">Email:</label><input type="text" name="email" placeholder="Enter your Email" id="email">
            <span class="error"><?php echo $erremail ?></span><br><br>
            <label for="password">Password:</label><input type="password" name="password" placeholder="Enter your Password" id="password">
            <span class="error"><?php echo $errpass ?></span><br><br>
            <label for="cpassword">Confirm Password:</label><input type="password" name="cpassword" placeholder="Enter Confirm Password" id="cpassword">
            <span class="error"><?php echo $errcpass ?></span><br><br>
            <label for="user_type">
                User Type:
                <select name="user_type">
                    <option value="photographer">Photographer</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </label>
            <span class="error"><?php echo $userTypeErr ?></span><br><br>
            <label for="gender">
                Gender:
                <input type="radio" name="gender" value="male">Male
                <input type="radio" name="gender" value="female">Female
            </label>
            <span class="error"><?php echo $genderErr ?></span><br><br>
            <input type="submit" name="Signup">
            <span class="error"><?php echo $errsubmit ?></span>
            
        </form>
    </div>
</body>
</html>

